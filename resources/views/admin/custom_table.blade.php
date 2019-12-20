<script src="{{ cbAsset('js/jquery/dist/jquery.min.js') }}"></script>

<div class="box box-default">
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
                    <td onblur="saveValue(this)" class="field-editable" id-item={{$item["id"]}} contenteditable >{{$prices[$item["id"]]}}</td>
                @else
                    <td onblur="saveValue(this)" class="field-editable" id-item={{$item["id"]}} contenteditable >0</td>
                @endif

            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    $(".field-editable").keypress(function(e) {
        // Aqui lo que hago es no permitir q se introduzca ningun caracter q no sea numero
        if (isNaN(String.fromCharCode(e.which))) e.preventDefault();
    });
    var save_value = {};
    function saveValue(item) {

        save_value[item.getAttribute("id-item")] = item.textContent;
        $('input[name ="precios-at"]')[0].value = (JSON.stringify(save_value));

    }

</script>