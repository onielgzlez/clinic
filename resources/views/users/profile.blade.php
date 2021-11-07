{{-- Extends layout --}}
@extends('dashboard')

{{-- Content --}}
@section('content')
<div class="d-flex flex-row">
  {{-- Dashboard 1 --}}
  <div class="flex-row-auto offcanvas-mobile w-250px w-xxl-350px" id="kt_profile_aside">
    <div class="card card-custom card-stretch">
      {{-- beginBody --}}
      <div class="card-body pt-4">
        {{-- beginUser --}}
        <div class="d-flex justify-content-end">&nbsp;
        </div>
        <div class="d-flex align-items-center">
          <div class="symbol symbol-60 symbol-xxl-100 mr-5 align-self-start align-self-xxl-center">
            <div class="symbol-label" style='background-image: url("{{ asset(Auth::user()->avatar) }}")'></div>
            {{-- style="background-image:url('/metronic/theme/html/demo1/dist/assets/media/users/300_21.jpg')" --}}
            <i class="symbol-badge bg-success"></i>
          </div>
          <div>
            <a href="#" class="font-weight-bolder font-size-h5 text-dark-75 text-hover-primary">
              {{ Auth::user()->shortName }}
            </a>
            <div class="text-muted">
              {{ Auth::user()->nameRoles }}
            </div>
            <div class="mt-2">&nbsp;</div>
          </div>
        </div>
        {{-- endUser --}}
        {{-- beginContact --}}
        <div class="py-9">
          <div class="d-flex align-items-center justify-content-between mb-2">
            <span class="font-weight-bold mr-2">Email:</span>
            <span class="text-muted text-hover-primary">
              {{ Auth::user()->email }}
            </span>
          </div>
          <div class="d-flex align-items-center justify-content-between mb-2">
            <span class="font-weight-bold mr-2">Phone:</span>
            <span class="text-muted">{{ Auth::user()->phone }}</span>
          </div>
          <div class="d-flex align-items-center justify-content-between">
            <span class="font-weight-bold mr-2">Location:</span>
            <span class="text-muted">{{ Auth::user()->city->name ?? '' }}</span>
          </div>
        </div>
        {{-- endContact --}}
        {{-- beginNav --}}
        <div class="navi links navi-bold navi-hover navi-active navi-link-rounded">
          <div class="navi-item mb-2">
            <a href="{{ route('user.profile.overview') }}" class="navi-link py-4">
              <span class="navi-icon mr-2">
                {{ Metronic::getSVG("media/svg/icons/Design/Layers.svg") }}
              </span>
              <span class="navi-text font-size-lg">
                Profile Overview
              </span>
            </a>
          </div>
          <div class="navi-item mb-2">
            <a href="{{ route('user.profile.info') }}" class="navi-link py-4">
              <span class="navi-icon mr-2">
                {{ Metronic::getSVG("media/svg/icons/General/User.svg") }}
              </span>
              <span class="navi-text font-size-lg">
                Personal Information
              </span>
            </a>
          </div>
          <div class="navi-item mb-2">
            <a href="{{ route('user.profile.account') }}" class="navi-link py-4">
              <span class="navi-icon mr-2">
                {{ Metronic::getSVG("media/svg/icons/Code/Compiling.svg") }}
              </span>
              <span class="navi-text font-size-lg">
                Account Information
              </span>
            </a>
          </div>
          <div class="navi-item mb-2">
            <a href="{{ route('user.profile.password') }}" class="navi-link py-4">
              <span class="navi-icon mr-2">
                {{ Metronic::getSVG("media/svg/icons/Communication/Shield-user.svg") }}
              </span>
              <span class="navi-text font-size-lg">
                Change Password
              </span>
            </a>
          </div>

        </div>
        {{-- endNav --}}
      </div>
      {{-- endBody --}}
    </div>
  </div>

  <div class="flex-row-fluid ml-lg-8">@yield('context')</div>
</div>

@endsection
@section('scripts')
  <script src="{{ asset('js/pages/custom/profile/profile.js') }}"></script>
@endsection