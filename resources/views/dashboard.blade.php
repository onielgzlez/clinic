<x-app-layout>     
    @section('title'){{ __('locale.Dashboard') }} @endsection  
    @include('layouts.base._header-mobile')

    <div class="d-flex flex-column flex-root">
        <div class="d-flex flex-row flex-column-fluid page">

            @if(config('layout.aside.self.display'))
                @include('layouts.base._aside')
            @endif

            <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">

                @include('layouts.base._header')

                <div class="content {{ Metronic::printClasses('content', false) }} d-flex flex-column flex-column-fluid" id="kt_content">

                    @if(config('layout.subheader.display'))
                        @if(array_key_exists(config('layout.subheader.layout'), config('layout.subheader.layouts')))
                            @include('layouts.partials.subheader._'.config('layout.subheader.layout'))
                        @else
                            @include('layouts.partials.subheader._'.array_key_first(config('layout.subheader.layouts')))
                        @endif
                    @endif

                    @include('layouts.base._content')
                </div>

                @include('layouts.base._footer')
            </div>
        </div>
    </div>

    @if (config('layout.extras.search.layout') == 'offcanvas')
        @include('layouts.partials.extras.offcanvas._quick-search')
    @endif

    @if (config('layout.extras.notifications.layout') == 'offcanvas')
        @include('layouts.partials.extras.offcanvas._quick-notifications')
    @endif

    @if (config('layout.extras.quick-actions.layout') == 'offcanvas')
        @include('layouts.partials.extras.offcanvas._quick-actions')
    @endif

    @if (config('layout.extras.user.layout') == 'offcanvas')
        @include('layouts.partials.extras.offcanvas._quick-user')
    @endif

    @if (config('layout.extras.quick-panel.display'))
        @include('layouts.partials.extras.offcanvas._quick-panel')
    @endif

    @include('layouts.partials.extras._scrolltop')
</x-app-layout>
