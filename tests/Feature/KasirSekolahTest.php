<?php

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\User;

test('admin can access master data and user management', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $response = $this->actingAs($admin)->get('/users');
    $response->assertStatus(200);

    $response = $this->actingAs($admin)->get('/kelas');
    $response->assertStatus(200);

    $response = $this->actingAs($admin)->get('/guru');
    $response->assertStatus(200);

    $response = $this->actingAs($admin)->get('/siswa');
    $response->assertStatus(200);
});

test('guru cannot access user management but can access transaksi', function () {
    $guru = User::factory()->create(['role' => 'guru']);

    $response = $this->actingAs($guru)->get('/users');
    $response->assertRedirect('/dashboard');
    $response->assertSessionHas('error');

    $response = $this->actingAs($guru)->get('/transaksi');
    $response->assertStatus(200);
});

test('siswa cannot access master data or transaksi', function () {
    $siswa = User::factory()->create(['role' => 'siswa']);

    $response = $this->actingAs($siswa)->get('/users');
    $response->assertRedirect('/dashboard');

    $response = $this->actingAs($siswa)->get('/transaksi');
    $response->assertRedirect('/dashboard');
});

test('transaksi determines lunas or belum lunas based on nominal spp', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $guru = Guru::create([
        'nama_guru' => 'Guru Test',
        'nip' => '123456789',
        'jabatan' => 'Wali',
        'mata_pelajaran' => 'Web',
        'no_hp' => '08123456789',
        'email' => 'guru.test@example.com',
        'alamat' => 'Jl Test',
        'status' => 'aktif',
    ]);

    $kelas = Kelas::create([
        'name' => 'X RPL',
        'guru_id' => $guru->id,
        'nominal_spp' => 100000,
    ]);

    $siswa = Siswa::create([
        'nama_siswa' => 'Siswa Test',
        'nis' => '987654',
        'jurusan' => 'RPL',
        'kelas_id' => $kelas->id,
        'email' => 'siswa.test@example.com',
    ]);

    // Test lunas
    $response = $this->actingAs($admin)->post('/transaksi', [
        'siswa_id' => $siswa->id,
        'bulan_tagihan' => '2026-10',
        'nominal_bayar' => 100000,
    ]);

    $response->assertRedirect(route('transaksi.index'));
    $this->assertDatabaseHas('transaksis', [
        'siswa_id' => $siswa->id,
        'status' => 'Lunas',
    ]);

    // Test belum lunas
    $response = $this->actingAs($admin)->post('/transaksi', [
        'siswa_id' => $siswa->id,
        'bulan_tagihan' => '2026-11',
        'nominal_bayar' => 50000,
    ]);

    $response->assertRedirect(route('transaksi.index'));
    $this->assertDatabaseHas('transaksis', [
        'siswa_id' => $siswa->id,
        'status' => 'Belum Lunas',
    ]);
});

test('admin can stream siswa pdf report', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $response = $this->actingAs($admin)->get('/siswa/cetak-pdf');
    $response->assertStatus(200);
});
