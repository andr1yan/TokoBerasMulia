@extends('layouts.main')
@section('title')
Welcome To Home
@endsection
@section('breadcrumb')
Dashboard
@endsection

@section('content')

<div class="card">
    <div class="card-body"> 
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-success" role="alert">
                        Selamat Datang Di Toko Beras Mulia
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xxl-4 col-lg-4 mb-4">
                    <div class="card card-hei bg-warning mb-4">
                        <div class="card-header ">
                            <center><b><h3>Laporan Harian</h3></b></center>
                        </div>
                        <div class="card-body mb-4">
                            <p>Jumlah Pemasukan Hari Ini</p>
                            <p>{{ $mh }}</p>
                            <p>Jumlah Pengeluaran Hari ini</p>
                            <p>{{ $kh }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-4 col-lg-4 mb-4">
                    <div class="card card-hei bg-info mb-4">
                        <div class="card-header">
                            <center><b><h3>Laporan Bulanan</h3></b></center>
                        </div>
                        <div class="card-body mb-4">
                            <p>Jumlah Pemasukan Bulan Ini</p>
                            <p>{{ $mb }}</p>
                            <p>Jumlah Pengeluaran Bulan ini</p>
                            <p>{{ $kb }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-4 col-lg-4 mb-4">
                    <div class="card card-hei bg-light mb-4">
                        <div class="card-header">
                            <center><b><h3>Laporan Tahunan</h3></b></center>
                        </div>
                        <div class="card-body mb-4">
                            <p>Jumlah Pemasukan Tahun Ini</p>
                            <p>{{ $mt }}</p>
                            <p>Jumlah Pengeluaran Tahun ini</p>
                            <p>{{ $kt }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xxl-6 col-lg-6 mb-4">
                    <div class="card card-hei bg-success mb-4">
                        <div class="card-header ">
                            <center><b><h3>Total Pemasukan</h3></b></center>
                        </div>
                        <div class="card-body mb-4">
                            <p>Total Seluruh Pemasukan</p>
                            <p>{{ $tp }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-6 col-lg-6 mb-4">
                    <div class="card card-hei bg-danger mb-4">
                        <div class="card-header">
                            <center><b><h3>Total Pengeluaran</h3></b></center>
                        </div>
                        <div class="card-body mb-4">
                            <p>Total Seluruh Pengeluaran</p>
                            <p>{{ $tk }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('chart.js/dist/chart.min.js') }}"></script>
@endsection