<div class="w-full">
    @if ($label)
        <label class="form-label flex gap-2">{{ $label }} @if ($isRequired)<span class="text-red-500">*</span> @endif</label>
    @endif

    <input type={{ $type }} class="form-control {{ $class ?? '' }}"
        @if ($live) wire:model.live="{{ $name }}" @else wire:model="{{ $name }}" @endif
        @if ($isRequired) required @endif
        @if ($placeholder) placeholder="{{ $placeholder }}" @endif />
    @if ($error)
        @error($name)
            <small class="text-danger">
                {{ $message }}
            </small>
        @enderror
    @endif
</div>
