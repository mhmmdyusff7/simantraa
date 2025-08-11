<!-- Modal -->
<div wire:ignore.self class="modal fade" id="{{ $id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
           
            <div class="modal-body text-center ">
                <i></i>
                <h2>Apakah anda yakin ingin keluar ?!</h2>
                <p>Anda akan keluar dari aplikasi ini.</p>
            </div>
            <div class="modal-footer flex items-center justify-center">
                <button type="button" class="btn btn-success"  data-bs-dismiss="modal">BATAL</button>
                <button type="button" class="btn btn-danger" wire:click="{{ $aksi }}">LOGOUT</button>
            </div>
        </div>
    </div>
</div>