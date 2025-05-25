<!-- Modal -->
<div wire:ignore.self class="modal fade" id="{{ $id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $title ?? 'MODAL HEADER' }}</h1>
            </div>
            <div class="modal-body">
                {{ $slot }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" wire:click="resetData" data-bs-dismiss="modal">BATAL</button>
                <button type="button" class="btn btn-primary" wire:click="{{ $aksi }}">{{ $btnTitle ?? 'SIMPAN' }}</button>
            </div>
        </div>
    </div>
</div>