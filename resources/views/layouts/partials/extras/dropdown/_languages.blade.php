{{-- Nav --}}
<ul class="navi navi-hover py-4">
    {{-- Item --}}
    <li class="navi-item">
        <a href="{{ route('change_locale',['locale'=>'en']) }}" class="navi-link">
            <span class="symbol symbol-20 mr-3">
                <img src="{{ asset('media/svg/flags/226-united-states.svg') }}" alt="" />
            </span>
            <span class="navi-text">English</span>
        </a>
    </li>

    {{-- Item --}}
    <li class="navi-item active">
        <a href="{{ route('change_locale',['locale'=>'es']) }}" class="navi-link">
            <span class="symbol symbol-20 mr-3">
                <img src="{{ asset('media/svg/flags/128-spain.svg') }}" alt="" />
            </span>
            <span class="navi-text">Spanish</span>
        </a>
    </li>
</ul>