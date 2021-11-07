{{-- Extends layout --}}
@extends('dashboard')
@section('title'){{ __('Nuevo usuario') }} @endsection
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
    <span class="text-dark-50 font-weight-bold" id="kt_subheader_total">{{ __('Información de usuario') }}</span>
</div>
@endsection
@section('page_toolbar')
{{-- Page toolbar --}}
<a class="btn btn-default font-weight-bold btn-sm px-3 font-size-base" href="{{ route('users.list') }}">{{ __('Atrás')
    }}</a>
@endsection
@section('page_actions')
{{-- Page toolbar --}}
<div class="btn-group ml-2">
    <button class="btn btn-primary font-weight-bold btn-sm px-3 font-size-base" type="button" id="saveButton"
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
            <!--begin::Wizard Nav-->
            <div class="wizard-nav">
                <div class="wizard-steps">
                    <div class="wizard-step" data-wizard-type="step" data-wizard-state="current">
                        <div class="wizard-wrapper">
                            <div class="wizard-number">1</div>
                            <div class="wizard-label">
                                <div class="wizard-title">Perfil</div>
                                <div class="wizard-desc">Información de usuario</div>
                            </div>
                        </div>
                    </div>
                    <div class="wizard-step" data-wizard-type="step">
                        <div class="wizard-wrapper">
                            <div class="wizard-number">2</div>
                            <div class="wizard-label">
                                <div class="wizard-title">Cuenta</div>
                                <div class="wizard-desc">Configuración de cuenta</div>
                            </div>
                        </div>
                    </div>
                    <div class="wizard-step" data-wizard-type="step">
                        <div class="wizard-wrapper">
                            <div class="wizard-number">3</div>
                            <div class="wizard-label">
                                <div class="wizard-title">Tema</div>
                                <div class="wizard-desc">Configuración de tema</div>
                            </div>
                        </div>
                    </div>
                    <div class="wizard-step" data-wizard-type="step">
                        <div class="wizard-wrapper">
                            <div class="wizard-number">4</div>
                            <div class="wizard-label">
                                <div class="wizard-title">Datos</div>
                                <div class="wizard-desc">Revisar y enviar</div>
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
                            <form class="form" id="kt_form" method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row justify-content-center">
                                    <div class="col-xl-9">
                                        <!--begin::Wizard Step 1-->
                                        <div class="my-5 step" data-wizard-type="step-content"
                                            data-wizard-state="current">
                                            <h5 class="text-dark font-weight-bold mb-10">Detalles de perfil:</h5>
                                            <!--begin::Group-->
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label text-lg-right text-left">Avatar</label>
                                                <div class="col-lg-9 col-xl-9">
                                                    <div class="image-input image-input-outline"
                                                        id="kt_user_add_avatar">
                                                        <div class="image-input-wrapper"
                                                            style="background-image: url({{ asset('media/users/default.jpg') }})">
                                                        </div>
                                                        <label
                                                            class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                            data-action="change" data-toggle="tooltip" title=""
                                                            data-original-title="Change avatar">
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
                                                <label class="col-xl-3 col-lg-3 col-form-label text-lg-right text-left">Primer Nombre</label>
                                                <div class="col-lg-9 col-xl-9">
                                                    <input class="form-control form-control-solid form-control-lg"
                                                        name="first_name" type="text" value="" />
                                                </div>
                                            </div>
                                            <!--end::Group-->
                                            <!--begin::Group-->
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label text-lg-right text-left">Segundo Nombre</label>
                                                <div class="col-lg-9 col-xl-9">
                                                    <input class="form-control form-control-solid form-control-lg"
                                                        name="second_name" type="text" value="" />
                                                </div>
                                            </div>
                                            <!--end::Group-->
                                            <!--begin::Group-->
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label text-lg-right text-left">Primer Apellido</label>
                                                <div class="col-lg-9 col-xl-9">
                                                    <input class="form-control form-control-solid form-control-lg"
                                                        name="last_name" type="text" value="" />
                                                </div>
                                            </div>
                                            <!--end::Group-->
                                            <!--begin::Group-->
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label text-lg-right text-left">Segundo Apellido</label>
                                                <div class="col-lg-9 col-xl-9">
                                                    <input class="form-control form-control-solid form-control-lg"
                                                        name="last_name2" type="text" value="" />
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
                                                            value="" placeholder="Teléfono" name="phone">
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end::Group-->
                                            <!--begin::Group-->
                                            <div class="form-group row">
                                                <label
                                                    class="col-form-label col-3 text-lg-right text-left">Cédula</label>
                                                <div class="col-9">
                                                    <input type="text"
                                                        class="form-control form-control-lg form-control-solid"
                                                        name="document" value="">
                                                </div>
                                            </div>
                                            <!--end::Group-->
                                            <!--begin::Group-->
                                            <div class="form-group row">
                                                <label class="col-form-label col-3 text-lg-right text-left">Tipo</label>
                                                <div class="col-9">
                                                    <select class="form-control form-control-lg form-control-solid"
                                                        name="type" id="userType">
                                                        <option value="">Seleccione...</option>
                                                        <option value="user">{{ __('Usuario') }}</option>
                                                        <option value="worker">{{ __('Trabajador') }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <!--end::Group-->

                                            <!--begin::Group-->
                                            <div class="form-group row workerData">
                                                <label class="col-form-label col-3 text-lg-right text-left">Área de
                                                    trabajo</label>
                                                <div class="col-9">
                                                    <select class="form-control form-control-lg form-control-solid"
                                                        name="area_job_id">
                                                        <option value="">Seleccione...</option>
                                                        @foreach ($areas as $area)
                                                        <option value="{{ $area->id }}">{{ $area->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <!--end::Group-->
                                            <!--begin::Group-->
                                            <div class="form-group row workerData">
                                                <label
                                                    class="col-form-label col-3 text-lg-right text-left">Ciudad</label>
                                                <div class="col-9">
                                                    <select class="form-control form-control-lg form-control-solid"
                                                        name="city_id">
                                                        <option value="">Seleccione...</option>
                                                        @foreach ($cities as $city)
                                                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <!--end::Group-->
                                            <!--begin::Group-->
                                            <div class="form-group row workerData">
                                                <label
                                                    class="col-form-label col-3 text-lg-right text-left">Clasificación</label>
                                                <div class="col-9">
                                                    <select class="form-control form-control-lg form-control-solid"
                                                        name="classificator_id">
                                                        <option value="">Seleccione...</option>
                                                        @foreach ($classifications as $classificator)
                                                        <option value="{{ $classificator->id }}">{{ $classificator->name
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
                                            <h5 class="text-dark font-weight-bold mb-10 mt-5">Detalles de cuenta de
                                                usuario
                                            </h5>

                                            <!--begin::Group-->
                                            <div class="form-group row">
                                                <label
                                                    class="col-form-label col-3 text-lg-right text-left">Idioma</label>
                                                <div class="col-9">
                                                    <select class="form-control form-control-lg form-control-solid"
                                                        name="locale">
                                                        <option value="">Seleccione...</option>
                                                        @foreach (['en'=>'English','es'=>'Español'] as $key=>$locale)
                                                        <option value="{{ $key }}">{{ $locale }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <!--end::Group-->
                                            <!--begin::Group-->
                                            <div class="form-group row">
                                                <label class="col-form-label col-3 text-lg-right text-left">Rol</label>
                                                <div class="col-9">
                                                    <select class="form-control form-control-lg form-control-solid"
                                                        name="roles">
                                                        <option value="">Seleccione...</option>
                                                        @foreach ($roles as $role)
                                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                        @endforeach
                                                    </select>
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
                                                        <option value="{{ $key }}">{{ $status }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <!--end::Group-->
                                            <div class="separator separator-dashed my-10"></div>
                                            <h5 class="text-dark font-weight-bold mb-10">Configuración de cuenta</h5>
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
                                                            value="" placeholder="Email">
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end::Group-->
                                            <!--begin::Group-->
                                            <div class="form-group row">
                                                <label class="col-form-label col-3 text-lg-right text-left">Nueva
                                                    contraseña</label>
                                                <div class="col-9">
                                                    <input class="form-control form-control-lg form-control-solid clp"
                                                        type="password" value="" name="password">
                                                </div>
                                            </div>
                                            <!--end::Group-->
                                            <!--begin::Group-->
                                            <div class="form-group row">
                                                <label class="col-form-label col-3 text-lg-right text-left">Verificar
                                                    contraseña</label>
                                                <div class="col-9">
                                                    <input class="form-control form-control-lg form-control-solid clp"
                                                        type="password" value="" name="confirm-password">
                                                </div>
                                            </div>
                                            <!--end::Group-->

                                        </div>
                                        <!--end::Wizard Step 2-->
                                        <!--begin::Wizard Step 3-->
                                        <div class="my-5 step" data-wizard-type="step-content">
                                            <h5 class="mb-10 font-weight-bold text-dark">Configuración de tema:</h5>
                                            <div class="form-group row mb-2">
                                                <label class="col-form-label col-3 text-lg-right text-left">Encabezado
                                                    oscuro</label>
                                                <div class="col-3">
                                                    <span class="switch">
                                                        <label>
                                                            <input type="checkbox" name="headerTheme" >
                                                            <span></span>
                                                        </label>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-form-label col-3 text-lg-right text-left">Lateral
                                                    oscuro</label>
                                                <div class="col-3">
                                                    <span class="switch">
                                                        <label>
                                                            <input type="checkbox" name="sideTheme" >
                                                            <span></span>
                                                        </label>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-form-label col-3 text-lg-right text-left">Menú
                                                    oscuro</label>
                                                <div class="col-3">
                                                    <span class="switch">
                                                        <label>
                                                            <input type="checkbox" name="desktopTheme" >
                                                            <span></span>
                                                        </label>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-form-label col-3 text-lg-right text-left">Logo
                                                    oscuro</label>
                                                <div class="col-3">
                                                    <span class="switch">
                                                        <label>
                                                            <input type="checkbox" name="brandTheme" >
                                                            <span></span>
                                                        </label>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Wizard Step 3-->
                                <!--begin::Wizard Step 4-->
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
                                            data-wizard-type="action-prev">Previous</button>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-success font-weight-bolder px-9 py-4"
                                            data-wizard-type="action-submit">Submit</button>
                                        <button type="button" id="next-step"
                                            class="btn btn-primary font-weight-bolder px-9 py-4"
                                            data-wizard-type="action-next">Next</button>
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
<script src="{{ asset('js/pages/custom/user/add-user.js') }}" type="text/javascript"></script>
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