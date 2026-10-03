<?php

namespace Database\Seeders;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Akun Pengguna Bawaan
        User::firstOrCreate([
            'email' => 'admin@gmail.com',
        ], [
            'name' => 'Administrator',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::firstOrCreate([
            'email' => 'guru@gmail.com',
        ], [
            'name' => 'Guru Pengajar',
            'password' => Hash::make('password'),
            'role' => 'guru',
        ]);

        User::firstOrCreate([
            'email' => 'siswa@gmail.com',
        ], [
            'name' => 'Siswa Sekolah',
            'password' => Hash::make('password'),
            'role' => 'siswa',
        ]);

        // 2. Data Guru Contoh
        $guru = Guru::firstOrCreate([
            'nip' => '198501012010011001',
        ], [
            'nama_guru' => 'Budi Santoso, S.Pd',
            'jabatan' => 'Wali Kelas',
            'mata_pelajaran' => 'Pemrograman Web',
            'no_hp' => '081234567890',
            'email' => 'budi.santoso@sekolah.sch.id',
            'alamat' => 'Jl. Pendidikan No. 12',
            'status' => 'aktif',
        ]);

        // 3. Data Kelas Contoh
        $kelas = Kelas::firstOrCreate([
            'name' => 'XII RPL 1',
        ], [
            'guru_id' => $guru->id,
            'nominal_spp' => 150000,
        ]);

        // 4. Data Siswa Contoh
        $siswa = Siswa::firstOrCreate([
            'nis' => '10293847',
        ], [
            'nama_siswa' => 'Rinko Pratama',
            'jurusan' => 'Rekayasa Perangkat Lunak',
            'kelas_id' => $kelas->id,
            'email' => 'rinko@siswa.sch.id',
        ]);

        // 5. Data Transaksi Contoh
        Transaksi::firstOrCreate([
            'kode_transaksi' => 'TRX-1001',
        ], [
            'siswa_id' => $siswa->id,
            'bulan_tagihan' => date('Y-m'),
            'nominal_bayar' => 150000,
            'status' => 'Lunas',
            'tanggal_bayar' => now(),
            'keterangan' => 'Pembayaran SPP Bulan Ini',
        ]);
    }
}
