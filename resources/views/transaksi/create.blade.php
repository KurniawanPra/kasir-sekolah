@extends('adminlte::page')

@section('title', 'Tambah Transaksi')

@section('content_header')
    <h1>Bayar SPP</h1>
@stop

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Form Pembayaran SPP</h3>
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

            <form action="{{ route('transaksi.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label>Pilih Siswa</label>
                        <select name="siswa_id" id="select_siswa" class="form-control select2" required>
                            <option value="">-- Cari Nama Siswa --</option>
                            @foreach($siswas as $siswa)
                                <option value="{{ $siswa->id }}"
                                    data-kelas="{{ $siswa->kelas->name ?? '-' }}"
                                    data-guru="{{ $siswa->kelas->guru->nama_guru ?? '-' }}"
                                    data-spp="{{ $siswa->kelas->nominal_spp ?? '0' }}">
                                    {{ $siswa->nama_siswa }} - {{ $siswa->nis }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Kelas</label>
                                <input type="text" id="info_kelas" class="form-control" readonly placeholder="Otomatis...">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Wali Kelas</label>
                                <input type="text" id="info_guru" class="form-control" readonly placeholder="Otomatis...">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="text-primary">Biaya SPP (Info)</label>
                                <input type="text" id="info_spp_text" class="form-control text-bold text-primary" readonly placeholder="Rp 0">
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tagihan Bulan</label>
                                <input type="month" name="bulan_tagihan" class="form-control" required value="{{ date('Y-m') }}">
                                <small class="text-muted">Klik ikon kalender untuk memilih bulan & tahun.</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Uang Yang Dibayar (Rp)</label>
                                <input type="number" name="nominal_bayar" id="input_bayar" class="form-control" required>
                                <small class="text-muted">Nominal otomatis terisi sesuai kelas, ubah jika membayar sebagian.</small>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Keterangan (Opsional)</label>
                        <textarea name="keterangan" class="form-control" rows="2"></textarea>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan Pembayaran</button>
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
    var kelas = selectedOption.getAttribute('data-kelas') || '-';
    var guru = selectedOption.getAttribute('data-guru') || '-';
    var spp = selectedOption.getAttribute('data-spp') || 0;

    document.getElementById('info_kelas').value = kelas;
    document.getElementById('info_guru').value = guru;

    var formatRupiah = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(spp);
    document.getElementById('info_spp_text').value = formatRupiah;
    document.getElementById('input_bayar').value = spp;
});
</script>
@stop
