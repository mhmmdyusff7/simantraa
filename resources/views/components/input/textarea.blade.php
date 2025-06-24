<div class="form-group mb-3">
    <label for="{{ $model }}">{{ $label ?? 'label' }}</label>
    <textarea wire:model="{{ $model }}" class="form-control @error($model) is-invalid @enderror" 
    placeholder="{{ $placeholder ?? '...' }}" aria-label="{{ $model }}" 
    cols="30" rows="10"> @isset($value) {{ $value }}@else {{ old($model) }}@endisset
</textarea>
    @error($model)
        <div class="text-red-500">{{ $message }}</div>
    @enderror

</div>