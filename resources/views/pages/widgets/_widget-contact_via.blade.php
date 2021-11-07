<!--begin::Group-->

<div class="form-group row ">
    <label class="col-form-label col-3 text-lg-right text-left">{{
        __('locale.fields.contact_via') }}</label>
    <div class="col-9">
        <select class="form-control form-control-lg form-control-solid" name="contact_via">
            <option value="">{{ __('locale.Select') }}...</option>
            @foreach (['INTERNET','RECOMENDADO POR UN AMIGO','VI UN ANUNCIO EN LA CALLE','REFERENCIA
            FAMILIAR','FACEBOOK','PRENSA','EVENTO'] as $opt)
            <option value="{{ $opt }}" @if (isset($value)==$opt) selected @endif>{{ $opt }}</option>
            @endforeach
        </select>
    </div>
</div>
<!--end::Group-->