<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Master Data - Pasien') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if($errors->any())
                <div class="alert alert-danger">
                    {!! implode('<br>', $errors->all(':message')) !!}
                </div>
            @endif
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('master.pasien.update', $pasien->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <label for="inputNama" class="form-label fw-bold">
                                Nama
                            </label>
                            <div>
                                <input type="text" class="form-control" name="nama" id="inputNama" placeholder="Nama"
                                       value="{{ $pasien->nama ?: '' }}">
                            </div>
                        </div>
                        <div class="row mt-1">
                            <label for="inputAlamat" class="form-label fw-bold">
                                Alamat
                            </label>
                            <div>
                                <input type="text" class="form-control" name="alamat" id="inputAlamat"
                                       placeholder="Alamat" value="{{ $pasien->alamat ?: '' }}">
                            </div>
                        </div>
                        <div class="row mt-1">
                            <label for="inputNoKtp" class="form-label fw-bold">
                                No. KTP
                            </label>
                            <div>
                                <input type="text" class="form-control" name="no_ktp" id="inputNoKtp" placeholder="No. KTP" value="{{ $pasien->no_ktp ?: '' }}">
                            </div>
                        </div>
                        <div class="row mt-1">
                            <label for="inputNoHp" class="form-label fw-bold">
                                No. HP
                            </label>
                            <div>
                                <input type="text" class="form-control" name="no_hp" id="inputNoHp" placeholder="NoHp" value="{{ $pasien->no_hp ?: '' }}">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class=col>
                                <button type="submit" class="btn btn-outline-primary rounded-pill px-3 mt-auto" name="simpan">
                                    Simpan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
