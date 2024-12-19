<!DOCTYPE html>
<html>
<head>
    <title>Histori IRS</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Histori IRS Mahasiswa</h1>
    <table>
        <thead>
            <tr>
                <th>Semester</th>
                <th>Kode Mata Kuliah</th>
                <th>Nama Mata Kuliah</th>
                <th>Ruang</th>
                <th>Total SKS</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($irs as $item)
                <tr>
                    <td>{{ $item->semester }}</td>
                    <td>{{ $item->kelas->mataKuliah->kode_mk ?? 'Tidak Ada' }}</td>
                    <td>{{ $item->kelas->mataKuliah->nama_mk ?? 'Tidak Ada' }}</td>
                    <td>{{ $item->ruang_kuliah_kode_ruang }}</td>
                    <td>{{ $item->total_sks }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
