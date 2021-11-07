{{-- Extends layout --}}
@extends('dashboard')
@section('title'){{ __('locale.Edit patient') }} @endsection
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
    <span class="text-dark-50 font-weight-bold" id="kt_subheader_total">{{ $user->fullName }}</span>
</div>
@endsection
@section('page_toolbar')
{{-- Page toolbar --}}
<a class="btn btn-default font-weight-bold btn-sm px-3 font-size-base" href="{{ route('patients.list') }}">{{ __('locale.Go back')
    }}</a>
@endsection
@section('page_actions')
{{-- Page toolbar --}}
<div class="btn-group ml-2">
    <button class="btn btn-primary font-weight-bold btn-sm px-3 font-size-base" type="button" id="saveButton" onclick="$('#form-btn-sub').trigger('click')">{{ __('locale.Save')
        }}</button>
</div>
@endsection
{{-- Content --}}
@section('content')

{{-- Dashboard 1 --}}
    <div class="card card-custom">
        <div class="card-header card-header-tabs-line nav-tabs-line-3x">
            <!--begin::Toolbar-->
            <div class="card-toolbar">
                <ul class="nav nav-tabs nav-bold nav-tabs-line nav-tabs-line-3x">
                    <!--begin::Item-->
                    <li class="nav-item mr-3">
                        <a class="nav-link active" data-toggle="tab" href="#kt_user_edit_tab_1" style="">
                            <span class="nav-icon">
                                {{ Metronic::getSVG('media/svg/icons/Design/Layers.svg') }}
                            </span>
                            <span class="nav-text font-size-lg">{{ __('locale.Personal') }}</span>
                        </a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="nav-item mr-3">
                        <a class="nav-link" data-toggle="tab" href="#kt_user_edit_tab_2" style="">
                            <span class="nav-icon">
                                {{ Metronic::getSVG('media/svg/icons/General/User.svg') }}
                            </span>
                            </span>
                            <span class="nav-text font-size-lg">{{ __('locale.Contact') }}</span>
                        </a>
                    </li>
                    <!--end::Item-->
                </ul>
            </div>
            <!--end::Toolbar-->
        </div>
        <div class="card-body">
            <form action="{{ route('patients.update',['id'=>$user->id]) }}" enctype="multipart/form-data" class="form form-label-right form-update" id="kt_form" method="POST">                
                @csrf
                <button type="submit" class="btn" style="display: none;" id="form-btn-sub">Submit</button>     
                <input type="hidden" id="ktId" value="{{ $user->id }}">
                <div class="tab-content">
                    <!--begin::Tab-->
                    <div class="tab-pane show px-7 active" id="kt_user_edit_tab_1" role="tabpanel">
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
                                    <label class="col-form-label col-3 text-lg-right text-left">{{ __('locale.fields.photo') }}</label>
                                    <div class="col-9">
                                        <div class="image-input image-input-empty image-input-outline"
                                            id="kt_user_edit_avatar" style="background-image: url(/{{ $user->avatar }})">
                                            <div class="image-input-wrapper"></div>
                                            <label
                                                class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                data-action="change" data-toggle="tooltip" title=""
                                                data-original-title="{{ __('locale.Change photo') }}">
                                                <i class="fa fa-pen icon-sm text-muted"></i>
                                                <input type="file" name="photo" accept=".png, .jpg, .jpeg">
                                            </label>
                                            <span
                                                class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                data-action="cancel" data-toggle="tooltip" title=""
                                                data-original-title="Cancel avatar">
                                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Group-->
                                <!--begin::Group-->
                                <div class="form-group row">
                                    <label class="col-form-label col-3 text-lg-right text-left">{{ __('locale.fields.first_name') }}</label>
                                    <div class="col-9">
                                        <input class="form-control form-control-lg form-control-solid" type="text"
                                            value="{{ $user->first_name }}" name="first_name">
                                    </div>
                                </div>
                                <!--end::Group-->
                                <!--begin::Group-->
                                <div class="form-group row">
                                    <label class="col-form-label col-3 text-lg-right text-left">{{ __('locale.fields.second_name') }}</label>
                                    <div class="col-9">
                                        <input class="form-control form-control-lg form-control-solid" type="text"
                                            value="{{ $user->second_name }}" name="second_name">
                                    </div>
                                </div>
                                <!--end::Group-->
                                <!--begin::Group-->
                                <div class="form-group row">
                                    <label class="col-form-label col-3 text-lg-right text-left">{{ __('locale.fields.last_name') }}</label>
                                    <div class="col-9">
                                        <input class="form-control form-control-lg form-control-solid" type="text"
                                            value="{{ $user->last_name }}" name="last_name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-3 text-lg-right text-left">{{ __('locale.fields.last_name2') }}</label>
                                    <div class="col-9">
                                        <input class="form-control form-control-lg form-control-solid" type="text"
                                            value="{{ $user->last_name2 }}" name="last_name2">
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
                                                value="{{ $user->phone }}" placeholder="{{ __('locale.fields.phone') }}" name="phone">
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
                                                value="{{ $user->email }}" placeholder="{{ __('locale.fields.email') }}">
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
                                            name="document" value="{{ $user->document }}">
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
                                                value="{{ $user->birthdate }}" id="kt_datepicker">
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
                                            <option value="{{ $org->id }}" @if ($user->organizations->contains($org->id))
                                                selected
                                            @endif>{{ $org->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!--end::Group-->
                                
                            </div>
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Tab-->
                    <!--begin::Tab-->
                    <div class="tab-pane px-7" id="kt_user_edit_tab_2" role="tabpanel">
                        <!--begin::Row-->
                        <div class="row">
                            <div class="col-xl-2"></div>
                            <div class="col-xl-7">
                                <div class="my-2">
                                    <!--begin::Row-->
                                    <div class="row">
                                        <label class="col-form-label col-3 text-lg-right text-left"></label>
                                        <div class="col-9">
                                            <h6 class="text-dark font-weight-bold mb-10">{{ __('locale.Setup your current location') }}:</h6>
                                        </div>
                                    </div>
                                    <!--end::Row-->
                                    <!--begin::Group-->
                                    <div class="form-group fv-plugins-icon-container row">
                                        <label class="col-form-label col-3 text-lg-right text-left">{{
                                            __('locale.fields.address') }}</label>
                                        <div class="col-9">
                                            <input type="text"
                                                class="form-control form-control-lg form-control-solid"
                                                name="address" value="{{ $user->address }}">
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
                                            <input type="text" value="{{ $user->address_job }}"
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
                                                <option value="{{ $city->id }}" @if ($city->id == $user->city_id)
                                                    selected
                                                @endif>{{ $city->name }}</option>
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
                                                    value="{{ $user->telephone }}" placeholder="{{
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
                                                    value="{{ $user->whatsapp }}" placeholder="{{
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
                                                    value="{{ $user->jobphone }}" placeholder="{{
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
                                                    value="{{ $user->reference }}" name="reference">
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
                                                    value="{{ $user->phone_reference }}" placeholder="{{
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
                                                    value="{{ $user->whatsapp_reference }}" placeholder="{{
                                                        __('locale.fields.whatsapp_reference') }}" name="whatsapp_reference">
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Group-->
                                        @include('pages.widgets._widget-contact_via',['value' => $user->contact_via])
                                    <!--begin::Group-->
                                    <div class="form-group row">
                                        <label class="col-form-label col-3 text-lg-right text-left">{{
                                            __('locale.fields.prospectus') }}</label>
                                        <div class="col-3">
                                            <span class="switch">
                                                <label>
                                                    <input type="checkbox" name="prospectus" @if ($user->prospectus == 'on')
                                                    checked
                                                @endif>
                                                    <span></span>
                                                </label>
                                            </span>
                                        </div>
                                    </div>
                                    <!--end::Group-->
                                    
                                    
                                </div>
                            </div>
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Tab-->                    
                    
                </div>
            </form>
        </div>
    </div>

@endsection

{{-- Scripts Section --}}
@section('scripts')
<script src="{{ asset('js/pages/custom/patients/edit-patient.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/pages/custom/dates/bootstrap-datepicker.js') }}" type="text/javascript"></script>
@endsection