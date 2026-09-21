@extends('adminlte::page')

@section('title', 'Edit Guru')

@section('content_header')
    <h1>Edit Guru</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-body">

            <form action="{{ route('guru.update', $guru->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nama_guru">Nama Guru</label>
                    <input
                        type="text"
                        name="nama_guru"
                        value="{{ old('nama_guru', $guru->nama_guru) }}"
                        class="form-control @error('nama_guru') is-invalid @enderror"
                        required
                    >

                    @error('nama_guru')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="nip">NIP</label>
                    <input
                        type="text"
                        name="nip"
                        value="{{ old('nip', $guru->nip) }}"
                        class="form-control @error('nip') is-invalid @enderror"
                        required
                    >

                    @error('nip')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="jabatan">Jabatan</label>
                    <input
                        type="text"
                        name="jabatan"
                        value="{{ old('jabatan', $guru->jabatan) }}"
                        class="form-control @error('jabatan') is-invalid @enderror"
                        required
                    >

                    @error('jabatan')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="mata_pelajaran">Mata Pelajaran</label>
                    <input
                        type="text"
                        name="mata_pelajaran"
                        value="{{ old('mata_pelajaran', $guru->mata_pelajaran) }}"
                        class="form-control @error('mata_pelajaran') is-invalid @enderror"
                        required
                    >

                    @error('mata_pelajaran')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="no_hp">No HP</label>
                    <input
                        type="text"
                        name="no_hp"
                        value="{{ old('no_hp', $guru->no_hp) }}"
                        class="form-control @error('no_hp') is-invalid @enderror"
                        required
                    >

                    @error('no_hp')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email', $guru->email) }}"
                        class="form-control @error('email') is-invalid @enderror"
                        required
                    >

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input
                        type="text"
                        name="alamat"
                        value="{{ old('alamat', $guru->alamat) }}"
                        class="form-control @error('alamat') is-invalid @enderror"
                        required
                    >

                    @error('alamat')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="status">Status</label>

                    <select
                        name="status"
                        class="form-control @error('status') is-invalid @enderror"
                    >
                        <option value="aktif" {{ old('status', $guru->status) == 'aktif' ? 'selected' : '' }}>
                            Aktif
                        </option>

                        <option value="nonaktif" {{ old('status', $guru->status) == 'nonaktif' ? 'selected' : '' }}>
                            Non-Aktif
                        </option>
                    </select>

                    @error('status')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">
                    Update
                </button>

                <a href="{{ route('guru.index') }}" class="btn btn-secondary">
                    Batal
                </a>

            </form>

        </div>
    </div>

@stop