@extends('adminlte::page')

@section('title', 'Data Transaksi')

@section('content_header')
    <h1>Riwayat Transaksi</h1>
@stop

@section('content')
<section class="content">
    <div class="container-fluid">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Pembayaran SPP</h3>
                <div class="card-tools">
                    <a href="{{ route('transaksi.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Tambah Transaksi
                    </a>
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Siswa</th>
                            <th>Kelas</th>
                            <th>Bulan</th>
                            <th>Jumlah</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transaksis as $trx)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $trx->kode_transaksi }}</td>
                            <td>{{ $trx->siswa->nama_siswa ?? '-' }}</td>
                            <td>{{ $trx->siswa->kelas->name ?? '-' }}</td>
                            <td>{{ \Carbon\Carbon::parse($trx->bulan_tagihan)->translatedFormat('F Y') }}</td>
                            <td>Rp {{ number_format($trx->nominal_bayar, 0, ',', '.') }}</td>
                            <td>
                                @if($trx->status == 'Lunas')
                                    <span class="badge badge-success">Lunas</span>
                                @else
                                    <span class="badge badge-danger">Belum Lunas</span>
                                @endif
                            </td>
                            <td>{{ $trx->created_at->format('d-m-Y') }}</td>
                            <td>
                                <a href="{{ route('transaksi.edit', $trx->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('transaksi.destroy', $trx->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus data transaksi ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center">Belum ada data transaksi.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@stop
