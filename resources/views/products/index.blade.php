@extends('adminlte::page')

@section('title', 'Produtos')

@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)

@section('content')
    <x-adminlte-card theme="primary" theme-mode="outline" title="Lista de itens cadastrados">
        <x-adminlte-datatable id="table1" :heads="$heads" :config="$config">
            @foreach($products ?? [] as   $row)
                <tr>
                    <td>{{$row->id}} </td>
                    <td>{{$row->name}} </td>
                    <td><i class="fa {{$row->status?'fa-check-circle':''}}"></i></td>
                    <td>
                        <nobr>
                            <div class="btn-group btn-group-sm">
                                <a href="{{route('products.edit',$row->id)}}" class="btn btn-info"><i class="fas fa-edit"></i></a>
                                <button class="btn btn-danger" type="submit" data-id="{{$row->id}}" onclick="deleteTag({{ $row->id }}, this)">
                                    <i class="fa fa-trash"></i>
                                </button>
                                <form id="delete-form-{{ $row->id }}" action="{{ route('products.destroy',['product'=> $row->id]) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </nobr>
                    </td>
                </tr>
            @endforeach
        </x-adminlte-datatable>
    </x-adminlte-card>
@endsection
