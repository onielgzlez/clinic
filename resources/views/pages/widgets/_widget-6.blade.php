{{-- Advance Table Widget 2 --}}

<div class="card card-custom {{ @$class }}">
    {{-- Header --}}
    <div class="card-header border-0 pt-5">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label font-weight-bolder text-dark">{{ __('locale.New patients') }}</span>
        </h3>
    </div>

    {{-- Body --}}
    <div class="card-body pt-3 pb-0">
        {{-- Table --}}
        <div class="table-responsive">
            <table class="table table-borderless table-vertical-center">
                <thead>
                    <tr>
                        <th class="p-0" style="width: 50px"></th>
                        <th class="p-0" style="min-width: 200px"></th>
                        <th class="p-0" style="min-width: 100px"></th>
                        <th class="p-0" style="min-width: 125px"></th>
                        <th class="p-0" style="min-width: 110px"></th>
                        <th class="p-0" style="min-width: 150px"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($patients as $patient)
                    <tr>
                        <td class="pl-0 py-4">
                            <div class="symbol symbol-50 symbol-light mr-1">
                                <span class="symbol-label">
                                    <img src="{{ asset($patient->avatar) }}" class="h-50 align-self-center"/>
                                </span>
                            </div>
                        </td>
                        <td class="pl-0">
                            <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{ $patient->fullName }}</a>
                            <div>
                                <span class="font-weight-bolder">{{ __('locale.fields.email') }}:</span>
                                <a class="text-muted font-weight-bold text-hover-primary" href="#">{{ $patient->email }}</a>
                            </div>
                        </td>
                        <td class="text-right">
                            <span class="text-dark-75 font-weight-bolder d-block font-size-lg">
                                {{ $patient->phone }}
                            </span>                            
                        </td>
                        <td class="text-right">
                            <span class="text-muted font-weight-500">
                                {{ $patient->birthdate }}
                            </span>
                        </td>
                        <td class="text-right">
                            {{ $patient->city->name }}
                        </td>
                        <td class="text-right pr-0">
                            <a href="#" class="btn btn-icon btn-light btn-sm">
                                {{ Metronic::getSVG("media/svg/icons/General/Settings-1.svg", "svg-icon-md svg-icon-primary") }}
                            </a>
                            <a href="{{ route('patients.edit',['id'=>$patient->id]) }}" class="btn btn-icon btn-light btn-sm mx-3">
                                {{ Metronic::getSVG("media/svg/icons/Communication/Write.svg", "svg-icon-md svg-icon-primary") }}
                            </a>
                            <a href="#" class="btn btn-icon btn-light btn-sm">
                                {{ Metronic::getSVG("media/svg/icons/General/Trash.svg", "svg-icon-md svg-icon-primary") }}
                            </a>
                        </td>
                    </tr>
                    @empty
                        {{ __('locale.No Data') }}
                    @endforelse          
                    
                </tbody>
            </table>
        </div>
    </div>
</div>
