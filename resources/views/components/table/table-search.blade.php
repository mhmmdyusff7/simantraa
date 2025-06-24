
@isset($tableHeader)
    <div class="flex justify-between items-center mb-4">
        <div>
            <input type="search" wire:model.live="cari" class="form-control" placeholder="Cari Data ...">
        </div>
        <div>
            <select wire:model.live="limit_paginations" class="form-select">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="15">15</option>
                <option value="20">20</option>
                <option value="25">25</option>
            </select>
        </div>
    </div>
@endisset
<div class="table-responsive">
    {{ $slot }}
</div>
@isset($tableFooter)
    <div>
        {{ $tableFooter->links(data: ['scrollTo' => false]) }}
    </div>
@endisset
