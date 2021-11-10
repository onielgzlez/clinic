<form class="form" id="kt_form" method="POST" action="{{ route('organizations.store') }}" 
enctype="multipart/form-data">
    @csrf


@include('organizations.form')


</form>

@section('scripts')
<script src="{{ asset('js/pages/custom/org/add-org.js') }}" type="text/javascript"></script>
@endsection