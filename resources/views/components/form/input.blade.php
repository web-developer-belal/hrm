<div class="w-full">
    @if ($label)
        <label class="form-label flex gap-2">{{ $label }} @if ($isRequired)<span class="text-red-500">*</span> @endif</label>
    @endif

    @if ($type === 'time')
        <div class="relative">
            <input type="{{ $type }}" class="form-control {{ $class ?? '' }}"
                @if ($live) wire:model.live="{{ $name }}" @else wire:model="{{ $name }}" @endif
                @if ($isRequired) required @endif
                @if ($placeholder) placeholder="{{ $placeholder }}" @endif />
            <svg class="absolute right-2 cursor-pointer top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
    @else
        <input type="{{ $type }}" class="form-control {{ $class ?? '' }}"
            @if ($live) wire:model.live="{{ $name }}" @else wire:model="{{ $name }}" @endif
            @if ($isRequired) required @endif
            @if ($placeholder) placeholder="{{ $placeholder }}" @endif />
    @endif
    @if ($error)
        @error($name)
            <small class="text-danger">
                {{ $message }}
            </small>
        @enderror
    @endif
</div>
