{{-- Extends layout --}}
@extends('dashboard')

{{-- Content --}}
@section('content')

{{-- Dashboard 1 --}}


<div class="card card-custom gutter-b">
    <div class="card-header">
        <div class="card-title">
            <h3 class="card-label">{{ 'Usuarios' }}</h3>
        </div>
        <div class="card-toolbar">
            </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-head-custom table-vertical-center overflow-hidden">
                <thead>
                    <tr>
                        <th class="selection-cell-header" data-row-selection="true"><input type="checkbox"
                                style="display: none;"><label class="checkbox checkbox-single"><input
                                    type="checkbox"><span></span></label></th>
                        <th tabindex="0" aria-label="ID sort asc" class="sortable sortable-active">ID</th>
                        <th tabindex="0" aria-label="Firstname sortable" class="sortable">Firstname</th>
                        <th tabindex="0" aria-label="Lastname sortable" class="sortable">Lastname</th>
                        <th tabindex="0" aria-label="Email sortable" class="sortable">Email</th>
                        <th tabindex="0" aria-label="Status sortable" class="sortable">Status</th>
                        <th tabindex="0" aria-label="Type sortable" class="sortable">Rol</th>
                        <th tabindex="0" class="text-right pr-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

{{-- Scripts Section --}}
@section('scripts')
<script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>
@endsection