@extends('adminlte::page')

@section('title', 'Data Kelas')

@section('content_header')
    <h1>Data Kelas</h1>
@stop

@section('content')
<section class="content">
    <div class="container-fluid">

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
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
                            <th style="width: 10px">No</th>
                            <th>Nama Kelas</th>
                            <th>Biaya SPP (Rp)</th>
                            <th>Wali Kelas</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse ($kelas as $k)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $k->name }}</td>
                        <td>Rp {{ number_format($k->nominal_spp, 0, ',', '.') }}</td>
                        <td>{{ $k->guru->nama_guru ?? 'Belum ada Wali Kelas' }}</td>
                        <td>
                            <a href="{{ route('kelas.edit', $k->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('kelas.destroy', $k->id) }}" method="POST" style="display: inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus kelas {{ $k->name }}?')" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Data Kelas Belum Tersedia!</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection