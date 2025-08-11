<div>
    <div class="sectioncontent-header justify-between">
        <h2 class="sectioncontentheader-title">LOGOUT </h2>

    </div>
    <div class="row">
        {{-- box table col 4-12 --}}
        <div class="col-8">
            <div class="bg-white rounded-md custom-shadow p-10">
                <ul class="flex flex-col space-y-3">
                    <li>
                        <span class="inline-block w-[70px]">Nama</span>
                        <span class="inline-block w-[20px]">:</span>
                        <span>{{ $name }}</span>
                    </li>
                    <li>
                        <span class="inline-block w-[70px]">Email</span>
                        <span class="inline-block w-[20px]">:</span>
                        <span>{{ $email }}</span>
                    </li>
                    <li>
                        <button class="btn btn-danger py-2 px-10 float-end" data-bs-toggle="modal" data-bs-target="#logoutModal">Logout</button>
                    </li>
                </ul>
            </div>
        </div>
        
    </div>

    <x-modal.modal-logout id="logoutModal" aksi="logout" />

</div>
