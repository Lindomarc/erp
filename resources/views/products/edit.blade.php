@extends('adminlte::page')

@section('title', 'Categorias')

@section('plugins.Select2',true)

@section('plugins.BootstrapSelect',true)

@section('plugins.BootstrapSwitch',true)

@section('plugins.BsCustomFileInput',true)

@section('content')

    <x-adminlte-card theme="primary" theme-mode="outline" title="Editar Produto" class="card-widget ">
        <form method="post" action="{{route('products.update',$product->id)}}" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="row">
                <div class="col-12 col-sm-4">
                    <img src="{{asset('storage/uploads/img/empty.png')}}" class="img-fluid product-image" alt="Imagem">
                </div>
                <div class="col-12 col-sm-8">
                    <div class="row">

                        {{-- Product Name --}}
                        <x-adminlte-input value="{{old('name',$product->name)}}" name="name" label="* Nome" placeholder="Nome do Produto" label-class="text-lightblue" fgroup-class="col-12"/>

                        {{-- Product Code --}}
                        <x-adminlte-input value="{{old('product_code',$product->product_code)}}" name="product_code" label="Código" label-class="text-lightblue" placeholder="Código do Produto" label-class="text-lightblue" fgroup-class="col-12 col-sm-4"/>

                        {{-- Units --}}
                        <x-adminlte-select2 name="unit_id" label="* Unidades" label-class="text-lightblue" fgroup-class="col-12 col-sm-4">
                            <option/>
                            @foreach($units??[] as $unit)
                                <option value="$unit->id" {{old('unit_id',$unit->id) == $unit->id?'selected':''}}>{{$unit->name}}</option>
                            @endforeach
                        </x-adminlte-select2>

                        {{-- Category --}}
                        <x-adminlte-select2 name="category_id" label="* Categorias" label-class="text-lightblue" fgroup-class="col-12 col-sm-4">
                            <option/>
                            @foreach($categories??[] as $category)
                                <option value="{{$category->id}}" {{old('category',$unit->id) == $category->id?'selected':''}}>{{$category->name}}</option>
                            @endforeach
                        </x-adminlte-select2>

                        {{-- Product Price --}}
                        <x-adminlte-input value="{{old('price_buy',$product->price_buy)}}" name="price_buy" label="Preço de Compra" label-class="text-lightblue" placeholder="Preço de compra" label-class="text-lightblue" class="currency" fgroup-class="col-12 col-sm-3"/>

                        {{-- Product Price Sale --}}
                        <x-adminlte-input value="{{old('price_sale',$product->price_sale)}}" name="price_sale" label="Preço de Venda" label-class="text-lightblue" placeholder="Preço de venda" label-class="text-lightblue" class="currency" fgroup-class="col-12 col-sm-3"/>

                        {{-- Upload Image --}}
                        <x-adminlte-input-file name="image" label="Imagem" label-class="text-lightblue" placeholder="Escolha a imagem do produto..." fgroup-class="col-12  col-md-6" accept="image/*" disable-feedback/>
                        {{-- Status --}}
                        @php
                        $checked = 'checked';
                        @endphp
                        <x-adminlte-input-switch value  name="status" label="Ativo" label-class="text-lightblue" data-on-text="Sim" data-off-text="Não" data-on-color="teal" fgroup-class="col-2" checked/>
                        <x-adminlte-input-switch value="{{ old('is_product',$product->is_product)??0 }}" name="is_product" label="Produto" label-class="text-lightblue" data-on-text="Sim" data-off-text="Não" data-on-color="teal" fgroup-class="col-2" checked/>
                        <x-adminlte-input-switch name="is_material" label="Insumo" label-class="text-lightblue" data-on-text="Sim" data-off-text="Não" data-on-color="teal" fgroup-class="col-2" checked/>


                    </div>
                </div>
            </div>

            <div class="card-footer align-self-end">
                <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Salvar
                </button>
            </div>

        </form>
    </x-adminlte-card>

@endsection 