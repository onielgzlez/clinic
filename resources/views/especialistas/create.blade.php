{{-- Extends layout --}}
@extends('dashboard')

{{-- Content --}}
@section('content')

<div class="card card-custom {{ @$class }}">
    {{-- Header --}}    
    <div class="card-header border-0 pt-5">
        <h3 class="card-title font-weight-bolder text-dark">FORMULARIO DE REGISTRO DE ESPECIALISTAS</h3>
      
    </div>

    {{-- Body --}}
    <div class="card-body max-width:800px">
        {{-- Item --}}
            <div class="form-row">              
              <div class="form-group col-md-7">
                <label for="inputState">ESPECIALISTAS</label>
                <select id="inputState" class="form-control">
                  <option selected>Seleccione...</option>  
                  
                  @foreach ($users as $user)
                      <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->second_name }} {{ $user->last_name }} {{ $user->last_name2 }}</option>
                    @endforeach
                </select>
               
                <div class="form-group col-md-5">
                    <label for="inputState">AREA</label>
                    <select id="inputState" class="form-control">
                      <option selected>Seleccione...</option>
                      @inject('areas', 'App\Http\Controllers\AreaJobController')
                                            @foreach ($areas->getLevels() as $area)
                                                <option value="{{ $area->id }}">{{ $area->name }}</option>
                                            @endforeach
                    </select>
                </div>
              </div>
            </div>
            <button type="submit" class="btn btn-primary">Registrar</button>
          </form>        
        </div>
</div>
@endsection
{{-- Scripts Section --}}
@section('scripts')
    <script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>
@endsection
