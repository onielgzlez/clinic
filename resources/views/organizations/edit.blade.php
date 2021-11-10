<form class="form" id="kt_form"  method="POST" action="{{ route('organizations.update', $org->id) }}" 
    enctype="multipart/form-data">
@method('PUT')

@include('organizations.form')

</form>

@section('scripts')
<script src="{{ asset('js/pages/custom/org/edit-org.js') }}" type="text/javascript"></script>
@endsection