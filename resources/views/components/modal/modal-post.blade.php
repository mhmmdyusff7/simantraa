<!-- Modal -->
<div wire:ignore.self class="modal fade" id="{{ $id }}" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog {{ $modalsize ?? '' }}">
        <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $title ?? 'MODAL HEADER' }}</h1>

                </div>
                <div class="modal-body">
                   @isset($header)
                        {{ $header }}
                    @endisset
                    {{ $slot }}
                </div>
                <div class="modal-footer">
                     
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="resetForm">BATAL</button>
                    <button wire:click="simpanData" type="button" class="btn btn-primary" id="savemodal">{{ $btnTitle ?? 'SIMPAN' }}
                    </button>
                </div>
            </div>
    </div>
</div>
