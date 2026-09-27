@extends('adminlte::page')

@section('title','Data Kelas')
    
@section('content_header')
    <h1>Data Kelas</h1>
@stop

@section('content')
<section class="content">
    <div class="container-fluid">

        @if (session('success'))
            <div class="alert alert-success">{{ session('success')}}</div>
        @endif

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Kelas</h3>
                <div class="card-tools">
                    <a href="{{ route('kelas.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Tambah Kelas
                    </a>
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kelas</th>
                            <th>Wali Kelas</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse ($kelas as $kelas)
                    </tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $kelas->nama }}</td>
                        <td>{{ $kelas->guru->nama_guru ?? 'Belum ada Wali Kelas'}}</td>
                        <td>
                            <a href="{{  route('kelas.edit', $kelas->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('kelas.destroy', $kelas->id) }}" method="POST" style="display: inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin Ingin Menghapus Kelas {{ $kelas->nama }}')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    <tr>
                            
                    @empty
                        <tr>
                            <td  colspan="4" class="text-center">Data Kelas Belum Tersedia!</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection