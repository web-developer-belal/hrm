<?php
namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class FileUpload extends Component
{
    public string $uploadId;

    public function __construct(
        public string $name,
        public string $title = 'File Upload',
        public string $label = 'Upload',
        public bool $multiple = false,
        public ?string $accept = null,
        public int $maxSize = 10485760// 10MB
    ) {
        $this->uploadId = 'upload_' . Str::random(8);
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View | Closure | string
    {
        return view('components.form.file-upload');
    }
}
