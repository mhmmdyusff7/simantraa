<div class="form-group mb-3">
    <label for="{{ $model }}">{{ $label ?? 'label' }}</label>
    <select  wire:model="{{ $model }}" class="form-select @error($model) is-invalid @enderror">
        {{ $slot }}
    </select>
    {{-- message error inputan--}}
    @error($model)
        <div class="text-red-500">{{ $message }}</div>
    @enderror
</div>