<div class="form-group mb-3">
    <label for="{{ $model }}">{{ $label ?? 'label' }}</label>
    <input type="{{ $type ?? '' }}" wire:model.live="{{ $model }}" class="form-control @error($model) is-invalid @enderror" placeholder="{{ $placeholder ?? '...' }}" aria-label="{{ $model }}" @isset($readonly) readonly @endisset>
    @error($model)
        <div class="text-red-500">{{ $message }}</div>
    @enderror
</div>