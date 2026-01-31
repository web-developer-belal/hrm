<div class="w-full">
    @if ($label)
        <label class="form-label">{{ $label }}</label>
    @endif

    <input type="text" class="form-control {{ $class ?? '' }}" @if($live) wire:model.live="{{ $name }}" @else wire:model="{{$name}}" @endif @if ($is_required) required @endif @if($placeholder) placeholder="{{$placeholder}}" @endif />
    @if ($error)
        @error($name)
            <small class="text-danger">
                {{ $message }}
            </small>
        @enderror
    @endif
</div>
