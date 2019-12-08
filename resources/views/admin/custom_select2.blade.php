<script src="{{ cbAsset('js/jquery/dist/jquery.min.js') }}"></script>

<select name={{$name}} id="mySelect2" class="form-control select2" multiple="multiple">
    @foreach ($values as $key=> $item)
        @if ($item['selected'] == true)
                <option selected={{$item['selected']}} value={{$item['value']}}>{{$item['name']}}</option>
        @else
            <option value={{$item['value']}}>{{$item['name']}}</option>
        @endif
    @endforeach
</select>

<script>
        $( document ).ready(function() {
                var option  =<?php echo json_encode($GLOBALS); ?>;
                if(option== "edit")  {
                        alert('entro');
                }

        });
</script>