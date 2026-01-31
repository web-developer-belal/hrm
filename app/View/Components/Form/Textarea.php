<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Textarea extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $name,
        public ?string $label = null,
        public ?string $class = null,
        public bool $is_required = false,
        public bool $live = false,
        public bool $error = false,
        public string $rows = '4',
        public string $cols = '30',
        public ?string $placeholder = null,
    )
    {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.textarea');
    }
}
