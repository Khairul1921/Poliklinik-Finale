<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Jadwal Periksa
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if($errors->any())
                <div class="alert alert-danger">
                    {!! implode('<br>', $errors->all(':message')) !!}
                </div>
            @endif
            @if(session()->has('error'))
                <div class="alert alert-danger">
                    {{ session()->get('error') }}
                </div>
            @endif
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('jadwal-periksa.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mt-3" id="jadwal-block">
                            <label for="jadwalPeriksa" class="form-label fw-bold">Jadwal Periksa</label>
                            <div class="fields">
                                @include('dokter.jadwal-periksa.form-jadwal', ['idx' => 0])
                            </div>
                                <div class="d-grid" id="btn-add">
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
                $('.fields').append(`@include('dokter.jadwal-periksa.form-jadwal', ['idx' => 'idx'])`.replace(/idx/g, index));
                index++;
            });

            $('.fields').on('click', '.delete-field', function () {
                $(this).parent().remove();
            });
        });
    </script>
</x-app-layout>
