<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Master Data - Obat') }}
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
                    <a href="{{ route('master.obat.create') }}" type="button" class="btn btn-outline-primary">Tambah Data</a>
                    <table class="table table-hover mt-3">
                        <!--thead atau baris judul-->
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Kemasan</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Aksi</th>
                        </tr>
                        </thead>
                        <!--tbody berisi isi tabel sesuai dengan judul atau head-->
                        <tbody>
                        <!-- Kode PHP untuk menampilkan semua isi dari tabel urut-->
                            @php($no = 1)
                            @foreach($obat as $index => $data)
                                <tr>
                                    <th scope="row">{{ $no++ }}</th>
                                    <td>{{ $data->nama_obat }}</td>
                                    <td>{{ $data->kemasan }}</td>
                                    <td>{{ $data->harga }}</td>
                                    <td>
                                        <a class="btn btn-success rounded-pill px-3" href="{{ route('master.obat.edit', $data->id) }}">Ubah</a>
                                        <a class="btn btn-outline-danger rounded-pill px-3" href="{{ route('master.obat.index') }}"
                                           onclick="event.preventDefault();document.getElementById('delete-form-{{$index}}').submit();">
                                            Delete
                                        </a>
                                    </td>
                                    <form id="delete-form-{{$index}}"
                                          + action="{{route('master.obat.destroy', $data->id)}}"
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
