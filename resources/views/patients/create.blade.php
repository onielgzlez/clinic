{{-- Extends layout --}}
@extends('dashboard')
@section('title'){{ __('locale.New patient') }} @endsection
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
    <span class="text-dark-50 font-weight-bold" id="kt_subheader_total">{{ __('locale.Patient Information') }}</span>
</div>
@endsection
@section('page_toolbar')
{{-- Page toolbar --}}
<a class="btn btn-default font-weight-bold btn-sm px-3 font-size-base" href="{{ route('patients.list') }}">{{
    __('locale.Go back')
    }}</a>
@endsection

{{-- Content --}}
@section('content')

{{-- Dashboard 1 --}}
<div class="card card-custom card-transparent">
    <div class="card-body p-0">
        <!--begin::Wizard-->
        <div class="wizard wizard-4" id="kt_wizard" data-wizard-state="step-first" data-wizard-clickable="true">
            <!--begin::Wizard Nav-->
            <div class="wizard-nav">
                <div class="wizard-steps">
                    <div class="wizard-step" data-wizard-type="step" data-wizard-state="current">
                        <div class="wizard-wrapper">
                            <div class="wizard-number">1</div>
                            <div class="wizard-label">
                                <div class="wizard-title">{{ __('locale.Personal') }}</div>
                                <div class="wizard-desc">{{ __('locale.Personal Information') }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="wizard-step" data-wizard-type="step">
                        <div class="wizard-wrapper">
                            <div class="wizard-number">2</div>
                            <div class="wizard-label">
                                <div class="wizard-title">{{ __('locale.Contact') }}</div>
                                <div class="wizard-desc">{{ __('locale.Contact Information') }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="wizard-step" data-wizard-type="step">
                        <div class="wizard-wrapper">
                            <div class="wizard-number">3</div>
                            <div class="wizard-label">
                                <div class="wizard-title">{{ __('locale.Data') }}</div>
                                <div class="wizard-desc">{{ __('locale.Review and sent') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Wizard Nav-->
            <!--begin::Card-->
            <div class="card card-custom card-shadowless rounded-top-0">
                <!--begin::Body-->
                <div class="card-body p-0">
                    <div class="row justify-content-center py-8 px-8 py-lg-15 px-lg-10">
                        <div class="col-xl-12 col-xxl-10">
                            <!--begin::Wizard Form-->
                            <form class="form" id="kt_form" method="POST" action="{{ route('patients.store') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row justify-content-center">
                                    <div class="col-xl-9">
                                        <!--begin::Wizard Step 1-->
                                        <div class="my-5 step" data-wizard-type="step-content"
                                            data-wizard-state="current">
                                            <h5 class="text-dark font-weight-bold mb-10">{{ __('locale.Profile details')
                                                }}:</h5>
                                            <!--begin::Group-->
                                            <div class="form-group row">
                                                <label
                                                    class="col-xl-3 col-lg-3 col-form-label text-lg-right text-left">{{
                                                    __('locale.fields.photo') }}</label>
                                                <div class="col-lg-9 col-xl-9">
                                                    <div class="image-input image-input-outline"
                                                        id="kt_user_add_avatar">
                                                        <div class="image-input-wrapper"
                                                            style="background-image: url({{ asset('media/users/default.jpg') }})">
                                                        </div>
                                                        <label
                                                            class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                            data-action="change" data-toggle="tooltip" title=""
                                                            data-original-title="{{ __('locale.Change photo') }}">
                                                            <i class="fa fa-pen icon-sm text-muted"></i>
                                                            <input type="file" name="photo"
                                                                accept=".png, .jpg, .jpeg" />
                                                        </label>
                                                        <span
                                                            class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                            data-action="cancel" data-toggle="tooltip"
                                                            title="Cancel avatar">
                                                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end::Group-->
                                            <!--begin::Group-->
                                            <div class="form-group row">
                                                <label
                                                    class="col-xl-3 col-lg-3 col-form-label text-lg-right text-left">{{
                                                    __('locale.fields.first_name') }}</label>
                                                <div class="col-lg-9 col-xl-9">
                                                    <input class="form-control form-control-solid form-control-lg"
                                                        name="first_name" type="text" value="" />
                                                </div>
                                            </div>
                                            <!--end::Group-->
                                            <!--begin::Group-->
                                            <div class="form-group row">
                                                <label
                                                    class="col-xl-3 col-lg-3 col-form-label text-lg-right text-left">{{
                                                    __('locale.fields.second_name') }}</label>
                                                <div class="col-lg-9 col-xl-9">
                                                    <input class="form-control form-control-solid form-control-lg"
                                                        name="second_name" type="text" value="" />
                                                </div>
                                            </div>
                                            <!--end::Group-->
                                            <!--begin::Group-->
                                            <div class="form-group row">
                                                <label
                                                    class="col-xl-3 col-lg-3 col-form-label text-lg-right text-left">{{
                                                    __('locale.fields.last_name') }}</label>
                                                <div class="col-lg-9 col-xl-9">
                                                    <input class="form-control form-control-solid form-control-lg"
                                                        name="last_name" type="text" value="" />
                                                </div>
                                            </div>
                                            <!--end::Group-->
                                            <!--begin::Group-->
                                            <div class="form-group row">
                                                <label
                                                    class="col-xl-3 col-lg-3 col-form-label text-lg-right text-left">{{
                                                    __('locale.fields.last_name2') }}</label>
                                                <div class="col-lg-9 col-xl-9">
                                                    <input class="form-control form-control-solid form-control-lg"
                                                        name="last_name2" type="text" value="" />
                                                </div>
                                            </div>
                                            <!--end::Group-->
                                            <!--begin::Group-->
                                            <div class="form-group row">
                                                <label class="col-form-label col-3 text-lg-right text-left">{{
                                                    __('locale.fields.phone') }}</label>
                                                <div class="col-9">
                                                    <div class="input-group input-group-lg input-group-solid">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="la la-phone"></i>
                                                            </span>
                                                        </div>
                                                        <input type="text"
                                                            class="form-control form-control-lg form-control-solid"
                                                            value="" placeholder="{{ __('locale.fields.phone') }}" name="phone">
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end::Group-->
                                            <!--begin::Group-->
                                            <div class="form-group row">
                                                <label class="col-form-label col-3 text-lg-right text-left">{{
                                                    __('locale.fields.email') }}
                                                </label>
                                                <div class="col-9">
                                                    <div class="input-group input-group-lg input-group-solid">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="la la-at"></i>
                                                            </span>
                                                        </div>
                                                        <input type="text" name="email"
                                                            class="form-control form-control-lg form-control-solid"
                                                            value="" placeholder="{{ __('locale.fields.email') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end::Group-->
                                            <!--begin::Group-->
                                            <div class="form-group row">
                                                <label class="col-form-label col-3 text-lg-right text-left">{{
                                                    __('locale.fields.document') }}</label>
                                                <div class="col-9">
                                                    <input type="text"
                                                        class="form-control form-control-lg form-control-solid"
                                                        name="document" value="">
                                                </div>
                                            </div>
                                            <!--end::Group-->
                                            <!--begin::Group-->
                                            <div class="form-group row">
                                                <label class="col-form-label col-3 text-lg-right text-left">{{
                                                    __('locale.fields.birthdate') }}</label>
                                                <div class="col-9">
                                                    <div class="input-group input-group-lg input-group-solid">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="la la-calendar-check-o"></i>
                                                            </span>
                                                        </div>
                                                        <input type="text" name="birthdate"
                                                            class="form-control form-control-lg form-control-solid"
                                                            value="" id="kt_datepicker">
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end::Group-->
                                            <!--begin::Group-->
                                            <div class="form-group row ">
                                                <label class="col-form-label col-3 text-lg-right text-left">{{
                                                    __('locale.fields.organization') }}</label>
                                                <div class="col-9">
                                                    <select class="form-control form-control-lg form-control-solid"
                                                        name="organizations">
                                                        <option value="">{{ __('locale.Select') }}...</option>
                                                        @foreach ($organizations as $org)
                                                        <option value="{{ $org->id }}">{{ $org->name
                                                            }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <!--end::Group-->
                                        </div>
                                        <!--end::Wizard Step 1-->
                                        <!--begin::Wizard Step 2-->
                                        <div class="my-5 step" data-wizard-type="step-content">
                                            <h5 class="text-dark font-weight-bold mb-10 mt-5">{{ __('locale.Setup your current location') }}</h5>

                                            <!--begin::Group-->
                                            <div class="form-group fv-plugins-icon-container row">
                                                <label class="col-form-label col-3 text-lg-right text-left">{{
                                                    __('locale.fields.address') }}</label>
                                                <div class="col-9">
                                                    <input type="text"
                                                        class="form-control form-control-lg form-control-solid"
                                                        name="address">
                                                    <span class="form-text text-muted">{{ __('locale.Please enter your address') }}</span>
                                                    <div class="fv-plugins-message-container"></div>
                                                </div>
                                            </div>
                                            <!--end::Group-->
                                            <!--begin::Group-->
                                            <div class="form-group row">
                                                <label class="col-form-label col-3 text-lg-right text-left">{{
                                                    __('locale.fields.address_job') }}</label>
                                                <div class="col-9">
                                                    <input type="text"
                                                        class="form-control form-control-lg form-control-solid"
                                                        name="address_job">
                                                </div>
                                            </div>
                                            <!--end::Group-->
                                            <!--begin::Group-->
                                            <div class="form-group row ">
                                                <label class="col-form-label col-3 text-lg-right text-left">{{
                                                    __('locale.fields.city') }}</label>
                                                <div class="col-9">
                                                    <select class="form-control form-control-lg form-control-solid"
                                                        name="city_id">
                                                        <option value="">{{ __('locale.Select') }}...</option>
                                                        @foreach ($cities as $city)
                                                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <!--end::Group-->
                                            <div class="separator separator-dashed my-10"></div>
                                            <h5 class="text-dark font-weight-bold mb-10">{{ __('locale.Contact Information') }}</h5>

                                            <!--begin::Group-->
                                            <div class="form-group row">
                                                <label class="col-form-label col-3 text-lg-right text-left">{{
                                                    __('locale.fields.telephone') }}</label>
                                                <div class="col-9">
                                                    <div class="input-group input-group-lg input-group-solid">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="la la-phone"></i>
                                                            </span>
                                                        </div>
                                                        <input type="text"
                                                            class="form-control form-control-lg form-control-solid"
                                                            value="" placeholder="{{
                                                                __('locale.fields.telephone') }}" name="telephone">
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end::Group-->
                                            <!--begin::Group-->
                                            <div class="form-group row">
                                                <label class="col-form-label col-3 text-lg-right text-left">{{
                                                    __('locale.fields.whatsapp') }}</label>
                                                <div class="col-9">
                                                    <div class="input-group input-group-lg input-group-solid">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="la la-whatsapp"></i>
                                                            </span>
                                                        </div>
                                                        <input type="text"
                                                            class="form-control form-control-lg form-control-solid"
                                                            value="" placeholder="{{
                                                                __('locale.fields.whatsapp') }}" name="whatsapp">
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end::Group-->
                                            <!--begin::Group-->
                                            <div class="form-group row">
                                                <label class="col-form-label col-3 text-lg-right text-left">{{
                                                    __('locale.fields.jobphone') }}</label>
                                                <div class="col-9">
                                                    <div class="input-group input-group-lg input-group-solid">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="la la-phone"></i>
                                                            </span>
                                                        </div>
                                                        <input type="text"
                                                            class="form-control form-control-lg form-control-solid"
                                                            value="" placeholder="{{
                                                                __('locale.fields.jobphone') }}" name="jobphone">
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end::Group-->
                                            <div class="separator separator-dashed my-10"></div>
                                            <h5 class="text-dark font-weight-bold mb-10">{{ __('locale.Contact Information Emergency') }}</h5>
                                            <!--begin::Group-->
                                            <div class="form-group row">
                                                <label class="col-form-label col-3 text-lg-right text-left">{{
                                                    __('locale.fields.reference') }}</label>
                                                <div class="col-9">                                                                                                        
                                                        <input type="text"
                                                            class="form-control form-control-lg form-control-solid"
                                                            value="" name="reference">
                                                </div>
                                            </div>
                                            <!--end::Group-->
                                            <!--begin::Group-->
                                            <div class="form-group row">
                                                <label class="col-form-label col-3 text-lg-right text-left">{{
                                                    __('locale.fields.phone_reference') }}</label>
                                                <div class="col-9">
                                                    <div class="input-group input-group-lg input-group-solid">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="la la-phone"></i>
                                                            </span>
                                                        </div>
                                                        <input type="text"
                                                            class="form-control form-control-lg form-control-solid"
                                                            value="" placeholder="{{
                                                                __('locale.fields.phone_reference') }}" name="phone_reference">
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end::Group-->
                                            <!--begin::Group-->
                                            <div class="form-group row">
                                                <label class="col-form-label col-3 text-lg-right text-left">{{
                                                    __('locale.fields.whatsapp_reference') }}</label>
                                                <div class="col-9">
                                                    <div class="input-group input-group-lg input-group-solid">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="la la-whatsapp"></i>
                                                            </span>
                                                        </div>
                                                        <input type="text"
                                                            class="form-control form-control-lg form-control-solid"
                                                            value="" placeholder="{{
                                                                __('locale.fields.whatsapp_reference') }}" name="whatsapp_reference">
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end::Group-->
                                                @include('pages.widgets._widget-contact_via')
                                            <!--begin::Group-->
                                            <div class="form-group row">
                                                <label class="col-form-label col-3 text-lg-right text-left">{{
                                                    __('locale.fields.prospectus') }}</label>
                                                <div class="col-3">
                                                    <span class="switch">
                                                        <label>
                                                            <input type="checkbox" name="prospectus">
                                                            <span></span>
                                                        </label>
                                                    </span>
                                                </div>
                                            </div>
                                            <!--end::Group-->

                                        </div>
                                        <!--end::Wizard Step 2-->
                                        <!--begin::Wizard Step 3-->
                                        <div class="my-5 step" data-wizard-type="step-content">
                                            <h5 class="mb-10 font-weight-bold text-dark">Review your Details and Submit
                                            </h5>
                                            <!--begin::Item-->
                                            <div class="border-bottom mb-5 pb-5">
                                                <div class="font-weight-bolder mb-3">Your Account Details:</div>
                                                <div class="line-height-xl">John Wick
                                                    <br />Phone: +61412345678
                                                    <br />Email: johnwick@reeves.com
                                                </div>
                                            </div>
                                            <!--end::Item-->
                                            <!--begin::Item-->
                                            <div class="border-bottom mb-5 pb-5">
                                                <div class="font-weight-bolder mb-3">Your Address Details:</div>
                                                <div class="line-height-xl">Address Line 1
                                                    <br />Address Line 2
                                                    <br />Melbourne 3000, VIC, Australia
                                                </div>
                                            </div>
                                            <!--end::Item-->
                                            <!--begin::Item-->
                                            <div>
                                                <div class="font-weight-bolder">Payment Details:</div>
                                                <div class="line-height-xl">Card Number: xxxx xxxx xxxx 1111
                                                    <br />Card Name: John Wick
                                                    <br />Card Expiry: 01/21
                                                </div>
                                            </div>
                                            <!--end::Item-->
                                        </div>
                                        <!--end::Wizard Step 4-->
                                        <!--begin::Wizard Actions-->
                                        <div class="d-flex justify-content-between border-top pt-10 mt-15">
                                            <div class="mr-2">
                                                <button type="button" id="prev-step"
                                                    class="btn btn-light-primary font-weight-bolder px-9 py-4"
                                                    data-wizard-type="action-prev">{{ __('locale.Previous') }}</button>
                                            </div>
                                            <div>
                                                <button type="button"
                                                    class="btn btn-success font-weight-bolder px-9 py-4"
                                                    data-wizard-type="action-submit">{{ __('locale.Save') }}</button>
                                                <button type="button" id="next-step"
                                                    class="btn btn-primary font-weight-bolder px-9 py-4"
                                                    data-wizard-type="action-next">{{ __('locale.Next') }}</button>
                                            </div>
                                        </div>
                                        <!--end::Wizard Actions-->
                                    </div>
                                </div>
                            </form>
                            <!--end::Wizard Form-->
                        </div>
                    </div>
                </div>
                <!--end::Body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Wizard-->
    </div>
</div>
@endsection

{{-- Scripts Section --}}
@section('scripts')
<script src="{{ asset('js/pages/custom/patients/add-patient.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/pages/custom/dates/bootstrap-datepicker.js') }}" type="text/javascript"></script>
@endsection
{{-- Styles Section --}}
@section('styles')
<link href="{{ asset('css/pages/wizard/wizard-4.css') }}" rel="stylesheet" type="text/css" />
@endsection