<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $label = '',
        public string $type = 'text',
        public ?string $name = null,
        public ?string $placeholder = null,
        public bool $is_required = false,
        public bool $error = true,
        public bool $live = false,
    )
    {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.input');
    }
}
