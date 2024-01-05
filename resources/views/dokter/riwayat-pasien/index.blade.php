<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Riwayat Pasien
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
                    <table class="table table-hover mt-3" id="table-riwayat">
                        <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Pasien</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">No. KTP</th>
                            <th scope="col">No. Telp</th>
                            <th scope="col">No. RM</th>
                            <th scope="col">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($pasien as $index => $data)
                            <tr>
                                <th scope="row">{{ $index+1 }}</th>
                                <td>{{ $data->nama }}</td>
                                <td>{{ $data->alamat }}</td>
                                <td>{{ $data->no_ktp }}</td>
                                <td>{{ $data->no_hp }}</td>
                                <td>{{ $data->no_rm }}</td>
                                <td>
                                    <button class="btn btn-success rounded-pill px-3 viewdetails" type="button" data-id='{{ $data->id }}'>Detail</button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal-detail" tabindex="-1" aria-labelledby="modal-detail" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modal-detail">Riwayat Detail</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table id="table-detail" class="table">
                        <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Tgl Periksa</th>
                            <th scope="col">Nama Pasien</th>
                            <th scope="col">Nama Dokter</th>
                            <th scope="col">Keluhan</th>
                            <th scope="col">Catatan</th>
                            <th scope="col">Obat</th>
                            <th scope="col">Biaya Periksa</th>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script type='text/javascript'>
        $(document).ready(function(){

            $('#table-riwayat').on('click','.viewdetails',function(){
                const empid = $(this).attr('data-id');

                if(empid > 0){

                    // AJAX request
                    var url = "{{ route('riwayat-pasien.show',[':empid']) }}";
                    url = url.replace(':empid',empid);

                    // Empty modal data
                    $('#table-detail tbody').empty();

                    $.ajax({
                        url: url,
                        dataType: 'json',
                        success: function(response){

                            // Add employee details
                            $('#table-detail tbody').html(response.html);

                            // Display Modal
                            $('#modal-detail').modal('show');
                        }
                    });
                }
            });

        });
    </script>
</x-app-layout>
