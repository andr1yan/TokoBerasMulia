<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Keuangan Masuk | Toko Beras Mulia</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        table {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            text-align: center;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #003366; /* Dark blue color */
            color: white;
        }
        tbody tr:nth-child(odd) {
            background-color: #f2f2f2; /* Light grey */
        }
        tbody tr:nth-child(even) {
            background-color: #d9d9d9; /* Darker grey */
        }
        td {
            border: none; /* Remove borders from the body */
        }
    </style>
</head>
<body>
    <center><h3>Laporan Keuangan Masuk | Toko Beras Mulia</h3></center>
    <br>
    <table class="table-dark">
        <thead>
            <tr>
                <th>No</th>
                <th>Jenis Keuangan</th>
                <th>Nama Beras</th>
                <th>Tanggal</th>
                <th>Harga Jual(Rp)</th>
                <th>Jumlah Keluar</th>
                <th>Kategori</th>
                <th>Total Masuk(Rp)</th>
            </tr>
        </thead>
        <tbody>
            @php
            $no = 1;
            $jenis = 'Pemasukan';
            @endphp
            @foreach ($pdf as $p)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $jenis }}</td>
                <td>{{ $p->nama_beras }}</td>
                <td>{{ $p->tanggal }}</td>
                <td>Rp. {{ $p->harga_jual }}</td>
                <td>{{ $p->jumlah_keluar }}</td>
                <td>{{ $p->kategori }}</td>
                <td>Rp. {{ $p->total_masuk }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>