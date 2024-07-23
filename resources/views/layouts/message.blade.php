@if ($message = Session::get('error'))
<div class="alert d alert-danger alert-block">
        <center><strong>{{ $message }}</strong></center>
</div>
@endif

@if ($message = Session::get('success'))
<div class="alert s alert-success alert-block">
        <center><strong>{{ $message }}</strong></center>
</div>
@endif

@if ($message = Session::get('editmaster'))
<div class="alert s alert-success alert-block">
        <center><strong>{{ $message }}</strong></center>
</div>
@endif

@if ($message = Session::get('deletemaster'))
<div class="alert s alert-success alert-block">
        <center><strong>{{ $message }}</strong></center>
</div>
@endif



@if ($message = Session::get('updatesetting'))
<div class="alert s alert-success alert-block">
        <center><strong>{{ $message }}</strong></center>
</div>
@endif



@if ($message = Session::get('successmasuk'))
<div class="alert s alert-success alert-block">
        <center><strong>{{ $message }}</strong></center>
</div>
@endif

@if ($message = Session::get('successkeluar'))
<div class="alert s alert-success alert-block">
        <center><strong>{{ $message }}</strong></center>
</div>
@endif


@if ($message = Session::get('login'))
<div class="alert alert-danger alert-block">
        <center><strong>{{ $message }}</strong></center>
</div>
@endif

@if ($message = Session::get('logout'))
<div class="alert alert-danger alert-block">
        <center><strong>{{ $message }}</strong></center>
</div>
@endif

