@extends('layouts.main')
@section('header')
@include('layouts.res')
@endsection
@section('title')
Data Stok Beras
@endsection
@section('breadcrumb')
Data Stok Beras
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        @include('layouts.message')
       <a href="{{ url('/data-stok-beras/create') }}" class="btn btn-primary">Create</a>
    </div>
    <div class="card-body">
        <table id="table-stok-beras" class="display responsive nowrap" style="width:100%;">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Beras</th>
                    <th>Nama Beras</th>
                    <th>Jumlah Stok</th>
                    <th>Kategori</th>
                    <th>Harga Beli</th>
                    <th>Harga Jual</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                $no = 1;
                @endphp
                @foreach ($dataStok as $d)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $d->kode_beras }}</td>
                    <td>{{ $d->nama_beras }}</td>
                    <td>{{ $d->jumlah_stok }}</td>
                    <td>{{ $d->kategori }}</td>
                    <td>Rp. {{ $d->harga_beli }}</td>
                    <td>Rp. {{ $d->harga_jual }}</td>
                    <td>
                        
                            <a href="{{ url('/data-stok-beras/edit/'.$d->id) }}" class="btn btn-success">Edit</a> 
                            <button type="button" class="btn btn-danger" data-coreui-toggle="modal" 
                                data-coreui-target="#hapus" data-coreui-name="{{ $d->nama_beras }}" 
                                data-coreui-url="{{ url('data-stok-beras/delete/'.$d->id) }}">Delete</button>
                        
                    </td> 
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="modal fade" id="hapus" tabindex="-1" aria-labelledby="exampleModalLabel" 
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="btn-close" data-coreui-dismiss="modal" 
            aria-label="Close"></button>
        </div>
        <form action="" method="post" id="form-hapus">
            @csrf
            @method('delete')
            <div class="modal-body">
                <p id="tanya"></p>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" 
                    data-coreui-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger">Yes</button>
            </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@section('footer')
@include('layouts.res-js')
<script>
$(document).ready( function () {
    $('#table-stok-beras').DataTable();
        responsive: true
} );
</script>

<script>
const hapus = document.getElementById('hapus')
hapus.addEventListener('show.coreui.modal', event => {
  const button = event.relatedTarget
  const name = button.getAttribute('data-coreui-name')
  const url = button.getAttribute('data-coreui-url')
  const title = hapus.querySelector('.modal-title')
  const tanya = hapus.querySelector('.modal-body #tanya')
  const formHapus = hapus.querySelector('#form-hapus')

  title.textContent = 'Hapus ' + name 
  tanya.textContent = 'Yakin Akan Menghapus ' + name + ' ?'
  formHapus.action = url
})
</script>
@endsection