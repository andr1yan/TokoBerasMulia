<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Faktur</title>
    <link rel="stylesheet" href="">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        .line-title {
            border: 0;
            border-style: inset;
            border-top: 1px solid #000;
        }
    </style>
</head>

<body class="container">
    <table class="mt-5" style="width: 100%;">
        <tr>
            <td align="center">
                <span style="line-height: 1.6; font-weight: bold;">
                    {{ $i->nama_toko }}
                    <br>{{ $i->alamat }}
                </span>
            </td>
        </tr>
    </table>

    <hr class="line-title">
    <div class="mt-10">
        <div class="row">
            <div class="col-md-4">
                <span class="font-weight-bold">Tanggal Beli:</span>
                <span>{{ $f->tanggal }}</span>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <span class="font-weight-bold">No Fax:</span>
                <span>{{ $i->fax }}{{ $f->id }}</span>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <span class="font-weight-bold">No Telepon:</span>
                <span>{{ $i->no_telp }}</span>
            </div>
        </div>
    </div>

    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Beras</th>
                <th>Jumlah</th>
                <th>Kategori</th>
                <th>Harga</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>{{ $f->nama_beras }}</td>
                <td>{{ $f->jumlah_keluar }}</td>
                <td>{{ $f->kategori }}</td>
                <td>{{ $f->harga_jual }}</td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td align="center" colspan="4">Total </td>
                <td>{{ $f->total_masuk }}</td>
            </tr>
        </tfoot>
    </table>

</body>

</html>