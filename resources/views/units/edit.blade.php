@extends('adminlte::page')

@section('title', __('Unidades'))

@section('content')
    <x-adminlte-card theme="primary" theme-mode="outline" title="Editar Categoria" class="card-widget ">
        <form method="POST" action="{{route('units.update', $unity->id)}}">
            @csrf
            @method('PUT')
            <x-adminlte-input name="name" label="Nome" placeholder="Nome" 
                    value="{{ $unity->name }}" 
                    label-class="text-lightblue" 
                    class="col-sm-6">
            </x-adminlte-input>            
            <div class="card-footer">
                <button class="btn btn-primary" type="submit">
                    <i class="fa fa-fw fa-lg fa-check-circle"></i>Atualizar
                </button>
            </div>
        </form>
    </x-adminlte-card>
@endsection



