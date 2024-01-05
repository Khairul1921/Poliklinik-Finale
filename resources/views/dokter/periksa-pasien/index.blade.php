<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Daftar Periksa Pasien
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                    @php
                        Session::forget('success');
                    @endphp
                </div>
            @endif
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="table table-hover mt-3">
                        <thead>
                        <tr>
                            <th scope="col">No Urut</th>
                            <th scope="col">Nama Pasien</th>
                            <th scope="col">Keluhan</th>
                            <th scope="col">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($daftar as $index => $data)
                            <tr>
                                <th scope="row">{{ $data->no_antrian }}</th>
                                <td>{{ $data->pasien->nama }}</td>
                                <td>{{ $data->keluhan }}</td>
                                <td>
                                    @if(empty($data->periksa))
                                        <a class="btn btn-primary rounded-pill px-3" href="{{ route('periksa-pasien.periksa', $data->id) }}">Periksa</a>
                                    @else
                                        <a class="btn btn-success rounded-pill px-3" href="{{ route('periksa-pasien.edit', $data->id) }}">Ubah</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
