@extends('layouts.app')
@section('title', 'Editar Area')
{{-- CSS ancho del contenedor del formulario --}}
@section('col', '8')
@section('offset', '2')

@section('content')
    {!! Form::open([
        'route'=>['ubicaciones.update', $ubicacion->id],
        'method'=>'PUT',
        'class'=>'form-horizontal'
    ]) !!}

    <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
        {!! Form::label('name', 'Ubicación', ['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-6">
            {!! Form::text('name', $ubicacion->name, ['class' => 'form-control', 'placeholder'=>'Ubicación', 'required']) !!}

            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group {{ $errors->has('ini_range') ? ' has-error' : '' }}">
        {!! Form::label('ini_range', 'Rango inicial', ['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-6">
            {!! Form::text('ini_range', $ubicacion->ini_range, ['class' => 'form-control', 'placeholder'=>'Rango inicial']) !!}

            @if ($errors->has('ini_range'))
                <span class="help-block">
                    <strong>{{ $errors->first('ini_range') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group {{ $errors->has('end_range') ? ' has-error' : '' }}">
        {!! Form::label('end_range', 'Rango final', ['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-6">
            {!! Form::text('end_range', $ubicacion->end_range, ['class' => 'form-control', 'placeholder'=>'Rango final']) !!}

            @if ($errors->has('end_range'))
                <span class="help-block">
                    <strong>{{ $errors->first('end_range') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
        {!! Form::label('description', 'Descripción', ['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-6">
            {!! Form::textArea('description', $ubicacion->description, ['class' => 'form-control', 'placeholder'=>'Descripción']) !!}

            @if ($errors->has('description'))
                <span class="help-block">
                    <strong>{{ $errors->first('description') }}</strong>
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