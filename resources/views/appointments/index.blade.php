{{-- Extends layout --}}
@extends('dashboard')
@section('title'){{ __('locale.Appointments') }} @endsection
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
    <span class="text-dark-50 font-weight-bold" id="kt_subheader_total">{{ __('locale.amount Total',['amount'=>$total])
        }} </span>
    <form class="ml-5">
        <div class="input-group input-group-sm input-group-solid" style="max-width: 175px">
            <input type="text" class="form-control pl-4" id="kt_subheader_search_form"
                placeholder="{{ __('locale.Search') }}..." />
            <div class="input-group-append">
                <span class="input-group-text">
                    {{ Metronic::getSVG("media/svg/icons/General/Search.svg", "svg-icon-md") }}
                </span>
            </div>
        </div>
    </form>
</div>
@endsection
@section('page_toolbar')
{{-- Page toolbar --}}
<a class="btn btn-light-primary font-weight-bold btn-sm px-4 font-size-base ml-2"
    href="{{ route('appointments.create') }}">{{__('locale.New appointment') }}</a>
@endsection
@section('page_actions')
{{-- Page toolbar --}}
<div class="dropdown dropdown-inline" data-toggle="tooltip" title="Quick actions" data-placement="left">
    <a href="#" class="btn btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        {{ Metronic::getSVG("media/svg/icons/Files/File-plus.svg", "svg-icon-success svg-icon-2x") }}
    </a>
    <div class="dropdown-menu p-0 m-0 dropdown-menu-md dropdown-menu-right">
        {{-- Navigation --}}
        <ul class="navi navi-hover">
            <li class="navi-header font-weight-bold">
                {{ __('locale.Go to') }}:
            </li>
            <li class="navi-separator mb-3"></li>
            <li class="navi-item">
                <a href="/organizations" class="navi-link">
                    <span class="navi-icon"><i class="flaticon2-drop"></i></span>
                    <span class="navi-text">{{ __('Clínicas') }}</span>
                </a>
            </li>
            <li class="navi-item">
                <a href="{{ route('patients.list') }}" class="navi-link">
                    <span class="navi-icon"><i class="flaticon2-calendar-8"></i></span>
                    <span class="navi-text">Pacientes</span>
                </a>
            </li>
            <li class="navi-item">
                <a href="#" class="navi-link">
                    <span class="navi-icon"><i class="flaticon2-telegram-logo"></i></span>
                    <span class="navi-text">Projects</span>
                </a>
            </li>
            <li class="navi-item">
                <a href="#" class="navi-link">
                    <span class="navi-icon"><i class="flaticon2-new-email"></i></span>
                    <span class="navi-text">Messages</span>
                    <span class="navi-label">
                        <span class="label label-success label-rounded">5</span>
                    </span>
                </a>
            </li>
            <li class="navi-separator mt-3"></li>
            <li class="navi-footer">
                <a class="btn btn-light-primary font-weight-bolder btn-sm" href="#">Upgrade plan</a>
                <a class="btn btn-clean font-weight-bold btn-sm" href="#" data-toggle="tooltip" data-placement="right"
                    title="Click to learn more...">Learn more</a>
            </li>
        </ul>
    </div>
</div>
@endsection
{{-- Content --}}
@section('content')

{{-- Dashboard 1 --}}

<div class="card card-custom gutter-b">
    <div class="card-header">
        <div class="card-title">
            <h3 class="card-label">{{ __('locale.Appointments management') }}
                <span class="d-block text-muted pt-2 font-size-sm">{{ __('locale.Simplified appointments management') }}</span>
            </h3>
        </div>
        <div class="card-toolbar"><a href="{{ route('appointments.create') }}" class="btn btn-primary font-weight-bolder">
                {{ Metronic::getSVG("media/svg/icons/Design/Flatten.svg", "svg-icon-md") }}
                {{ __('locale.Create appointment') }}</a>
        </div>
    </div>
    <div class="card-body">
        <div class="datatable datatable-bordered datatable-head-custom" id="kt_datatable"></div>
    </div>
</div>

@endsection

{{-- Scripts Section --}}
@section('scripts')
<script src="{{ asset('js/pages/custom/appointments/list-datatable.js') }}?c={{ config('cache.key') }}" type="text/javascript"></script>
@endsection