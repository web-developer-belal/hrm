<?php

namespace App\Observers;

use App\Models\ActivityLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class AuditObserver
{
    public function created(Model $model): void
    {
        $this->log('created', $model, null, $model->getAttributes());
    }

    public function updated(Model $model): void
    {
        $dirty = $model->getDirty();
        if (empty($dirty)) {
            return;
        }

        $old = [];
        foreach (array_keys($dirty) as $key) {
            $old[$key] = $model->getOriginal($key);
        }

        $this->log('updated', $model, $old, $dirty);
    }

    public function deleted(Model $model): void
    {
        $this->log('deleted', $model, $model->getOriginal(), null);
    }

    protected function log(string $event, Model $model, ?array $oldValues, ?array $newValues): void
    {
        if ($model instanceof ActivityLog) {
            return;
        }

        $request = request();

        ActivityLog::create([
            'user_id'      => Auth::id(),
            'event'        => $event,
            'subject_type' => $model::class,
            'subject_id'   => $model->getKey(),
            'old_values'   => $oldValues,
            'new_values'   => $newValues,
            'description'  => class_basename($model) . " {$event}",
            'ip_address'   => $request?->ip(),
            'user_agent'   => $request?->userAgent(),
            'url'          => $this->resolveUrl($request),
            'method'       => $request?->method(),
            'route_name'   => $this->resolveRouteName($request),
        ]);
    }

    protected function resolveUrl(?HttpRequest $request): ?string
    {
        if (! $request) {
            return null;
        }

        if ($this->isLivewireUpdateRoute($request->route()?->getName())) {
            return $request->headers->get('referer') ?: $request->fullUrl();
        }

        return $request->fullUrl();
    }

    protected function resolveRouteName(?HttpRequest $request): ?string
    {
        if (! $request) {
            return null;
        }

        $currentRouteName = $request->route()?->getName();

        if ($currentRouteName && ! $this->isLivewireUpdateRoute($currentRouteName)) {
            return $currentRouteName;
        }

        $referer = $request->headers->get('referer');
        if (! $referer) {
            return $currentRouteName;
        }

        try {
            $route = Route::getRoutes()->match(HttpRequest::create($referer, 'GET'));
            $routeName = $route?->getName();

            if ($routeName && ! $this->isLivewireUpdateRoute($routeName)) {
                return $routeName;
            }

            $parts = parse_url($referer);
            $path = $parts['path'] ?? '/';
            $query = isset($parts['query']) ? ('?' . $parts['query']) : '';

            $route = Route::getRoutes()->match(HttpRequest::create(
                $path . $query,
                'GET',
                [],
                [],
                [],
                [
                    'HTTP_HOST' => $parts['host'] ?? $request->getHost(),
                    'HTTPS' => (($parts['scheme'] ?? 'http') === 'https') ? 'on' : 'off',
                ]
            ));

            $routeName = $route?->getName();

            return ($routeName && ! $this->isLivewireUpdateRoute($routeName))
                ? $routeName
                : $currentRouteName;
        } catch (\Throwable $exception) {
            return $currentRouteName;
        }
    }

    protected function isLivewireUpdateRoute(?string $routeName): bool
    {
        if (! $routeName) {
            return false;
        }

        return Str::endsWith($routeName, 'livewire.update');
    }
}
