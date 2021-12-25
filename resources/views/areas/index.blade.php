{{-- Extends layout --}}
@extends('dashboard')
@section('title')Especialidades @endsection
@section('page_title')
{{-- Page Title --}}
<h5 class="text-dark font-weight-bold my-2 mr-5">
    @yield('title', $title ?? '')

    @if (isset($page_description) && config('layout.subheader.displayDesc'))
    <small>{{ @$page_description }}</small>
    @endif
</h5>
<div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
<div class="d-flex align-items-center" id="kt_subheader_search">
    <span class="text-dark-50 font-weight-bold" id="kt_subheader_total">{{ __('locale.amount Total',['amount'=>$total]) }}</span>
    <form class="ml-5">
        <div class="input-group input-group-sm input-group-solid" style="max-width: 175px">
            <input type="text" class="form-control pl-4" id="kt_subheader_search_form" placeholder="{{ __('locale.Search') }}..." />
            <div class="input-group-append">
                <span class="input-group-text">
                    {{ Metronic::getSVG("media/svg/icons/General/Search.svg", "svg-icon-md") }}
                </span>
            </div>
        </div>
    </form>
</div>
@endsection
@section('page_toolbar')
{{-- Page toolbar --}}
<a class="btn btn-light-primary font-weight-bold btn-sm px-4 font-size-base ml-2" href="{{ route('areas.create') }}">{{
    __('locale.New specialty') }}</a>
@endsection
@section('page_actions')
{{-- Page toolbar --}}
<div class="dropdown dropdown-inline" data-toggle="tooltip" title="Quick actions" data-placement="left">
    <a href="#" class="btn btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        {{ Metronic::getSVG("media/svg/icons/Files/File-plus.svg", "svg-icon-success svg-icon-2x") }}
    </a>
    <div class="dropdown-menu p-0 m-0 dropdown-menu-md dropdown-menu-right">
        {{-- Navigation --}}
        <ul class="navi navi-hover">
            <li class="navi-header font-weight-bold">
                {{ __('locale.Go back') }}:
            </li>
            <li class="navi-separator mb-3"></li>
            <li class="navi-item">
                <a href="{{ route('organizations.index') }}" class="navi-link">
                    <span class="navi-icon"><i class="flaticon2-drop"></i></span>
                    <span class="navi-text">{{ __('Clínicas') }}</span>
                </a>
            </li>
            <li class="navi-item">
                <a href="#" class="navi-link">
                    <span class="navi-icon"><i class="flaticon2-calendar-8"></i></span>
                    <span class="navi-text">Support Cases</span>
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
            <li class="navi-separator mt-3"></li>
            <li class="navi-footer">
                <a class="btn btn-light-primary font-weight-bolder btn-sm" href="#">Upgrade plan</a>
                <a class="btn btn-clean font-weight-bold btn-sm" href="#" data-toggle="tooltip" data-placement="right"
                    title="Click to learn more...">Learn more</a>
            </li>
        </ul>
    </div>
</div>
@endsection
{{-- Content --}}
@section('content')

{{-- Dashboard 1 --}}
 <!--begin::Card-->
 <div class="card card-custom">
    <div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
            <h3 class=" flaticon2-layers card-label">  ESPECIALIDADES
                <span class="d-block text-muted pt-2 font-size-sm">Listado de Especialidades y breve descripcion</span>
            </h3>
        </div>
        <div class="card-toolbar">
            <!--end::Dropdown-->
            <!--begin::Button-->
            <a href="javascript: void(0)" data-toggle="modal" data-target="#AddModal"
                class="btn btn-primary font-weight-bolder">
                <span class="svg-icon svg-icon-md">
                    <!--begin::Svg Icon | path:/metronic/theme/html/demo6/dist/assets/media/svg/icons/Design/Flatten.svg-->
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                        height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"></rect>
                            <circle fill="#000000" cx="9" cy="15" r="6"></circle>
                            <path
                                d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z"
                                fill="#000000" opacity="0.3"></path>
                        </g>
                    </svg>
                    <!--end::Svg Icon-->
                </span>Agregar Especialiad</a>
            <!--end::Button-->

            <!------------------------------------------------ Modal add Area ------------------------------------------------>
            <div class="modal fade" id="EditModal" tabindex="-1" data-backdrop="static" role="dialog"
                aria-labelledby="Edit Modal" aria-hidden="true">
                <div class="modal-dialog modal-sm" role="document">
                    <form action="{{ route('areas.store') }}" name="areas" id="areas" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="modal-title" id="EditModal"> Agregar Especialidad</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="align-items-center mb-12">
                                    <div class="form-group">
                                        <label for="usr">Especialidad</label>
                                        <input class="form-control" type="text" name="name" id="name" value="">
                                    </div>
                                    <div class="form-floating">
                                        <label for="floatingTextarea">Descripcion</label>
                                        <textarea class="form-control" placeholder="Breve descripcion ..."
                                            name="description" id="floatingTextarea">
                            </textarea>
                                    </div>

                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                    </form>
                </div>
            </div>
            <!------------------------------------------------ End Modal ------------------------------------------------>
        </div>
    </div>
</div>
<!---------------BODY---------->    
<div class="card-body">
    <div class="datatable datatable-default datatable-bordered datatable-loaded">
        <table class="datatable-bordered datatable-head-custom datatable-table" id="kt_datatable"
            style="display: block;">
            <thead class="datatable-head">
                <tr class="datatable-row" style="left: 0px;">
                    <th class="p-0" style=" min-width: 5px;"><span>#</span> </th>
                    <th class="p-0" style=" min-width: 100px;"><span style="font-size:15px;">Especialidad</span> </th>
                    <th class="p-0" style="min-width: 650px;"><span  style="font-size:15px;">Descripcion</span> </th>
                </tr>
            </thead>
            <tbody style="" class="datatable-body">
                    @php
                    $i = 0;
                    @endphp
                    @foreach ($areas as $area)
                <tr data-row="0" class="datatable-row" style="left: 0px;">
                    <td class="datatable-cell datatable-cell-sort"><span>{{ ++$i }}</span></td>
                    <td class="datatable-cell datatable-cell-sort"><span style="width: 100; ">{{ $area->name }}</span> </td>
                    <td class="datatable-cell datatable-cell-sort"><span style="width: 650px;">{{ $area->description }}</span></td>
                    <td>
                            <a href="javascript: void(0)" data-toggle="modal"
                                data-target="#EditModal{{ $area->id }}" class="btn btn-icon btn-light btn-sm mx-3">
                                {{ Metronic::getSVG('media/svg/icons/Communication/Write.svg', 'svg-icon-md svg-icon-primary') }}
                            </a>
                                <!------------------------------------------------ Modal Edit Area ------------------------------------------------>
                                <div class="modal fade" id="EditModal{{ $area->id }}" tabindex="-1"
                                    data-backdrop="static" role="dialog" aria-labelledby="Edit Modal" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">

                                        <div class="modal-content">
                                            <form action="{{ route('areas.update', $area->id) }}" name="area" id="area"
                                                method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="EditModal"> Modificar Especialidad</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="align-items-center mb-12">
                                                        <div class="form-group">
                                                            <label for="usr">Especialidad</label>
                                                            <input class="form-control" type="text" name="name" id="name"
                                                            value="{{ $area->name }}">
                                                        </div>
                                                        <div class="form-floating">
                                                            <label for="floatingTextarea">Descripcion</label>
                                                            <textarea class="form-control"
                                                                placeholder="Breve descripcion ..." name="description"
                                                                id="floatingTextarea">{{ $area->description }}
                                                                    </textarea>
                                                        </div>

                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!--------------------------------------- End Modal------------------------------------------------------------->
                            <a href="javascript: void(0)" class="btn btn-icon btn-light btn-sm"
                                onclick="event.preventDefault();if(confirm('Seguro de eliminar')) document.getElementById('trab{{ $area->id }}').submit()">
                                {{ Metronic::getSVG('media/svg/icons/General/Trash.svg', 'svg-icon-md svg-icon-primary') }}
                            </a>
                            <form style="display: none;" id="trab{{ $area->id }}" method="POST"
                                action="{{ route('areas.destroy', $area->id) }}">
                                {{ method_field('DELETE') }}
                                @csrf
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="datatable-pager datatable-paging-loaded">
            <ul class="datatable-pager-nav my-2 mb-sm-0">
                <li>
                    <a title="First"
                        class="datatable-pager-link datatable-pager-link-first datatable-pager-link-disabled"
                        data-page="1" disabled="disabled">
                        <i class="flaticon2-fast-next"></i>
                    </a>
                </li>
                <li>
                    <a title="Previous"
                        class="datatable-pager-link datatable-pager-link-prev datatable-pager-link-disabled"
                        data-page="1" disabled="disabled">
                        <i class="flaticon2-next"></i>
                    </a>
                </li>
                <li style="display: none;">
                    <input type="text" class="datatable-pager-input form-control" title="Page number">
                </li>
                <li>
                    <a class="datatable-pager-link datatable-pager-link-number datatable-pager-link-active"
                        data-page="1" title="1">1
                    </a>
                </li>
                <li>
                    <a class="datatable-pager-link datatable-pager-link-number" data-page="2" title="2">2</a>
                </li>
                <li>
                    <a class="datatable-pager-link datatable-pager-link-number" data-page="3" title="3">3</a>
                </li>
                <li><a class="datatable-pager-link datatable-pager-link-number" data-page="4" title="4">4</a>
                </li>
                <li><a class="datatable-pager-link datatable-pager-link-number" data-page="5" title="5">5</a></li>
                <li><a title="Next" class="datatable-pager-link datatable-pager-link-next" data-page="2">
                        <i class="flaticon2-back"></i></a>
                </li>
                <li><a title="Last" class="datatable-pager-link datatable-pager-link-last" data-page="15">
                        <i class="flaticon2-fast-back"></i></a>
                </li>
            </ul>
            <div class="datatable-pager-info my-2 mb-sm-0">

                <!--end: Datatable-->
            </div>
        </div>
        <!--end::Card-->


        <!------------------------------------------------ Modal Add Area ------------------------------------------------>
        <div class="modal fade" id="AddModal" tabindex="-1" data-backdrop="static" role="dialog"
            aria-labelledby="Edit Modal" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">

                <div class="modal-content">
                    <form action="{{ route('areas.store') }}" name="area" id="area" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="modal-header">
                            <h5 class="modal-title" id="EditModal"> Modificar Especialidad</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="align-items-center mb-12">
                                <div class="form-group">
                                    <label for="usr">Especialidad</label>
                                    <input class="form-control" type="text" name="name" id="name">
                                </div>
                                <div class="form-floating">
                                    <label for="floatingTextarea">Descripcion</label>
                                    <textarea class="form-control" placeholder="Breve descripcion ..."
                                        name="description" id="floatingTextarea">
                            </textarea>
                                </div>

                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Agregar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection

{{-- Scripts Section --}}
@section('scripts')
<!---<script src="{{ asset('js/pages/custom/areas/list-datatable.js') }}" type="text/javascript"></script> 
@endsection