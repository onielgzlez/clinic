{{-- Nav --}}
<ul class="navi navi-hover py-4">
    {{-- Item --}}
    <li class="navi-item @if (@$active == 'en')active @endif">
        <a href="{{ route('change_locale',['locale'=>'en']) }}" class="navi-link @if (@$active == 'en')active @endif">
            <span class="symbol symbol-20 mr-3">
                <img src="{{ asset('media/svg/flags/226-united-states.svg') }}" alt="" />
            </span>
            <span class="navi-text">{{ trans('locale.langs.en') }}</span>
        </a>
    </li>

    {{-- Item --}}
    <li class="navi-item @if (@$active == 'es')active @endif">
        <a href="{{ route('change_locale',['locale'=>'es']) }}" class="navi-link @if (@$active == 'es')active @endif">
            <span class="symbol symbol-20 mr-3">
                <img src="{{ asset('media/svg/flags/128-spain.svg') }}" alt="" />
            </span>
            <span class="navi-text">{{ trans('locale.langs.es') }}</span>
        </a>
    </li>
</ul>