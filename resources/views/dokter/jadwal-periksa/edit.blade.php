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
                    <form action="{{ route('jadwal-periksa.update', $jadwal->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group mt-3" id="jadwal-block">
                            <label for="jadwalPeriksa" class="form-label fw-bold">Jadwal Periksa</label>
                            <div class="fields">
                                <div class="row mt-2">
                                    <div class="col-md-3">
                                        <select class="form-select" aria-label="Select Hari" name="hari" required>
                                            @php
                                                $hari = array('Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu');
                                            @endphp
                                            <option selected disabled>-- Pilih Hari --</option>
                                            @foreach($hari as $h)
                                                <option value="{{ $h }}" {{ !empty($jadwal) && $jadwal->hari === $h ? 'selected' : '' }}>{{ ucfirst($h) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group">
                                            <input type="time" class="form-control" name="jam_mulai" value="{{ !empty($jadwal) && !empty($jadwal->jam_mulai) ? $jadwal->jam_mulai : ''  }}" required/>
                                        </div>
                                        <div id="jamMulaiHelp" class="form-text">Jam mulai</div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group">
                                            <input type="time" class="form-control" name="jam_selesai" value="{{ !empty($jadwal) && !empty($jadwal->jam_selesai) ? $jadwal->jam_selesai : ''  }}" required/>
                                        </div>
                                        <div id="jamSelesaiHelp" class="form-text">Jam Selesai</div>
                                    </div>
                                    <span class="col-auto btn input-group-addon delete-field">(-)</span>
                                </div>

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
