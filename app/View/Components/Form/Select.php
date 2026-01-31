<?php
namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Select extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $label = '',
        public ?string $name = null,
        public ?array $options = [],
        public bool $is_required = false,
        public bool $is_multiple = false,
        public bool $error = true,
        public bool $live = false,
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View | Closure | string
    {
        return view('components.form.select');
    }
}
