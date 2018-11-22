@extends('layouts.app')
@section('title', 'Editar Telefono: '.$cache->id)
{{-- CSS ancho del contenedor del formulario --}}
@section('col', '8')
@section('offset', '2')

@section('content')
    {!! Form::open([
        'route'=>['telefonos.update', $cache->id],
        'method'=>'PUT',
        'class'=>'form-horizontal'
    ]) !!}

    <div class="form-group {{ $errors->has('visible') ? ' has-error' : '' }}">
        {!! Form::label('visible', 'Visible', ['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-6">
            {!! Form::hidden('visible', $cache->visible, ['class' => 'hidden-check'] ); !!}
            {!! Form::checkbox('check1', '', $cache->visible, ['class' => 'boolean-check'] ); !!}

            @if ($errors->has('visible'))
                <span class="help-block">
                    <strong>{{ $errors->first('visible') }}</strong>
                </span>
            @endif

        </div>
    </div>

    <div class="form-group {{ $errors->has('telefonostipo_id') ? ' has-error' : '' }}">
        {!! Form::label('telefonostipo_id', 'Tipo', ['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-6">
            {!!
               Form::select('telefonostipo_id', $tipos, $cache->telefonostipo_id, ['class' => 'form-control select-area'] );
           !!}

            @if ($errors->has('telefonostipo_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('telefonostipo_id') }}</strong>
                </span>
            @endif

        </div>
    </div>

    <div class="form-group {{ $errors->has('lugar_id') ? ' has-error' : '' }}">
        {!! Form::label('lugar_id', 'Lugar', ['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-6">
            {!!
               Form::select('lugar_id', $lugares, $cache->lugar_id, ['class' => 'form-control select-area', 'placeholder' => 'Seleccione el Lugar'] );
           !!}

            @if ($errors->has('lugar_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('lugar_id') }}</strong>
                </span>
            @endif

        </div>
    </div>

    <div class="form-group {{ $errors->has('persona_id') ? ' has-error' : '' }}">
        {!! Form::label('persona_id', 'Persona', ['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-6">
            {!!
               Form::select('persona_id', $personas, $cache->persona_id, ['class' => 'form-control select-area', 'placeholder' => 'Seleccione la Persona'] );
            !!}

            @if ($errors->has('persona_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('persona_id') }}</strong>
                </span>
            @endif

        </div>
    </div>

    <div class="form-group">
        <div class="col-md-8 col-md-offset-4">
            {!! Form::submit('Enviar',['class' => 'btn btn-primary col-md-3']) !!}
            <a href="{{url()->previous()}}" class="btn btn-default col-sm-offset-1">Cancelar</a>
        </div>
    </div>

    {!! Form::close() !!}
@endsection