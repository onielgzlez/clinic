@if (config('layout', 'extras/user/dropdown/style') == 'light')
    {{-- Header --}}
    <div class="d-flex align-items-center p-8 rounded-top">
        {{-- Symbol --}}
        <div class="symbol symbol-md bg-light-primary mr-3 flex-shrink-0">
            <img src="{{ asset(Auth::user()->avatar) }}" alt=""/>
        </div>

        {{-- Text --}}
        <div class="text-dark m-0 flex-grow-1 mr-3 font-size-h5">{{ Auth::user()->shortName }}</div>
        {{-- <spanclass="labellabel-light-successlabel-lgfont-weight-boldlabel-inline">3messages</span> --}}
    </div>
    <div class="separator separator-solid"></div>
@else
    {{-- Header --}}
    <div class="d-flex align-items-center justify-content-between flex-wrap p-8 bgi-size-cover bgi-no-repeat rounded-top" style="background-image: url('{{ asset('media/misc/bg-1.jpg') }}')">
        <div class="d-flex align-items-center mr-2">
            {{-- Symbol --}}
            <div class="symbol bg-white-o-15 mr-3">
                <span class="symbol-label text-success font-weight-bold font-size-h4">{{ Auth::user()->firstLetter }}</span>
            </div>

            {{-- Text --}}
            <div class="text-white m-0 flex-grow-1 mr-3 font-size-h5">{{ Auth::user()->shortName }}</div>
        </div>
        {{-- <spanclass="labellabel-successlabel-lgfont-weight-boldlabel-inline">3messages</spanclass=> --}}
    </div>
@endif

{{-- Nav --}}
<div class="navi navi-spacer-x-0 pt-5">
    {{-- Item --}}
    <a href="{{ route('user.profile') }}" class="navi-item px-8">
        <div class="navi-link">
            <div class="navi-icon mr-2">
                <i class="flaticon2-calendar-3 text-success"></i>
            </div>
            <div class="navi-text">
                <div class="font-weight-bold">
                    My Profile
                </div>
                <div class="text-muted">
                    Account settings and more
                    <span class="label label-light-danger label-inline font-weight-bold">update</span>
                </div>
            </div>
        </div>
    </a>
  
    {{-- Item --}}
    <a href="#" class="navi-item px-8">
        <div class="navi-link">
            <div class="navi-icon mr-2">
                <i class="flaticon2-hourglass text-primary"></i>
            </div>
            <div class="navi-text">
                <div class="font-weight-bold">
                    My Tasks
                </div>
                <div class="text-muted">
                    latest tasks and projects
                </div>
            </div>
        </div>
    </a>

    {{-- Footer --}}
    <div class="navi-separator mt-3"></div>
    <div class="navi-footer px-8 py-5">
      <!-- Authentication -->			
			<form method="POST" action="{{ route('logout') }}" style="display: inline;">
				@csrf
				<x-dropdown-link :href="route('logout')" class="btn btn-light-primary font-weight-bold"
						onclick="event.preventDefault();
									this.closest('form').submit();">
					{{ __('Log Out') }}
				</x-dropdown-link>
			</form>
			@if (!Auth::user()->isAdmin())
			<x-dropdown-link :href="route('user.profile.upgrade')" class="btn btn-clean font-weight-bold"
				onclick="event.preventDefault();">
				{{ __('Upgrade Plan') }}
			</x-dropdown-link>
			@endif
    </div>
</div>
