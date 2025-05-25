<!-- Modal -->
<div wire:ignore.self class="modal fade" id="{{ $id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
           
            <div class="modal-body text-center ">
                <i></i>
                <h2>Yakin ingin menghapus data ini ?!</h2>
                <p>Data yang telah dihapus tidak bisa dikembalikan lagi.</p>
            </div>
            <div class="modal-footer flex items-center justify-center">
                <button type="button" class="btn btn-success" wire:click="resetData" data-bs-dismiss="modal">BATAL</button>
                <button type="button" class="btn btn-danger" wire:click="{{ $aksi }}">TETAP HAPUS</button>
            </div>
        </div>
    </div>
</div>