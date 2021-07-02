<?php
	
	
function select2 ($items, $name, $label='', $fgroupClass =''){
	echo '
        <x-adminlte-select2 name="'.$name.'" label="'.$label.'" label-class="text-lightblue" fgroup-class="col-12 '.$fgroupClass.'">
            <option/>
            @foreach($items??[] as $item)
                <option value="{{$item->id}}">{{$item->name}}</option>
            @endforeach
        </x-adminlte-select2>
	';
}