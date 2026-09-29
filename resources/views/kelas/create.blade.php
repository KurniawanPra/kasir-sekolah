@extends('adminlte::page')

@section('title', 'Tambah Data Kelas')

@section('content_header')
    <h1>Data Kelas</h1>
@stop

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Form Kelas</h3>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger m-3">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('kelas.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label>Nama Kelas</label>
                        <input type="text" name="name" class="form-control" placeholder="Contoh: X RPL 1" value="{{ old('name') }}" required>
                    </div>

                    <div class="form-group">
                        <label>Biaya SPP per Bulan (Rp)</label>
                        <input type="number" name="nominal_spp" class="form-control" value="{{ old('nominal_spp') }}" placeholder="Contoh: 150000" required>
                    </div>

                    <div class="form-group">
                        <label>Wali Kelas</label>
                        <select name="guru_id" class="form-control" required>
                            <option value="">-- Pilih Wali Kelas --</option>
                            @foreach($guru as $g)
                                <option value="{{ $g->id }}" {{ old('guru_id') == $g->id ? 'selected' : '' }}>
                                    {{ $g->nama_guru }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('kelas.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</section>
@stop