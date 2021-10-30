{{-- Content --}}
@if (config('layout.content.extended'))
    @include('layouts.partials.messages')
    @yield('content')
@else
    <div class="d-flex flex-column-fluid">
        <div class="{{ Metronic::printClasses('content-container', false) }}">
            @include('layouts.partials.messages')
            @yield('content')
        </div>
    </div>
@endif
