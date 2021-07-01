@extends('adminlte::page')

@section('title', __('Categories'))

@section('content_header', 'Categorias')

@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)

@section('content')
    <x-adminlte-card theme="primary" theme-mode="outline" title="Lista de itens cadastrados">
        <x-adminlte-datatable id="table1" :heads="$heads">
            @foreach($categories ?? [] as   $row)
                <tr>
                    <td>{{$row->id}} </td>
                    <td>{{$row->name}} </td>
                    <td><i class="fa {{$row->status?'fa-check-circle':'fa-cogs'}}"></i></td>
                    <td>
                        <nobr>
                            <div class="btn-group btn-group-sm">
                                <a href="{{route('categories.edit',$row->id)}}" class="btn btn-info"><i class="fas fa-edit"></i></a>
                                <button class="btn btn-danger" type="submit" data-id="{{$row->id}}" onclick="deleteTag({{ $row->id }}, this)">
                                     <i class="fa fa-trash"></i>
                                </button>
                                <form id="delete-form-{{ $row->id }}" action="{{ route('categories.destroy',$row->id) }}" method="POST" style="display: none;">
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


@push('js') 
    <script type="text/javascript">
        function deleteTag(id,element) {
                Swal.fire({
                    title: 'Tem certeza que desea remover este item?',
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: `Deletar`,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                    denyButtonText: `Cancelar`,
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (!!result.value) {

                        event.preventDefault();
                        document.getElementById('delete-form-'+id).submit();
                        Swal.fire('Deletado!', '', 'success')
                        
                     } else if (result.isDenied) {
                        Swal.fire('Changes are not saved', '', 'info')
                    }
                })
            // swal({
            //     title: 'Are you sure?',
            //     text: "You won't be able to revert this!",
            //     type: 'warning',
            //     showCancelButton: true, 
            //     confirmButtonText: 'Yes, delete it!',
            //     cancelButtonText: 'No, cancel!',
            //     confirmButtonClass: 'btn btn-success',
            //     cancelButtonClass: 'btn btn-danger',
            //     buttonsStyling: false,
            //     reverseButtons: true
            // }).then((result) => {
            //     if (result.value) {
            //         event.preventDefault();
            //         document.getElementById('delete-form-'+id).submit();
            //     } else if (
            //         // Read more about handling dismissals
            //         result.dismiss === swal.DismissReason.cancel
            //     ) {
            //         swal(
            //             'Cancelled',
            //             'Your data is safe :)',
            //             'error'
            //         )
            //     }
            // })
        }
    </script>
@endpush