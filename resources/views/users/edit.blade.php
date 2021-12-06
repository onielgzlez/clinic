{{-- Extends layout --}}
@extends('dashboard')
@section('title'){{ __('Editar usuario') }} @endsection
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
    <span class="text-dark-50 font-weight-bold" id="kt_subheader_total">{{ $user->fullName }}</span>
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
    <button class="btn btn-primary font-weight-bold btn-sm px-3 font-size-base" type="button" id="saveButton" onclick="$('#form-btn-sub').trigger('click')">{{ __('Guardar')
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
                            <span class="nav-text font-size-lg">Perfil</span>
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
                            <span class="nav-text font-size-lg">Cuenta</span>
                        </a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="nav-item mr-3">
                        <a class="nav-link" data-toggle="tab" href="#kt_user_edit_tab_3" style="">
                            <span class="nav-icon">
                                {{ Metronic::getSVG('media/svg/icons/Communication/Shield-user.svg') }}
                            </span>
                            <span class="nav-text font-size-lg">Cambiar contraseña</span>
                        </a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#kt_user_edit_tab_4" style="">
                            <span class="nav-icon">
                                {{ Metronic::getSVG('media/svg/icons/Communication/Shield-user.svg') }}
                            </span>
                            <span class="nav-text font-size-lg">Tema</span>
                        </a>
                    </li>
                    <!--end::Item-->
                </ul>
            </div>
            <!--end::Toolbar-->
        </div>
        <div class="card-body">
            <form action="{{ route('users.update',['id'=>$user->id]) }}" enctype="multipart/form-data" class="form form-label-right form-update" id="kt_form" method="POST">                
                @csrf
                <button type="submit" class="btn" style="display: none;" id="form-btn-sub">Submit</button>           
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
                                        <h6 class="text-dark font-weight-bold mb-10">Información de usuario:</h6>
                                    </div>
                                </div>
                                <!--end::Row-->
                                <!--begin::Group-->
                                <div class="form-group row">
                                    <label class="col-form-label col-3 text-lg-right text-left">Avatar</label>
                                    <div class="col-9">
                                        <div class="image-input image-input-empty image-input-outline"
                                            id="kt_user_edit_avatar" style="background-image: url(/{{ $user->avatar }})">
                                            <div class="image-input-wrapper"></div>
                                            <label
                                                class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                data-action="change" data-toggle="tooltip" title=""
                                                data-original-title="Change avatar">
                                                <i class="fa fa-pen icon-sm text-muted"></i>
                                                <input type="file" name="photo" accept=".png, .jpg, .jpeg">
                                            </label>
                                            <span
                                                class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                data-action="cancel" data-toggle="tooltip" title=""
                                                data-original-title="Cancel avatar">
                                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                                            </span>
                                            <span
                                                class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                data-action="remove" data-toggle="tooltip" title=""
                                                data-original-title="Remove avatar">
                                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Group-->
                                <!--begin::Group-->
                                <div class="form-group row">
                                    <label class="col-form-label col-3 text-lg-right text-left">Primer nombre</label>
                                    <div class="col-9">
                                        <input class="form-control form-control-lg form-control-solid" type="text"
                                            value="{{ $user->first_name }}" name="first_name">
                                    </div>
                                </div>
                                <!--end::Group-->
                                <!--begin::Group-->
                                <div class="form-group row">
                                    <label class="col-form-label col-3 text-lg-right text-left">Segundo nombre</label>
                                    <div class="col-9">
                                        <input class="form-control form-control-lg form-control-solid" type="text"
                                            value="{{ $user->second_name }}" name="second_name">
                                    </div>
                                </div>
                                <!--end::Group-->
                                <!--begin::Group-->
                                <div class="form-group row">
                                    <label class="col-form-label col-3 text-lg-right text-left">Primer apellido</label>
                                    <div class="col-9">
                                        <input class="form-control form-control-lg form-control-solid" type="text"
                                            value="{{ $user->last_name }}" name="last_name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-3 text-lg-right text-left">Segundo apellido</label>
                                    <div class="col-9">
                                        <input class="form-control form-control-lg form-control-solid" type="text"
                                            value="{{ $user->last_name2 }}" name="last_name2">
                                    </div>
                                </div>
                                <!--end::Group-->
                                <!--begin::Group-->
                                <div class="form-group row">
                                    <label class="col-form-label col-3 text-lg-right text-left">Teléfono</label>
                                    <div class="col-9">
                                        <div class="input-group input-group-lg input-group-solid">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="la la-phone"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control form-control-lg form-control-solid"
                                                value="{{ $user->phone }}" placeholder="Teléfono" name="phone">
                                        </div>
                                    </div>
                                </div>
                                <!--end::Group-->
                                <!--begin::Group-->
                                <div class="form-group row">
                                    <label class="col-form-label col-3 text-lg-right text-left">Cédula</label>
                                    <div class="col-9">
                                        <input type="text" class="form-control form-control-lg form-control-solid"
                                            name="document" value="{{ $user->document }}" >
                                    </div>
                                </div>
                                <!--end::Group-->
                                @if ($user->type == 'worker')
                                <!--begin::Group-->
                                <div class="form-group row">
                                    <label class="col-form-label col-3 text-lg-right text-left">Área de trabajo</label>
                                    <div class="col-9">
                                        <select class="form-control form-control-lg form-control-solid" name="area_job_id">
                                            <option value="">{{ __('locale.Select') }}...</option>
                                            @foreach ($areas as $area)
                                            <option value="{{ $area->id }}" @if ($user->area_job_id == $area->id)
                                                selected
                                            @endif>{{ $area->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!--end::Group-->
                                <!--begin::Group-->
                                <div class="form-group row">
                                    <label class="col-form-label col-3 text-lg-right text-left">Ciudad</label>
                                    <div class="col-9">
                                        <select class="form-control form-control-lg form-control-solid" name="city_id">
                                            <option value="">{{ __('locale.Select') }}...</option>
                                            @foreach ($cities as $city)
                                            <option value="{{ $city->id }}" @if ($user->city_id == $city->id)
                                                selected
                                            @endif>{{ $city->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!--end::Group-->
                                <!--begin::Group-->
                                <div class="form-group row">
                                    <label class="col-form-label col-3 text-lg-right text-left">Clasificación</label>
                                    <div class="col-9">
                                        <select class="form-control form-control-lg form-control-solid" name="classificator_id">
                                            <option value="">{{ __('locale.Select') }}...</option>                                           
                                            @foreach ($classifications as $classificator)
                                            <option value="{{ $classificator->id }}" @if ($user->classificator_id == $classificator->id)
                                                selected
                                            @endif>{{ $classificator->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!--end::Group-->
                                @endif
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
                                            <h6 class="text-dark font-weight-bold mb-10">Cuenta:</h6>
                                        </div>
                                    </div>
                                    <!--end::Row-->
                                    <!--begin::Group-->
                                    <div class="form-group row">
                                        <label class="col-form-label col-3 text-lg-right text-left">Correo
                                            Address</label>
                                        <div class="col-9">
                                            <div class="input-group input-group-lg input-group-solid">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="la la-at"></i>
                                                    </span>
                                                </div>
                                                <input type="text" name="email"
                                                    class="form-control form-control-lg form-control-solid mail"
                                                    value="{{ $user->email }}" placeholder="Email">
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Group-->

                                    <!--begin::Group-->
                                    <div class="form-group row">
                                        <label class="col-form-label col-3 text-lg-right text-left">{{ __('locale.fields.locale') }}</label>
                                        <div class="col-9">
                                            <select class="form-control form-control-lg form-control-solid" name="locale">
                                                <option value="">{{ __('locale.Select') }}...</option>
                                                @foreach (['en'=>'English','es'=>'Español'] as $key=>$locale)
                                                <option value="{{ $key }}" @if ($user->locale == $key)
                                                    selected
                                                @endif>{{ $locale }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <!--end::Group-->
                                    <!--begin::Form Group-->
										<div class="form-group row">
											<label class="col-3 col-form-label">{{ __('locale.fields.timezone') }}</label>
											<div class="col-9">
                                                <input type="hidden" id="tzVal" value="{{ $user->timezone }}">
												<select class="form-control form-control-lg form-control-solid" name="timezone" id="tz">
                                                </select>
                                            </div>
                                        </div>
                                    <!--end::Group-->
                                    <!--begin::Form Group-->
													<div class="form-group row align-items-center">
														<label class="col-xl-3 col-lg-3 col-form-label">{{ __('locale.fields.communication') }}</label>
														<div class="col-lg-9 col-xl-6">
															<div class="checkbox-inline">
																<label class="checkbox">
																<input type="checkbox" name="options[mail]" @if (isset($user->options['mail']) && $user->options['mail'])
                                                                    checked
                                                                @endif />
																<span></span>{{ __('locale.fields.email') }}</label>
																<label class="checkbox">
																<input type="checkbox" name="options[sms]" @if (isset($user->options['sms']) && $user->options['sms'])
                                                                checked
                                                            @endif />
																<span></span>SMS</label>
																<label class="checkbox">
																<input type="checkbox" name="options[whatsapp]" @if (isset($user->options['whatsapp']) && $user->options['whatsapp'])
                                                                checked
                                                            @endif />
																<span></span>WhatsApp</label>
															</div>
														</div>
													</div>
													<!--begin::Form Group-->
                                            <!--begin::Group-->
                                    <!--begin::Group-->
                                    <div class="form-group row">
                                        <label class="col-form-label col-3 text-lg-right text-left">Rol</label>
                                        <div class="col-9">
                                            <select class="form-control form-control-lg form-control-solid" name="roles">
                                                <option value="">{{ __('locale.Select') }}...</option>
                                                @foreach ($roles as $role)
                                                <option value="{{ $role->id }}" @if ($user->roles->contains($role->id))
                                                    selected
                                                @endif>{{ $role->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <!--end::Group-->
                                    <!--begin::Group-->
                                    <div class="form-group row">
                                        <label class="col-form-label col-3 text-lg-right text-left">Estado</label>
                                        <div class="col-9">
                                            <select class="form-control form-control-lg form-control-solid" name="status">
                                                <option value="">{{ __('locale.Select') }}...</option>
                                                @foreach (['1'=>'Activo','2'=>'Pendiente','3'=>'Suspendido'] as $key=>$status)
                                                <option value="{{ $key }}" @if ($user->status == $key)
                                                    selected
                                                @endif>{{ $status }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <!--end::Group-->
                                </div>
                            </div>
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Tab-->
                    <!--begin::Tab-->
                    <div class="tab-pane px-7" id="kt_user_edit_tab_3" role="tabpanel">
                        <!--begin::Body-->
                        <div class="card-body">
                            <!--begin::Row-->
                            <div class="row">
                                <div class="col-xl-2"></div>
                                <div class="col-xl-7">
                                    <!--begin::Row-->
                                    <div class="row">
                                        <label class="col-3"></label>
                                        <div class="col-9">
                                            <h6 class="text-dark font-weight-bold mb-10">Cambia tu contraseña:</h6>
                                        </div>
                                    </div>
                                    <!--end::Row-->
                                    <!--begin::Group-->
                                    <div class="form-group row">
                                        <label class="col-form-label col-3 text-lg-right text-left">Nueva contraseña</label>
                                        <div class="col-9">
                                            <input class="form-control form-control-lg form-control-solid clp"
                                                type="password" value="" name="password">
                                        </div>
                                    </div>
                                    <!--end::Group-->
                                    <!--begin::Group-->
                                    <div class="form-group row">
                                        <label class="col-form-label col-3 text-lg-right text-left">Verificar contraseña</label>
                                        <div class="col-9">
                                            <input class="form-control form-control-lg form-control-solid clp"
                                                type="password" value="" name="confirm-password">
                                        </div>
                                    </div>
                                    <!--end::Group-->
                                </div>
                            </div>
                            <!--end::Row-->
                        </div>
                        <!--end::Body-->
                        <!--begin::Footer-->
                        <div class="card-footer pb-0">
                            <div class="row">
                                <div class="col-xl-2"></div>
                                <div class="col-xl-7">
                                    <div class="row">
                                        <div class="col-3"></div>
                                        <div class="col-9">
                                            {{-- <a href="#" class="btn btn-light-primary font-weight-bold">Guardar contraseña</a> --}}
                                            <a href="#" onclick="event.preventDefault(); $('.clp').val('')"
                                                class="btn btn-clean font-weight-bold">Limpiar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end::Footer-->
                    </div>
                    <!--end::Tab-->
                    <!--begin::Tab-->
                    <div class="tab-pane px-7" id="kt_user_edit_tab_4" role="tabpanel">
                        <div class="row">
                            <div class="col-xl-2"></div>
                            <div class="col-xl-8">
                                <div class="my-2">
                                    <div class="row">
                                        <label class="col-form-label col-3 text-lg-right text-left"></label>
                                        <div class="col-9">
                                            <h6 class="text-dark font-weight-bold mb-7">Configuración de tema:</h6>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label class="col-form-label col-3 text-lg-right text-left">Encabezado oscuro</label>
                                        <div class="col-3">
                                            <span class="switch">
                                                <label>
                                                    <input type="checkbox" name="headerTheme" @if ($user->headerTheme == 'dark')
                                                        checked
                                                    @endif>
                                                    <span></span>
                                                </label>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-3 text-lg-right text-left">Lateral oscuro</label>
                                        <div class="col-3">
                                            <span class="switch">
                                                <label>
                                                    <input type="checkbox" name="sideTheme" @if ($user->sideTheme == 'dark')
                                                    checked
                                                @endif>
                                                    <span></span>
                                                </label>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-3 text-lg-right text-left">Menú oscuro</label>
                                        <div class="col-3">
                                            <span class="switch">
                                                <label>
                                                    <input type="checkbox" name="desktopTheme" @if ($user->desktopTheme == 'dark')
                                                    checked
                                                @endif>
                                                    <span></span>
                                                </label>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-3 text-lg-right text-left">Logo oscuro</label>
                                        <div class="col-3">
                                            <span class="switch">
                                                <label>
                                                    <input type="checkbox" name="brandTheme" @if ($user->brandTheme == 'dark')
                                                    checked
                                                @endif>
                                                    <span></span>
                                                </label>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Tab-->
                </div>
            </form>
        </div>
    </div>

@endsection

{{-- Scripts Section --}}
@section('scripts')
<script src="{{ asset('js/pages/custom/user/edit-user.js') }}?c={{ config('cache.key') }}" type="text/javascript"></script>
@endsection