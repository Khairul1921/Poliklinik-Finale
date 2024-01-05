<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Periksa Pasien
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
                    <form action="{{ route('periksa-pasien.periksa', $daftar->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <label for="inputNama" class="form-label fw-bold">
                                Nama Pasien
                            </label>
                            <div>
                                <input type="text" class="form-control" name="nama_obat" id="inputNama" placeholder="Nama"
                                       value="{{ $daftar->pasien->nama ?: '' }}" disabled>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <label for="inputTanggal" class="form-label fw-bold">
                                Tanggal Periksa
                            </label>
                            <div>
                                <input type="date" class="form-control" name="tgl_periksa" id="inputTanggal" autofocus>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <label for="inputCatatan" class="form-label fw-bold">
                                Catatan
                            </label>
                            <div>
                                <input type="text" class="form-control" name="catatan" id="inputCatatan" placeholder="catatan">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <label for="inputCatatan" class="form-label fw-bold">
                                Obat
                            </label>
                            <div>
                                <select class="form-select" multiple aria-label="Multiple select example" name="obat[]">
                                    @foreach($obat as $data)
                                        <option value="{{$data->id}}">{{ $data->nama_obat }} - {{ $data->kemasan }} - Rp {{ $data->harga }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class=col>
                                <button type="submit" class="btn btn-outline-primary rounded-pill px-3 mt-auto">
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
