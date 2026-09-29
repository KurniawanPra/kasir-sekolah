@extends('adminlte::page')

@section('title', 'Edit Transaksi')

@section('content_header')
    <h1>Edit Transaksi Pembayaran</h1>
@stop

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title">Form Edit Transaksi: {{ $transaksi->kode_transaksi }}</h3>
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

            <form action="{{ route('transaksi.update', $transaksi->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                        <label>Nama Siswa</label>
                        <select name="siswa_id" id="select_siswa" class="form-control" required>
                            @foreach($siswas as $siswa)
                                <option value="{{ $siswa->id }}"
                                    data-spp="{{ $siswa->kelas->nominal_spp ?? 0 }}"
                                    {{ $transaksi->siswa_id == $siswa->id ? 'selected' : '' }}>
                                    {{ $siswa->nama_siswa }} (Kelas: {{ $siswa->kelas->name ?? '-' }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Tagihan Bulan</label>
                        <input type="month" name="bulan_tagihan" class="form-control"
                            value="{{ $transaksi->bulan_tagihan }}" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nominal Bayar (Rp)</label>
                                <input type="number" name="nominal_bayar" class="form-control"
                                    value="{{ $transaksi->nominal_bayar }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Target SPP Kelas (Info)</label>
                                <input type="text" id="info_spp" class="form-control"
                                    value="Rp {{ number_format($transaksi->siswa->kelas->nominal_spp ?? 0, 0, ',', '.') }}" readonly>
                                <small class="text-muted">Jika nominal bayar di bawah angka ini, status = Belum Lunas.</small>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea name="keterangan" class="form-control">{{ $transaksi->keterangan }}</textarea>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-warning">Update Transaksi</button>
                    <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</section>
@stop

@section('js')
<script>
document.getElementById('select_siswa').addEventListener('change', function() {
    var selectedOption = this.options[this.selectedIndex];
    var spp = selectedOption.getAttribute('data-spp') || 0;
    var formatRupiah = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(spp);
    document.getElementById('info_spp').value = formatRupiah;
});
</script>
@stop
