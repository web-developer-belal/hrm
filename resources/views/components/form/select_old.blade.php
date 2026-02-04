<div class="w-full">
    @if ($label)
        <label class="form-label">{{ $label }}</label>
    @endif

    <select
        name="{{ $is_multiple ? $name.'[]' : $name }}"
        class="form-control {{ $class ?? '' }}"
        @if ($live) wire:model.live="{{ $name }}" @else wire:model="{{ $name }}" @endif
        @if ($is_required) required @endif
        @if ($is_multiple) multiple @endif
    >
        @foreach ($options as $index => $item)
            <option value="{{ $index }}">
                {{ $item }}
            </option>
        @endforeach
    </select>

    @if ($error)
        @error($name)
            <small class="text-danger">
                {{ $message }}
            </small>
        @enderror
    @endif
</div>
