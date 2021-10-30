{{-- Extends layout --}}
@extends('users.profile')

{{-- Context --}}
@section('context')
<div class="row">

  <div class="col-lg-6 col-xxl-6">
    @include('users.widgets._widget-1', ['class' => 'card-custom gutter-b'])
  </div>

  <div class="col-lg-6 col-xxl-6">
    @include('users.widgets._widget-2', ['class' => 'card-custom gutter-b'])
  </div>

  <div class="col-lg-12 col-xxl-12 order-1 order-xxl-2">
    @include('users.widgets._widget-9', ['class' => 'card-custom gutter-b'])
  </div>
</div>
@endsection