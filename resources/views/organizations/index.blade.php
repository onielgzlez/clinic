@extends('dashboard')

{{-- Content --}}
@section('content')

<div class="row">
    <div class="col-xl-12">
        <!--begin::Advance Table Widget 6-->
        <div class="card card-custom gutter-b card-stretch">
            <!--begin::Header-->
            <div class="card-header border-0 py-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label font-weight-bolder text-dark">Clinicas Estomatologicas</span>
                    <span class="text-muted mt-3 font-weight-bold font-size-sm">More than 400+ new members</span>
                </h3>
                <div class="card-toolbar">
                    <a href="{{ route('organizations.create') }}" class="btn btn-success font-weight-bolder font-size-sm">
                    <span class="svg-icon svg-icon-md svg-icon-white">
                        <!--begin::Svg Icon | path:/metronic/theme/html/demo8/dist/assets/media/svg/icons/Communication/Add-user.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                <path d="M18,8 L16,8 C15.4477153,8 15,7.55228475 15,7 C15,6.44771525 15.4477153,6 16,6 L18,6 L18,4 C18,3.44771525 18.4477153,3 19,3 C19.5522847,3 20,3.44771525 20,4 L20,6 L22,6 C22.5522847,6 23,6.44771525 23,7 C23,7.55228475 22.5522847,8 22,8 L20,8 L20,10 C20,10.5522847 19.5522847,11 19,11 C18.4477153,11 18,10.5522847 18,10 L18,8 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                <path d="M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero"></path>
                            </g>
                        </svg>
                        <!--end::Svg Icon-->
                    </span>Agregar Clinica</a>
                </div>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body py-0">
                <!--begin::Table-->                
                <div class="table-responsive">
                    <table class="table table-head-custom table-vertical-center" id="kt_advance_table_widget_3">
                        <thead>
                            <tr class="text-left text-uppercase">
                                <th class="pl-0" style="width: 20px">
                                    <label class="checkbox checkbox-lg checkbox-inline mr-2">
                                        <input type="checkbox" value="1">
                                        <span></span>
                                    </label>
                                </th>
                                <th class="px-0" style="width: 50px"></th>
                                <th style="min-width: 120px"></th>
                                <th style="min-width: 120px">Ciudad</th>
                                <th class="text-info" style="min-width: 150px">Modulos</th>
                                <th style="min-width: 150px">status</th>
                                <th class="pr-0" style="min-width: 160px"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($org as $rg)                                
                            <tr>
                                <td class="pl-0 py-7">
                                    <label class="checkbox checkbox-lg checkbox-inline">
                                        <input type="checkbox" @if($rg->status == 1) checked @endif value="2">
                                        <span></span>
                                    </label>
                                </td>
                                <td class="pl-0">
                                    <div class="symbol symbol-50 symbol-light mt-1">
                                        <span class="symbol-label">
                                            <img src="{{$rg->photo}}" class="h-75 align-self-end" alt="">
                                        </span>
                                    </div>
                                </td>
                                <td class="pl-0">
                                    <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">Clinica Estomatologica</a>
                                    <span class="text-muted font-weight-bold text-muted d-block">{{$rg->name}}</span>
                                </td>
                                <td>   
                                    <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$rg->city->country->name }}</span> 
                                    <span class="text-muted font-weight-bold">{{$rg->city->name}}</span>
                                </td>
                                <td>
                                    <span class="text-dark-75 font-weight-bolder d-block font-size-lg">Intertico</span>
                                    <span class="text-muted font-weight-bold">Web, UI/UX Design</span>
                                </td>
                                <td>
                                    @foreach (['1'=>'Activo','2'=>'Pendiente','3'=>'Suspenso'] as $key=>$status)
                                            @if($rg->status == $key) 
                                    <span style="width: 108px;"><span class="label font-weight-bold label-lg  label-light-success label-inline">{{$status}}</span></span>
                                     
                                            @endif
                                            @endforeach
                                            <!--end::Svg Icon-->
                                    
                                </td>
                                <td class="text-right pr-0">                                    
                                    <a href="{{ route('organizations.edit',$rg->id) }}" class="btn btn-icon btn-light btn-sm mx-3">
                                    {{ Metronic::getSVG('media/svg/icons/Communication/Write.svg', 'svg-icon-md svg-icon-primary') }}
                                </a>
                                    <a href="javascript: void(0)" class="btn btn-icon btn-light btn-sm"
                                    onclick="event.preventDefault();if(confirm('Seguro de eliminar')) document.getElementById('trab{{ $rg->id }}').submit()">
                                    {{ Metronic::getSVG('media/svg/icons/General/Trash.svg', 'svg-icon-md svg-icon-primary') }}
                                </a>
                                <form style="display: none;" id="trab{{ $rg->id }}" method="post"
                                    action="{{ route('organizations.destroy', $rg->id) }}">
                                    {{ method_field('DELETE') }}
                                    @csrf
                                </form>
                                </td>
                            </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>               
                <!--end::Table-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Advance Table Widget 6-->
    </div>
</div>




@endsection

{{-- Scripts Section --}}
@section('scripts')
    <!---<script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>----->
    <script src="{{ asset('js/pages/custom/areas/areas-table.js') }}" type="text/javascript"></script>
    <script type="text/javascript" id="">!function(b,e,f,g,a,c,d){b.fbq||(a=b.fbq=function(){a.callMethod?a.callMethod.apply(a,arguments):a.queue.push(arguments)},b._fbq||(b._fbq=a),a.push=a,a.loaded=!0,a.version="2.0",a.queue=[],c=e.createElement(f),c.async=!0,c.src=g,d=e.getElementsByTagName(f)[0],d.parentNode.insertBefore(c,d))}(window,document,"script","https://connect.facebook.net/en_US/fbevents.js");fbq("init","738802870177541");fbq("track","PageView");</script>
<noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=738802870177541&amp;ev=PageView&amp;noscript=1"></noscript>
<script type="text/javascript" id="">try{(function(){var a=google_tag_manager["GTM-5FS8GGP"].macro(8);a="undefined"==typeof a?google_tag_manager["GTM-5FS8GGP"].macro(9):a;var b=new Date;b.setTime(b.getTime()+18E5);var c="gtm-session-start";b=b.toGMTString();var d="/",e=".keenthemes.com";document.cookie=c+"\x3d"+a+"; Expires\x3d"+b+"; domain\x3d"+e+"; Path\x3d"+d})()}catch(a){};</script><script type="text/javascript" id="">(function(){var a=google_tag_manager["GTM-5FS8GGP"].macro(10)-0+1,b=".keenthemes.com";document.cookie="damlPageCount\x3d"+a+";domain\x3d"+b+";path\x3d/;"})();</script>
		<!--end::Main-->
@endsection

