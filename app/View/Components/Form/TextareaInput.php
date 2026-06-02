<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TextareaInput extends Component
{
    public string $value;

    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $name,
        public string $label = '',
        ?string $value = '',
        public string $placeholder = '',
        public int|string $rows = 3,
        public ?string $error = null
    ) {
        $this->value = $value ?? '';
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.textarea-input');
    }
}
