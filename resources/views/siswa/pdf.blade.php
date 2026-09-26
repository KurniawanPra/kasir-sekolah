<!DOCTYPE html>
<html>
<head>
    <title>Laporan Data Siswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
            vertical-align: middle;
        }
        th {
            background-color: #f2f2f2;
            text-align: center;
        }
        .foto-siswa {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 50%;
        }
    </style>
</head>
<body>

    <div class="header">
        <h2>Laporan Data Siswa</h2>
        <p>Aplikasi Kasir Sekolah</p>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%">No</th>
                <th style="width: 10%">Foto</th>
                <th>NIS</th>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>Jurusan</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach($siswas as $index => $siswa)
            <tr>
                <td style="text-align: center;">{{ $index + 1 }}</td>
                <td style="text-align: center;">
                    @if($siswa->foto && file_exists(public_path('storage/' . $siswa->foto)))
                        <img src="{{ public_path('storage/' . $siswa->foto) }}" class="foto-siswa" alt="Foto">
                    @else
                        <span>-</span>
                    @endif
                </td>
                <td>{{ $siswa->nis }}</td>
                <td>{{ $siswa->nama_siswa }}</td>
                <td>{{ $siswa->kelas->name ?? '-' }}</td>
                <td>{{ $siswa->jurusan }}</td>
                <td>{{ $siswa->email ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>