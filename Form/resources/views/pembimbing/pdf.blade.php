<!DOCTYPE html>
<html>
<head>
    <title>Histori IRS {{ $mahasiswa->nama }}</title>
    <style>
        body { font-family: Arial, sans-serif; }
        h1, h2 { text-align: center; }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Histori IRS</h1>
    <h2>{{ $mahasiswa->nama }} ({{ $mahasiswa->nim }})</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Semester</th>
                <th>SKS</th>
                <th>IPS</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($irs as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->semester }}</td>
                    <td>{{ $item->sks }}</td>
                    <td>{{ $item->ips }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
