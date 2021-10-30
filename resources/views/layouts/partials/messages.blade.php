@if(isset ($errors) && count($errors) > 0)
<div class="alert alert-custom alert-warning " role="alert">
    <ul class="list-unstyled mb-0">
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@if(Session::get('success', false))
<?php $data = Session::get('success'); ?>
@if (is_array($data))
@foreach ($data as $msg)
<div class="alert alert-custom alert-success alert-shadow fade show gutter-b" role="alert">
    <div class="alert-icon"><i class="fa fa-check fa-1x"></i></div>
    <div class="alert-text">{{ $msg }}</div>
</div>
@endforeach
@else
<div class="alert alert-custom alert-success alert-shadow fade show gutter-b" role="alert">
    <div class="alert-icon"><i class="fa fa-check fa-1x"></i></div>
    <div class="alert-text">{{ $data }}</div>
</div>
@endif
@endif