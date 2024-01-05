<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Daftar Poli
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
                    <form action="{{ route('daftar-poli.update', $daftarPoli->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <label for="inputNorm" class="form-label fw-bold">
                                Nomor Rekam Medis
                            </label>
                            <div>
                                <input type="text" class="form-control" name="no_rm" id="inputNorm" disabled value="{{auth()->user()->pasien->no_rm}}">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <label for="inputPoli" class="form-label fw-bold">
                                Pilih Poli
                            </label>
                            <div>
                                <select class="form-control form-select" aria-label="Poli Select" name="id_poli" id="inputPoli" required>
                                    <option disabled>-- Pilih Poli --</option>
                                    @foreach($poli as $p)
                                        <option value="{{ $p->id }}" {{ $p->id === $daftarPoli->jadwal->dokter->poli->id ? 'selected' : '' }}>{{ $p->nama_poli }} ({{$p->keterangan}})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <label for="inputJadwal" class="form-label fw-bold">
                                Pilih Jadwal
                            </label>
                            <div>
                                <select class="form-control form-select" aria-label="Poli Select" name="id_jadwal" id="inputJadwal" required>
                                    <option disabled>-- Pilih Jadwal --</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <label for="keluhan" class="form-label fw-bold">
                                Keluhan
                            </label>
                            <div>
                                <textarea class="form-control" name="keluhan" id="keluhan" required>{{$daftarPoli->keluhan}}</textarea>
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
    @push('scripts')
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script type="text/javascript">
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(document).ready(function () {
                const getJadwal = (id_poli) => {
                    $.ajax({
                        url:"{{ route('get-jadwal') }}",
                        type:"POST",
                        data: {
                            id: id_poli
                        },

                        success:function (data) {
                            const select = $('#inputJadwal');
                            select.empty();
                            $.each(data,function(index,jadwal){

                                select.append('<option value="'+jadwal.id+'">'+jadwal.hari+' ('+jadwal.jam_mulai+'-'+jadwal.jam_selesai+ ')</option>');
                            })
                            const id_jadwal = {{$daftarPoli->id_jadwal}};
                            select.val(id_jadwal);
                        }
                    })
                }

                const id_poli = {{$daftarPoli->jadwal->dokter->poli->id}};
                getJadwal(id_poli);

                $('#inputPoli').on('change',function(e) {
                    const id_poli = e.target.value;
                    getJadwal(id_poli);
                });
            });
        </script>
    @endpush
</x-app-layout>
