@extends('layouts.main')
@section('title')
Tambah Data Stok Beras
@endsection
@section('breadcrumb')
Tambah Data Stok Beras
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3>
            Tambah Data Stok Beras
        </h3>
    </div>
    <div class="card-body">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ url('/data-stok-beras/store') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Kode Beras</label>
                            <input type="text" class="form-control" name="kode_beras" id="exampleInputPassword1" required autofocus>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Nama Beras</label>
                            <input type="text" class="form-control" name="nama_beras" id="exampleInputPassword1" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Jumlah Stok</label>
                            <input type="text" class="form-control" name="jumlah_stok" id="exampleInputPassword1" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Kategori</label>
                            <input type="text" class="form-control" name="kategori" id="exampleInputPassword1" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Harga Beli</label>
                            <input type="text" class="form-control" name="harga_beli" id="exampleInputPassword1" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Harga Jual</label>
                            <input type="text" class="form-control" name="harga_jual" id="exampleInputPassword1" required>
                        </div>
                        <div>
                            <input type="reset" class="btn btn-md btn-warning">
                            <button type="submit" name="simpan" 
                                class="btn btn-md btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
@endsection
