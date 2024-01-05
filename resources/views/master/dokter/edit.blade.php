<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Master Data - Dokter') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if($errors->any())
                <div class="alert alert-danger">
                    {!! implode('<br>', $errors->all(':message')) !!}
                </div>
            @endif
            @php
                $error_message = Session::get('error');
            @endphp
                <p>{{$error_message}}</p>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('master.dokter.update', $dokter->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <label for="inputNama" class="form-label fw-bold">
                                Nama
                            </label>
                            <div>
                                <input type="text" class="form-control" name="nama" id="inputNama" placeholder="Nama"
                                       value="{{ $dokter->nama ?: '' }}">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <label for="inputAlamat" class="form-label fw-bold">
                                Alamat
                            </label>
                            <div>
                                <input type="text" class="form-control" name="alamat" id="inputAlamat"
                                       placeholder="Alamat" value="{{ $dokter->alamat ?: '' }}">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <label for="inputNoHp" class="form-label fw-bold">
                                No. HP
                            </label>
                            <div>
                                <input type="tel" class="form-control" name="no_hp" id="inputNoHp" placeholder="NoHp" value="{{ $dokter->no_hp }}">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <label for="inputPoli" class="form-label fw-bold">
                                Poli
                            </label>
                            <div>
                                <select class="form-control form-select" aria-label="Poli Select" name="id_poli">
                                    <option disabled>-- Pilih Poli --</option>
                                    @foreach($poli as $p)
                                        <option value="{{ $p->id }}" {{ $dokter->id_poli === $p->id ? 'selected' : '' }}>{{ $p->nama_poli }} ({{$p->keterangan}})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group mt-3" id="jadwal-block">
                            <label for="jadwalPeriksa" class="form-label fw-bold">Jadwal Periksa</label>
                            <div class="fields">
                                @foreach($dokter->jadwalPeriksa as $idx => $jadwal)
                                    @include('master.dokter.form-jadwal', ['idx' => $idx, 'jadwal' => $jadwal])
                                @endforeach
                            </div>
                            <div class="d-grid mt-2" id="btn-add">
                                <button class="btn btn-outline-primary input-group-addon add-field" type="button">(+) Tambah Jadwal</button>
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            let index = 1;
            $('.add-field').click(function () {
                $('.fields').append(`@include('master.dokter.form-jadwal', ['idx' => 'idx', 'jadwal' => []])`.replace(/idx/g, index));
                index++;
            });

            $('.fields').on('click', '.delete-field', function () {
                $(this).parent().remove();
            });
        });
    </script>
</x-app-layout>
