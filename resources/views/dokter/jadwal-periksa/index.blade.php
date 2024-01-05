<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Jadwal Periksa
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
                    <a href="{{ route('jadwal-periksa.create') }}" type="button" class="btn btn-outline-primary">Tambah Data</a>
                    <table class="table table-hover mt-3">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama Dokter</th>
                            <th scope="col">Hari</th>
                            <th scope="col">Jam Mulai</th>
                            <th scope="col">Jam Selesai</th>
                            <th scope="col">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($no = 1)
                        @foreach($jadwal as $index => $data)
                            <tr>
                                <th scope="row">{{ $no++ }}</th>
                                <td>{{ auth()->user()->dokter->nama }}</td>
                                <td>{{ $data->hari }}</td>
                                <td>{{ $data->jam_mulai }}</td>
                                <td>{{ $data->jam_selesai }}</td>
                                <td>
                                    <a class="btn btn-success rounded-pill px-3" href="{{ route('jadwal-periksa.edit', $data->id) }}">Ubah</a>
                                    <a class="btn btn-outline-danger rounded-pill px-3" href="{{ route('jadwal-periksa.index') }}"
                                       onclick="event.preventDefault();document.getElementById('delete-form-{{$index}}').submit();">
                                        Delete
                                    </a>
                                </td>
                                <form id="delete-form-{{$index}}"
                                      + action="{{route('jadwal-periksa.destroy', $data->id)}}"
                                      method="post">
                                    @csrf @method('DELETE')
                                </form>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
