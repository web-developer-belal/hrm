<div class="w-full">
    @if ($label)
        <label for="{{ $name }}" class="form-label">
            {{ $label }}
        </label>
    @endif

    @if ($isEditor)
        <div wire:ignore x-data="{
            content: @entangle($name),
            init() {
                let editor = $('#{{ $name }}').summernote({
                    height: {{ $rows * 30 }},
                    @if ($placeholder)
                    placeholder: '{{ $placeholder }}',
                    @endif
                    callbacks: {
                        onChange: (contents) => {
                            this.content = contents;
                        },
                        onInit: () => {
                            $('#{{ $name }}').summernote('code', this.content || '');
                        }
                    }
                });

                // Watch for Livewire updates
                this.$watch('content', (value) => {
                    if ($('#{{ $name }}').summernote('code') !== value) {
                        $('#{{ $name }}').summernote('code', value || '');
                    }
                });
            }
        }">
            <textarea 
                id="{{ $name }}"
                name="{{ $name }}"
                @if ($isRequired) required @endif
                class="bg-white border-borderColor text-gray-900 text-sm rounded-r-lg block w-full py-2 px-2.5 placeholder:text-gray-400 @if ($error) border-red-500 @endif {{ $class ?? '' }}">{{ old($name, $value ?? '') }}</textarea>
        </div>
    @else
        <textarea name="{{ $name }}"
            @if ($placeholder) placeholder="{{ $placeholder }}" @endif
            @if ($rows) rows="{{ $rows }}" @endif
            @if ($cols) cols="{{ $cols }}" @endif
            @if ($isRequired) required @endif
            @if ($live) wire:model.live="{{ $name }}" @else wire:model="{{ $name }}" @endif
            class="bg-white border-borderColor text-gray-900 text-sm rounded-r-lg block w-full py-2 px-2.5 placeholder:text-gray-400 @if ($error) border-red-500 @endif {{ $class ?? '' }}">{{ old($name, $value ?? '') }}</textarea>
    @endif

    @if ($error)
        @error($name)
            <small class="text-danger">
                {{ $message }}
            </small>
        @enderror
    @endif
</div>
