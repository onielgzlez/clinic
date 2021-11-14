{{-- Extends layout --}}
@extends('dashboard')
@section('title'){{ __('CLINICA') }} @endsection
@section('page_title')
{{-- Page Title --}}
<h5 class="text-dark font-weight-bold my-2 mr-5">
    @yield('title', $title ?? '')

    @if (isset($page_description) && config('layout.subheader.displayDesc'))
    <small>{{ @$page_description }}</small>
    @endif
</h5>
<div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
<div class="d-flex align-items-center" id="kt_subheader_search">
    <span class="text-dark-50 font-weight-bold" id="kt_subheader_total">{{ __('Información de la Clinica') }}</span>
</div>
@endsection
@section('page_toolbar')
{{-- Page toolbar --}}
<a class="btn btn-default font-weight-bold btn-sm px-3 font-size-base" href="{{ route('organizations.index') }}">{{ __('Atrás')
    }}</a>
@endsection
@section('page_actions')
{{-- Page toolbar --}}
<div class="btn-group ml-2">
    <button class="btn btn-primary font-weight-bold btn-sm px-3 font-size-base" type="submit" id="saveButton"
        onclick="$('#form-btn-sub').trigger('click')">{{ __('Guardar')
        }}</button>
</div>
@endsection
{{-- Content --}}
@section('content')
{{-- Dashboard 1 --}}
<div class="card card-custom card-transparent">
    <div class="card-body p-0">
        <!--begin::Wizard-->
        <div class="wizard wizard-4" id="kt_wizard" data-wizard-state="step-first" data-wizard-clickable="true">
            
            <!--begin::Card-->
            <div class="card card-custom card-shadowless rounded-top-0">
                <!--begin::Body-->
                <div class="card-body p-0">
                    <div class="row justify-content-center py-8 px-8 py-lg-15 px-lg-10">
                        <div class="col-xl-12 col-xxl-10">
                            <!--begin::Wizard Form-->                            
                                <div class="row justify-content-center">
                                    <div class="col-xl-9">
                                        <!--begin::Wizard Step 1-->
                                        <div class="my-5 step" data-wizard-type="step-content"
                                            data-wizard-state="current">
                                            <h5 class="text-dark font-weight-bold mb-10">Detalles de perfil:</h5>
                                            <!--begin::Group-->
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label text-lg-right text-left">LOGO</label>
                                                <div class="col-lg-9 col-xl-9">
                                                    <div class="image-input image-input-empty image-input-outline" 
                                                    id="kt_org_logo" style="background-image: url(/{{ $org->photo }})">
                                                        <div class="image-input-wrapper"></div>
                                                        <label
                                                            class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                            data-action="change" data-toggle="tooltip" title=""
                                                            data-original-title="Cambiar LOGO">
                                                            <i class="fa fa-pen icon-sm text-muted"></i>
                                                            <input type="file" name="photo"
                                                                accept=".png, .jpg, .jpeg" />
                                                        </label>
                                                        <span
                                                            class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                            data-action="cancel" data-toggle="tooltip"
                                                            title="Remover LOGO">
                                                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end::Group-->
                                            <!--begin::Group-->
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label text-lg-right text-left">Nombre de la Institucion</label>
                                                <div class="col-lg-9 col-xl-9">
                                                    <input class="form-control form-control-solid form-control-lg"
                                                        name="name" id="name" type="text" value="{{isset($org->name)?$org->name:''}}" />
                                                </div>
                                            </div>
                                            <!--end::Group-->
                                             <!--begin::Group-->
                                             <div class="form-group row">
                                                <label
                                                    class="col-form-label col-3 text-lg-right text-left">Representante</label>
                                                <div class="col-9">
                                                    <select class="form-control form-control-lg form-control-solid"
                                                        name="user_id">
                                                        <option value="">Seleccione...</option>
                                                        @foreach ($user as $us)
                                                        <option value="{{$us->id}}"@if ($org->city_id == $us->id) selected @endif x>{{ $us->fullname }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <!--end::Group-->  
                                            <!--begin::Group-->
                                            <div class="form-group row">
                                                <label
                                                    class="col-form-label col-3 text-lg-right text-left">Teléfono</label>
                                                <div class="col-9">
                                                    <div class="input-group input-group-lg input-group-solid">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="la la-phone"></i>
                                                            </span>
                                                        </div>
                                                        <input type="text"
                                                            class="form-control form-control-lg form-control-solid"
                                                            value="{{isset($org->phone)?$org->phone:''}}" placeholder="Teléfono" name="phone">
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end::Group--> 
                                            <!--begin::Group-->
                                            <div class="form-group row">
                                                <label class="col-form-label col-3 text-lg-right text-left">Correo
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
                                                            value="{{isset($org->email)?$org->email:''}}" placeholder="Email">
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end::Group-->                                              
                                            <!--begin::Group-->
                                            <div class="form-group row">
                                                <label
                                                    class="col-form-label col-3 text-lg-right text-left">Ciudad</label>
                                                <div class="col-9">
                                                    <select class="form-control form-control-lg form-control-solid" name="city_id">
                                                        <option value="">Seleccione...</option>                                                        
                                                        @foreach ($city as $cit)
                                                        <option value="{{ $cit->id }}"@if ($org->city_id == $cit->id) selected @endif >{{ $cit->name }}</option>
                                                        @endforeach                                                        
                                                    </select>
                                                </div>
                                            </div>
                                            <!--end::Group-->
                                            <!--begin::Group-->                                            
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label text-lg-right text-left">Direccion</label>
                                                <div class="col-lg-9 col-xl-9">
                                                    <input class="form-control form-control-solid form-control-lg"
                                                        name="address" type="text" value="{{isset($org->address)?$org->address:''}}" />
                                                </div>
                                            </div>
                                            <!--end::Group-->
                                            <!--begin::Group-->
                                            <div class="form-group row">
                                                <label
                                                    class="col-form-label col-3 text-lg-right text-left">Estado</label>
                                                <div class="col-9">
                                                    <select class="form-control form-control-lg form-control-solid"
                                                        name="status">
                                                        <option value="">Seleccione...</option>
                                                        @foreach (['1'=>'Activo','2'=>'Pendiente','3'=>'Suspendido'] as
                                                        $key=>$status)
                                                        <option value="{{ $key }}" @if ($org->status == $key) selected @endif >{{ $status }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <!--end::Group--> 
                                            <div>
                                                <button type="submit" value="Guardar" class="btn btn-success font-weight-bolder text-uppercase px-9 py-4" data-wizard-type="action-submit">Crear</button>
                                            </div>                         
                                        </div>                                        
                                    </div>
                                </div>                            
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
<script src="{{ asset('js/pages/custom/org/add-org.js') }}" type="text/javascript"></script>
@endsection
{{-- Styles Section --}}
@section('styles')
<link href="{{ asset('css/pages/wizard/wizard-4.css') }}" rel="stylesheet" type="text/css" />
<style>
    .workerData{
        visibility: hidden;
    }
</style>
@endsection