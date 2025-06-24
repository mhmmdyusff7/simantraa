<div>
    <div class="sectioncontent-header flex flex-col md:flex-row justify-start md:justify-between ">
        <h2 class="sectioncontentheader-title">Dashboard </h2>
        <div class="row">
            <div class="col-md-6">
                <x-input.select_live model="filterOpd" label="Filter Opd">
                    <option value="">-- Semua data --</option>
                    @foreach ($dataOpd as $opd)
                        <option value="{{ $opd->id }}">{{ $opd->nama }}</option>
                    @endforeach
                </x-input.select_live>
            </div>
            <div class="col-md-6">
                <x-input.select_live model="filterKategori" label="Filter Kategori">
                    <option value="">-- Semua data --</option>
                    @foreach ($listKategori as $kategori)
                        <option value="{{ $kategori }}">{{ $kategori }}</option>
                    @endforeach
                </x-input.select_live>
            </div>
        </div>
    </div>
    <div class="row">
        <div>
            <div class="bg-white rounded-md custom-shadow">
            </div>
        </div>
        <div class="col-md-6">
            <div class="bg-white rounded-md custom-shadow">
                <div class="p-4">
                    <h2>Indikator {{ $filterKategori ?? 'Semua Kategori' }} {{ $labelFilter ?? 'Opd' }}</h2>
                </div>
                <div class="px-4 pb-4">
                    <ul class="list-indikator-jaringan">
                        <li>
                            <ul>
                                <li>
                                    <div class="indicator-box">
                                        <div class="indicator-bar">
                                            <div class="indicator-bar-line h-[{{ $jaringanlebih5tahun }}%] bg-rose-500">
                                                {{ $jaringanlebih5tahun }} %</div>
                                        </div>
                                        <span> > 5 Tahun</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="indicator-box">
                                        <div class="indicator-bar">
                                            <div
                                                class="indicator-bar-line h-[{{ $jaringan1sampai5tahun }}%] bg-yellow-500">
                                                {{ $jaringan1sampai5tahun }} %</div>
                                        </div>
                                        <span>1 - 5 Tahun</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="indicator-box">
                                        <div class="indicator-bar">
                                            <div
                                                class="indicator-bar-line h-[{{ $jaringankurang1tahun }}%] bg-green-500">
                                                {{ $jaringankurang1tahun }} %</div>
                                        </div>
                                        <span>
                                            < 1 Tahun</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="indicator-box">
                                        <div class="indicator-bar">
                                            <div class="indicator-bar-line h-[90%] bg-sky-500">10</div>
                                        </div>
                                        <span>Digunakan</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="indicator-box">
                                        <div class="indicator-bar">
                                            <div class="indicator-bar-line h-[70%] bg-indigo-500">9</div>
                                        </div>
                                        <span>Tidak digunakan</span>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


</div>
