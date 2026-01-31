<div class="w-full">
    @if ($label)
        <label class="form-label">{{ $label }}</label>
    @endif
    <select class="form-control {{ $class ?? '' }}"
        @if ($live) wire:model.live="{{ $name }}" @else wire:model="{{ $name }}" @endif
        @if ($is_required) required @endif>
        <option value="active">Active</option>
        <option value="inactive">Inactive</option>
    </select>
    @if ($error)
        @error($name)
            <small class="text-danger">
                {{ $message }}
            </small>
        @enderror
    @endif
</div>
