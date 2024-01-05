<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Master Data - Obat') }}
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
                    <form action="{{ route('master.obat.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <label for="inputNama" class="form-label fw-bold">
                                Nama
                            </label>
                            <div>
                                <input type="text" class="form-control" name="nama_obat" id="inputNama" placeholder="Nama" autofocus>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <label for="inputKemasan" class="form-label fw-bold">
                                Kemasan
                            </label>
                            <div>
                                <input type="text" class="form-control" name="kemasan" id="inputKemasan"
                                       placeholder="Kemasan">
                            </div>
                        </div>
                        <div class="row mt-1">
                            <label for="inputHarga" class="form-label fw-bold">
                                Harga
                            </label>
                            <div>
                                <input type="number" class="form-control" name="harga" id="inputHarga" placeholder="Harga">
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
