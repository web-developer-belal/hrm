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
        public ?array $option = [],
        public ?string $placeholder = null,
        public bool $isRequired = false,
        public bool $error = true,
        public bool $live = false,
        public bool $search = false,
        public bool $isMultiple = false,
    ) {
        $this->options = $this->options ?: $this->option ?: [];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View | Closure | string
    {
        return view('components.form.select');
    }
}
