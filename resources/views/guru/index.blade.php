@extends('adminlte::page')

@section('title', 'Data Guru')

@section('content_header')
    <h1>Data Siswa</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Guru</h3>
            <div class="card-tools">
                <a href="#" class="btn btn-danger btn-sm" target='_blank'>
                    <i class="fas fa-file-pdf"></i> Cetak PDF
                </a>
                <a href="{{ route('guru.create') }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-plus"></i> Tambah Guru
                </a>
            </div>
        </div>
        <div class="card-body pb-0">
            <form action="{{ route('guru.index') }}" method="GET" class="mb-3">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari Nama Guru atau NIP" value="{{ request('search') }}">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search"></i> Cari
                        </button>
                    </div>
                </div>
            </form>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button class="close" type="button" date-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
        </div>

        <div class="card-body table-responsive p-0">
            <table class="table table-hover table-nowrap">
                <thead>
                    <tr>
                        <th style="width: 10px">No</th>
                        <th>Nama Guru</th>
                        <th>NIP</th>
                        <th>Jabatan</th>
                        <th>Mata Pelajaran</th>
                        <th>No HP</th>
                        <th>Alamat</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($gurus as $key => $guru)
                        <tr>
                            <td>{{ $gurus->firstItem() + $key }}</td>
                            <td>{{ $guru->nama_guru }}</td>
                            <td>{{ $guru->nip }}</td>
                            <td>{{ $guru->jabatan }}</td>
                            <td>{{ $guru->mata_pelajaran }}</td>
                            <td>{{ $guru->no_hp }}</td>
                            <td>{{ $guru->alamat }}</td>
                            <td>{{ $guru->status }}</td>
                            <td>
                                <a href="{{ route('guru.show', $guru->id) }}" title="Lihat" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('guru.edit', $guru->id) }}" title="Edit" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('guru.destroy', $guru->id) }}" method="POST" style="display: inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini')" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center">Data Tidak Ditemukan!</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="card-footer clearfix">
            {!! $gurus->appends(request()->query())->links('pagination::bootstrap-5') !!}
        </div>
    </div>
@stop