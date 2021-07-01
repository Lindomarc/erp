@extends('adminlte::page')

@section('title', 'Unidades')

@section('content')
    <x-adminlte-card theme="primary" theme-mode="outline" title="Adicionar Unidade" class="card-widget ">
        <form method="POST" action="{{route('categories.store')}}">
            @csrf
            <x-adminlte-input name="name" label="Nome" placeholder=""
                    label-class="text-lightblue"
                    class="col-sm-6">
            </x-adminlte-input>
            <div class="card-footer">
                <button class="btn btn-primary" type="submit">
                    <i class="fa fa-fw fa-lg fa-check-circle"></i>Salvar
                </button>
            </div>
        </form>
    </x-adminlte-card>
@endsection



