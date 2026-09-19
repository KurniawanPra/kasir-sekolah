@extends('adminlte::page')

@section('title', 'Edit Data Kelas')

@section('content_header')
    <h1>Edit Data Kelas</h1>
@stop

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="card card-primary"> <div class="card-header">
                <h3 class="card-title">Form Edit Kelas</h3>
            </div>
            
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('kelas.update', $kelas->id) }}" method="POST">
                @csrf
                @method('PUT') <div class="card-body">
                    <div class="form-group">
                        <label>Nama Kelas</label>
                        <input type="text" name="nama" class="form-control" 
                               value="{{ old('nama', $kelas->nama) }}" required>
                    </div>

                    <div class="form-group">
                        <label>Wali Kelas</label>
                        <select name="guru_id" class="form-control" required>
                            <option value="">-- Pilih Wali Kelas --</option>
                            @foreach($guru as $g)
                                <option value="{{ $g->id }}" {{ $kelas->guru_id == $g->id ? 'selected' : '' }}>
                                    {{ $g->nama_guru }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('kelas.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</section>
@stop