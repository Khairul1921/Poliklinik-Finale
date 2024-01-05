<div class="row mt-2">
    @if(!empty($jadwal))
        <input type="hidden" name="jadwal[{{$idx}}][id]" value="{{ $jadwal ? $jadwal->id : '' }}">
    @endif
    <div class="col-md-3">
        <select class="form-select" aria-label="Select Hari" name="jadwal[{{$idx}}][hari]" required>
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
            <input type="time" class="form-control" name="jadwal[{{$idx}}][jam_mulai]" value="{{ !empty($jadwal) && !empty($jadwal->jam_mulai) ? $jadwal->jam_mulai : ''  }}" required/>
        </div>
        <div id="jamMulaiHelp" class="form-text">Jam mulai</div>
    </div>
    <div class="col-md-4">
        <div class="input-group">
            <input type="time" class="form-control" name="jadwal[{{$idx}}][jam_selesai]" value="{{ !empty($jadwal) && !empty($jadwal->jam_selesai) ? $jadwal->jam_selesai : ''  }}" required/>
        </div>
        <div id="jamSelesaiHelp" class="form-text">Jam Selesai</div>
    </div>
    <span class="col-auto btn input-group-addon delete-field">(-)</span>
</div>
