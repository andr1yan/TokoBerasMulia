@extends('layouts.main')
@section('header')
@include('layouts.select-header')
@endsection
@section('title')
Tambah Data Keuangan Masuk
@endsection
@section('breadcrumb')
Tambah Data Keuangan Masuk
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3>
            Tambah Data Keuangan Masuk
        </h3>
    </div>
    <div class="card-body">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ url('/data-keuangan-masuk/store') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Kode Beras</label>
                            <select name="id_beras" id="codeBank" class="form-select" required></select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Tanggal</label>
                            <input type="date" class="form-control" name="tanggal" id="exampleInputPassword1" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Jumlah Keluar</label>
                            <input type="text" class="form-control" name="jumlah_keluar" id="exampleInputPassword1" required>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
@endsection
@section('footer')
@include('layouts.select-footer')
<script>
$(document).ready(function(){
    $('#codeBank').select2({
        minimumInputLength:1,
        placeholder:'Select User',
        ajax:{
            url:"{{route('kode_masuk')}}",
            dataType:'json',
            data: (params) => {
                let query = {
                    term: params.term,
                    page: params.page || 1,
                };
                return query;
            },
            processResults: data => {
                return {
                    results: data[0].data,
                    pagination: {
                        more: data.current_page < data.last_page,
                    },
                };
            },
        },
        templateResult: formatName,
        templateSelection: formatNameSelection,
    });

    function formatName(name) {
        if (name.loading) {
            return name.text;
        }

        var $container = $(
            "<div class='select2-result-name clearfix'>" +
            "<div class='select2-result-name__kode_beras'></div>" +
            "<div class='select2-result-name__nama_beras'></div>" +
            "</div>"
        );

        $container.find(".select2-result-name__kode_beras").text(name.kode_beras);
        $container.find(".select2-result-name__nama_beras").text(name.nama_beras);

        return $container;
    }

    function formatNameSelection(name) {
        return name.kode_beras || name.text;
    }
})
</script>
@endsection
