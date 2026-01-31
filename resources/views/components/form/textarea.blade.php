<div class="w-full">
    @if ($label)
        <label for="{{ $name }}" class="form-label">
            {{ $label }}
        </label>
    @endif
    <textarea name="{{ $name }}"
        @if ($placeholder) placeholder="{{ $placeholder }}" @endif
        @if ($rows) rows="{{ $rows }}" @endif
        @if ($cols) cols="{{ $cols }}" @endif
        @if ($is_required) required @endif
        @if ($live) wire:model.live="{{ $name }}" @else wire:model="{{ $name }}" @endif
        class="bg-white border-borderColor text-gray-900 text-sm rounded-r-lg block w-full py-2 px-2.5 placeholder:text-gray-400 @if ($error) border-red-500 @endif {{ $class ?? '' }}">{{ old($name, $value ?? '') }}</textarea>
    @if ($error)
        @error($name)
            <small class="text-danger">
                {{ $message }}
            </small>
        @enderror
    @endif

</div>
