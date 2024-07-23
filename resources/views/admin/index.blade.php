@extends('layouts.main')
@section('title')
Setting
@endsection
@section('breadcrumb')
Setting 
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3>
            Setting
        </h3>
    @include('layouts.message')
    </div>
    <div class="card-body">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ url('/setting/update') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Nama Toko</label>
                            <input type="text" class="form-control" name="nama_toko" id="exampleInputPassword1" value="{{ $s->nama_toko }}" required autofocus>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Email</label>
                            <input type="text" class="form-control" name="email" id="exampleInputPassword1" value="{{ $s->email }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">No Telepon</label>
                            <input type="text" class="form-control" name="no_telp" id="exampleInputPassword1" value="{{ $s->no_telp }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">No Fax</label>
                            <input type="text" class="form-control" name="fax" id="exampleInputPassword1" value="{{ $s->fax }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Alamat</label>
                            <textarea class="form-control" name="alamat" id="exampleFormControlTextarea1" rows="5">{{ $s->alamat }}</textarea>
                        </div>
                        <div>
                            <input type="reset" class="btn btn-md btn-warning">
                            <button type="submit" name="simpan" class="btn btn-md btn-primary">Simpan</button>
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
