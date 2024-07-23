@extends('layouts.main')
@section('header')
@include('layouts.res')
@include('layouts.datetimepicker-header')
@endsection
@section('title')
Data Keuangan Keluar
@endsection
@section('breadcrumb')
Data Keuangan Keluar
@endsection

@section('content')
<div class="card">
    <div class="card-header">
    @include('layouts.message')
        <div class="d-inline">
            <form action="{{route('excel-keluar')}}" method="get" class="d-inline">
                <input type="hidden" name="date_first_d" value="{{$dateFirst}}">
                <input type="hidden" name="date_last_d" value="{{$dateLast}}">
                <button class="btn btn-sm btn-success tooltips" type="submit">
                    <i class="cil-cloud-download" style="font-weight: bold;font-size: 20px;"></i> Excel
                </button>
            </form>
            <form action="{{route('pdf-keluar')}}" method="get" class="d-inline">
                <input type="hidden" name="date_first_dd" value="{{$dateFirst}}">
                <input type="hidden" name="date_last_dd" value="{{$dateLast}}">
                <button class="btn btn-sm btn-secondary tooltips" type="submit">
                    <i class="cil-cloud-download" style="font-weight: bold;font-size: 20px;"></i> PDF
                </button>
            </form>
            <a href="{{ url('/data-keuangan-keluar/create') }}" class="btn btn-primary d-inline">Create</a>
        </div>
    </div>
    <div class="card-body">
    <div class="row">
            <div class="col-sm-10">
                <form action="" method="get">
                    <div class="row">
                        <div class="col-sm-2 mb-3">
                            <label class="form-label">Dari Tanggal <div class="required">*</div></label>
                            <input type="text" class="form-control" name="date_first" id="date_first" placeholder="dd-mm-yyyy" value="{{$dateFirst}}" required>
                            <div class="invalid-feedback">Dari Tanggal Wajib Diisi!</div>
                        </div>
                        <div class="col-sm-2 mb-3">
                            <label class="form-label">Sampai Tanggal <div class="required">*</div></label>
                            <input type="text" class="form-control" name="date_last" id="date_last" placeholder="dd-mm-yyyy" value="{{$dateLast}}" required>
                            <div class="invalid-feedback">Sampai Tanggal Wajib Diisi!</div>
                        </div>
                        <div class="col-sm-2 mb-3 align-self-end">
                            <button class="btn btn-sm btn-primary">Tampil</button>
                        </div>
                    </div>
                </form>
            </div>
        <table id="table-keuangan-keluar" class="display responsive nowrap" style="width:100%;">
            <thead>
                <tr>
                    <th>Kode Beras</th>
                    <th>Nama Beras</th>
                    <th>Tanggal</th>
                    <th>Kategori</th>
                    <th>Jumlah Masuk</th>
                    <th>Harga Beli</th>
                    <th>Total Keluar</th>
                    <th>Foto</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection

@section('footer')  
@include('layouts.res-js')
@include('layouts.datetimepicker-footer')
<script>
$('#date_first').datetimepicker({
    locale: 'id',
    format: 'DD-MM-YYYY'
});
$('#date_last').datetimepicker({
    locale: 'id',
    format: 'DD-MM-YYYY'
});
</script>

<script>
$(function () {
    var table = $('#table-keuangan-keluar').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('data-keuangan-keluar', ['date_first'=>$dateFirst,'date_last'=>$dateLast]) }}".replace(/&amp;/g, "&"),
        columns: [
            {data: 'kode_beras', name: 'kode_beras'},
            {data: 'nama_beras', name: 'nama_beras'},
            {data: 'tanggal', name: 'tanggal'},
            {data: 'kategori', name: 'kategori'},
            {data: 'jumlah_masuk', name: 'jumlah_masuk'},
            {data: 'harga_beli', name: 'harga_beli'},
            {data: 'total_keluar', name: 'total_keluar'},
            {data: 'bukti', name: 'bukti',orderable: false, searchable: false},
        ],
        responsive: true
    });
});
</script>
@endsection