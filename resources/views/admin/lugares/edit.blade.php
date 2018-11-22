@extends('layouts.app')
@section('title', 'Editar Lugar')
{{-- CSS ancho del contenedor del formulario --}}
@section('col', '8')
@section('offset', '2')

@section('content')
    {!! Form::open([
        'route'=>['lugares.update', $lugar->id],
        'method'=>'PUT',
        'class'=>'form-horizontal'
    ]) !!}

    <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
        {!! Form::label('name', 'Lugar', ['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-6">
            {!! Form::text('name', $lugar->name, ['class' => 'form-control', 'placeholder'=>'Lugar', 'required']) !!}

            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
        {!! Form::label('ubicacion_id', 'Ubicación', ['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-6">
            {!!
               Form::select('ubicacion_id', $ubicaciones, $lugar->ubicacion_id, ['class' => 'form-control select-ubicacion', 'placeholder' => 'Seleccione la Ubicación', 'required'] );
           !!}

            @if ($errors->has('description'))
                <span class="help-block">
                    <strong>{{ $errors->first('description') }}</strong>
                </span>
            @endif

        </div>
    </div>

    <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
        {!! Form::label('description', 'Descripción', ['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-6">
            {!! Form::textArea('description', $lugar->description, ['class' => 'form-control', 'placeholder'=>'Descripción']) !!}

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