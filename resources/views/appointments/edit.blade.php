{{-- Extends layout --}}
@extends('dashboard')
@section('title'){{ __('locale.Edit appointment') }} @endsection
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
    <span class="text-dark-50 font-weight-bold" id="kt_subheader_total">{{ $appointment->patient->fullName }}</span>
</div>
@endsection
@section('page_toolbar')
{{-- Page toolbar --}}
<a class="btn btn-default font-weight-bold btn-sm px-3 font-size-base" href="{{ route('appointments.list') }}">{{
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
        <form class="form" id="kt_form" method="POST"
            action="{{ route('appointments.update',['id'=>$appointment->id]) }}"
            class="form form-label-right form-update">
            @csrf
            <button type="submit" class="btn" style="display: none;" id="form-btn-sub">Submit</button>
            <input type="hidden" name="user_id" value="{{ $user->id }}">
            <input type="hidden" name="patient_id" value="{{ $appointment->patient_id }}">
            <div class="row justify-content-center">
                <div class="col-9">
                    <!--begin::Row-->
                    <div class="row">
                        <label class="col-3"></label>
                        <div class="col-9">
                            <h6 class="text-dark font-weight-bold mb-10">{{ __('locale.Appointment details') }}:</h6>
                        </div>
                    </div>
                    <!--end::Row-->
                  
                    <!--begin::Group-->
                    <div class="form-group row">
                        <label class="col-form-label col-3 text-lg-right text-left">{{ __('locale.fields.date')
                            }}</label>
                        <div class="col-9">
                            <div class="row">
                                <div class="col">
                                    <div class="input-group date" id="kt_datetimepicker_7_1"
                                        data-target-input="nearest">
                                        <input type="text" name="init" class="form-control datetimepicker-input"
                                            placeholder="{{ __('locale.fields.start_date') }}"
                                            data-target="#kt_datetimepicker_7_1" value="{{ $appointment->init }}"/>
                                        <div class="input-group-append" data-target="#kt_datetimepicker_7_1"
                                            data-toggle="datetimepicker">
                                            <span class="input-group-text">
                                                <i class="ki ki-calendar"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="input-group date" id="kt_datetimepicker_7_2"
                                        data-target-input="nearest">
                                        <input type="text" name="end" class="form-control datetimepicker-input"
                                            placeholder="{{ __('locale.fields.end_date') }}"
                                            data-target="#kt_datetimepicker_7_2" value="{{ $appointment->end }}"/>
                                        <div class="input-group-append" data-target="#kt_datetimepicker_7_2"
                                            data-toggle="datetimepicker">
                                            <span class="input-group-text">
                                                <i class="ki ki-calendar"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--begin::Group-->
                    <div class="form-group row ">
                        <label class="col-form-label col-3 text-lg-right text-left">{{
                            __('locale.fields.organization') }}</label>
                        <div class="col-9">
                            <select class="form-control form-control-lg form-control-solid" name="organization_id">
                                <option value="">{{ __('locale.Select') }}...</option>
                                @foreach ($organizations as $org)
                                <option value="{{ $org->id }}" @if ($appointment->organization_id == $org->id)
                                    selected
                                @endif>{{ $org->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!--end::Group-->

                    <!--begin::Group-->
                    <div class="form-group row ">
                        <label class="col-form-label col-3 text-lg-right text-left">{{
                            __('locale.fields.area_job') }}</label>
                        <div class="col-9">
                            <select class="form-control form-control-lg form-control-solid" name="area_job_id">
                                <option value="">{{ __('locale.Select') }}...</option>
                                @foreach ($areas as $org)
                                <option value="{{ $org->id }}" @if ($appointment->area_job_id == $org->id)
                                    selected
                                @endif>{{ $org->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!--end::Group-->
                    <!--begin::Group-->
                    <div class="form-group row ">
                        <label class="col-form-label col-3 text-lg-right text-left">{{
                            __('locale.fields.status') }}</label>
                        <div class="col-9">
                            <select class="form-control form-control-lg form-control-solid" name="status">
                                <option value="">{{ __('locale.Select') }}...</option>
                                @foreach ($statuss as $org)
                                <option value="{{ $org['id'] }}" @if ($org['id']==$appointment->status) selected @endif>{{ $org['name'] }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!--end::Group-->

                    <!--begin::Group-->
                    <div class="form-group row">
                        <label class="col-form-label col-3 text-lg-right text-left">{{ __('locale.fields.observation')
                            }}</label>
                        <div class="col-9">
                            <textarea type="text" class="form-control form-control-lg form-control-solid"
                                name="observation" id="kt_autosize_1">{{$appointment->observation }}</textarea>
                        </div>
                    </div>
                    <!--end::Group-->
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

{{-- Scripts Section --}}
@section('scripts')
<script src="{{ asset('js/pages/custom/dates/bootstrap-datepicker.js') }}?c={{ config('cache.key') }}"
    type="text/javascript"></script>
<script src="{{ asset('js/pages/custom/appointments/edit-appointment.js') }}?c={{ config('cache.key') }}"
    type="text/javascript"></script>
@endsection