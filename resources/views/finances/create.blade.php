{{-- Extends layout --}}
@extends('dashboard')
@section('title'){{ __('locale.New finance') }} @endsection
@section('page_title')
{{-- Page Title --}}
<h5 class="text-dark font-weight-bold my-2 mr-5">
    @yield('title', $title ?? '')

    @if (config('layout.subheader.displayDesc'))
    <small>{{ config('app.desc') }}</small>
    @endif
</h5>
<div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
<div class="d-flex align-items-center" id="kt_subheader_search">
    <span class="text-dark-50 font-weight-bold" id="kt_subheader_total">{{ __('locale.New finance') }}</span>
</div>
@endsection
@section('page_toolbar')
{{-- Page toolbar --}}
<a class="btn btn-default font-weight-bold btn-sm px-3 font-size-base" href="{{ route('finances.list') }}">{{
    __('locale.Go back')
    }}</a>
@endsection
@section('page_actions')
{{-- Page toolbar --}}
<div class="btn-group ml-2">
    <button class="btn btn-primary font-weight-bold btn-sm px-3 font-size-base" type="button" id="saveButton"
        onclick="$('#form-btn-sub').trigger('click')">{{ __('locale.Save')
        }}</button>
</div>
@endsection
{{-- Content --}}
@section('content')

{{-- Dashboard 1 --}}
<div class="card card-custom">
    <div class="card-body">
        <form action="{{ route('finances.store') }}" enctype="multipart/form-data"
            class="form form-label-right form-update" id="kt_form" method="POST">
            @csrf
            <button type="submit" class="btn" style="display: none;" id="form-btn-sub">Submit</button>
            <input type="hidden" name="user_id" value="{{ $user->id }}">
            <!--begin::Row-->
            <div class="row">
                <div class="col-xl-2"></div>
                <div class="col-xl-7 my-2">
                    <!--begin::Row-->
                    <div class="row">
                        <label class="col-3"></label>
                        <div class="col-9">
                            <h6 class="text-dark font-weight-bold mb-10">{{ __('locale.Profile details') }}:</h6>
                        </div>
                    </div>
                    <!--end::Row-->
                    <!--begin::Group-->
                    <div class="form-group row">
                        <label class="col-form-label col-3 text-lg-right text-left">{{ __('locale.fields.type') }}</label>
                        <div class="col-9">
                            <select class="form-control form-control-lg form-control-solid"
                                name="type" id="financeType" onchange="ok(this)">
                                <option value="">{{ __('locale.Select') }}...</option>
                                <option value="income">{{ __('Ingreso') }}</option>
                                <option value="outcome">{{ __('Egreso') }}</option>
                            </select>
                        </div>
                    </div>
                    <!--end::Group-->
                    <!--begin::Group-->
                    <div class="form-group row">
                        <label class="col-form-label col-3 text-lg-right text-left">{{ __('locale.fields.amount')
                            }}</label>
                        <div class="col-9">
                            <input class="form-control form-control-lg form-control-solid" type="text"
                                value="" name="amount">
                        </div>
                    </div>
                    <!--end::Group-->
                    <!--begin::Group-->
                    <div class="form-group row ">
                        <label class="col-form-label col-3 text-lg-right text-left">{{
                            __('locale.fields.organization') }}</label>
                        <div class="col-9">
                            <select class="form-control form-control-lg form-control-solid" name="organization_id" id="organization_id">
                                <option value="">{{ __('locale.Select') }}...</option>
                                @foreach ($organizations as $org)
                                <option value="{{ $org->id }}" >{{ $org->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!--end::Group-->

                    <!--begin::Group-->
                    <div class="form-group row income d-none">
                        <label class="col-form-label col-3 text-lg-right text-left">{{
                            __('locale.fields.patient') }}</label>
                        <div class="col-9">
                            <select class="form-control form-control-lg form-control-solid" name="patient_id" id="patient_id">
                                <option value="">{{ __('locale.Select') }}...</option>                                
                            </select>
                        </div>
                    </div>
                    <!--end::Group-->

                    <!--begin::Group-->
                    <div class="form-group row">
                        <label class="col-form-label col-3 text-lg-right text-left">{{ __('locale.fields.order')
                            }}</label>
                        <div class="col-9">
                            <input class="form-control form-control-lg form-control-solid" type="text"
                                value="" name="order">
                        </div>
                    </div>
                    <!--end::Group-->                 
                    
                   
                    <!--begin::Group-->
                    <div class="form-group row">
                        <label class="col-form-label col-3 text-lg-right text-left">{{
                            __('locale.fields.detail') }}</label>
                        <div class="col-9">
                            <input type="text" class="form-control form-control-lg form-control-solid" name="concepts"
                                value="">
                        </div>
                    </div>
                    <!--end::Group-->
                    <!--begin::Group-->
                    <div class="form-group row">
                        <label class="col-form-label col-3 text-lg-right text-left">{{
                            __('locale.fields.pay_date') }}</label>
                        <div class="col-9">
                            <div class="input-group input-group-lg input-group-solid">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="la la-calendar-check-o"></i>
                                    </span>
                                </div>
                                <input type="text" name="pay_date"
                                    class="form-control form-control-lg form-control-solid"
                                    value="" id="pay_date">
                            </div>
                        </div>
                    </div>
                    <!--end::Group-->
                    <!--begin::Group-->
                    <div class="form-group row">
                        <label class="col-form-label col-3 text-lg-right text-left">{{
                            __('locale.fields.date') }}</label>
                        <div class="col-9">
                            <div class="input-group input-group-lg input-group-solid">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="la la-calendar-check-o"></i>
                                    </span>
                                </div>
                                <input type="text" name="f_date"
                                    class="form-control form-control-lg form-control-solid"
                                    value="" id="kt_datepicker">
                            </div>
                        </div>
                    </div>
                    <!--end::Group-->
                    

                </div>
            </div>
            <!--end::Row-->
        </form>
    </div>
</div>

@endsection

{{-- Scripts Section --}}
@section('scripts')
<script src="{{ asset('js/pages/custom/finances/finance.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/pages/custom/dates/bootstrap-datepicker.js') }}" type="text/javascript"></script>
@endsection