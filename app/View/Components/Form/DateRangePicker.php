<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Carbon\Carbon;

class dateRangePicker extends Component
{
    public string $startDate;
    public string $endDate;

    /**
     * Create a new component instance.
     *
     * @param string|null $startDate
     * @param string|null $endDate
     */
    public function __construct(?string $startDate = null, ?string $endDate = null)
    {
        // Default to today if not provided
        $this->startDate = $startDate ?? Carbon::today()->format('Y-m-d');
        $this->endDate   = $endDate ?? Carbon::today()->format('Y-m-d');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.date-range-picker', [
            'startDate' => $this->startDate,
            'endDate'   => $this->endDate,
        ]);
    }
}
