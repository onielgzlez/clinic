{{-- Subheader V1 --}}

<div class="subheader py-2 {{ Metronic::printClasses('subheader', false) }}" id="kt_subheader">
    <div
        class="{{ Metronic::printClasses('subheader-container', false) }} d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">

        {{-- Info --}}
        <div class="d-flex align-items-center flex-wrap mr-1">
            <!--begin::Mobile Toggle-->
            <button class="burger-icon burger-icon-left mr-4 d-inline-block d-lg-none" id="kt_subheader_mobile_toggle">
                <span></span>
            </button>
            <!--end::Mobile Toggle-->
            @hasSection('page_title')
            @yield('page_title')
            @else
            {{-- Page Title --}}
            <h5 class="text-dark font-weight-bold my-2 mr-5">
                @yield('title', $title ?? '')

                @if (config('layout.subheader.displayDesc'))
                <small>{{ config('app.desc') }}</small>
                @endif
            </h5>
            @endif
            @hasSection ('breadcrumbs')
            @yield('breadcrumbs')
            @endif
        </div>

        {{-- Toolbar --}}
        <div class="d-flex align-items-center">

            @hasSection('page_toolbar')
            @yield('page_toolbar')
            @endif

            @hasSection('page_actions')
            @yield('page_actions')
            @else
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
                            <a href="{{ route('organizations') }}" class="navi-link">
                                <span class="navi-icon"><i class="flaticon2-layout"></i></span>
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
                        @if (!Auth::user()->isAdmin())
                        <li class="navi-separator mt-3"></li>
                        <li class="navi-footer">
                            <x-dropdown-link :href="route('user.profile.upgrade')"
                                class="btn btn-light-primary font-weight-bolder btn-sm"
                                onclick="event.preventDefault();">
                                {{ __('Upgrade Plan') }}
                            </x-dropdown-link>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>