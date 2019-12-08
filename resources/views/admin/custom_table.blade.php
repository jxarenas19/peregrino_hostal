<script src="{{ cbAsset('js/jquery/dist/jquery.min.js') }}"></script>

<div class="box box-default">
    <input id="dict_values" type="hidden" name="precios-at" value={} class="form-control" readonly >
    <div class="box-body">
        <table class="table table-striped table-boredered">
            <thead>
            <tr>
                <th>Temporada</th>
                <th>Precio</th>
            </tr>
            </thead>
            <tbody>
            @foreach($rows as $item)
            <tr>
                <td >{{$item["name-visual"]}}</td>
                @if (collect($prices)->has($item["id"]))
                    <td onblur="saveValue(this)" id-item={{$item["id"]}} contenteditable >{{$prices[$item["id"]]}}</td>
                @else
                    <td onblur="saveValue(this)" id-item={{$item["id"]}} contenteditable >0</td>
                @endif

            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    var save_value = {};
    function saveValue(item) {
        save_value[item.getAttribute("id-item")] = item.textContent;
        $("#dict_values").val(JSON.stringify(save_value));
    }

</script>