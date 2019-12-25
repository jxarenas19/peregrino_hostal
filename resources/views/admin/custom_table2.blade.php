<script src="{{ cbAsset('js/jquery/dist/jquery.min.js') }}"></script>

<div class="box box-default">
    <button type="button" class="btn btn-default" onclick="addRow()">Add</button>
    <div class="box-body">
        <table id="myTable" class="table table-striped table-boredered">
            <thead>
            <tr>
                <th>Keys</th>
                @foreach($locales as $item)
                    <th>{{$item->name}}</th>
                @endforeach
            </tr>
            </thead>
            <tbody id="body-table">
            @foreach($data as $item)
                <tr>
                    @foreach($item as $jj)
                        @if ($loop->index!=0)
                            <td data-key={{$item[0]}} data-locale={{$locales[$loop->index-1]->code}} onblur="saveValue(this)" class="field-editable" contenteditable >{{$jj}}</td>
                        @else
                            <td>{{$jj}}</td>

                        @endif
                    @endforeach
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    var save_value = {};
    function saveValue(item) {
        var dataBase = JSON.parse($('#json')[0].value);
        var locale = item.getAttribute('data-locale');
        var key= item.getAttribute('data-key');
        if (dataBase.hasOwnProperty(locale)) {
            dataBase[locale][key] = item.textContent;
        }
        else{
            dataBase[locale] = {};
            dataBase[locale][key] = item.textContent;
        }

        $('#json')[0].value = (JSON.stringify(dataBase));
    }
    function updateKey(item) {
        var dataBase = JSON.parse($('#json')[0].value);
        $.each(item.parentElement.cells,function (index,cell) {
            if (index!=0){
                cell.setAttribute('data-key',item.textContent);
                var locale = cell.getAttribute('data-locale');
                delete dataBase[locale]['key'];
            }

        });
        $('#json')[0].value = (JSON.stringify(dataBase));
    }
    function addRow() {
        var cantRow = @json($locales);
        var cols = "";
        var newRow = $("<tr>");
        var dataBase = JSON.parse($('#json')[0].value);
        cols += '<td class="field-editable" onblur="updateKey(this)" contenteditable >key</td>';
        for (var i = 0; i <= cantRow.length-1; i++) {
            cols += '<td data-key="key" data-locale='+cantRow[i].code+' onblur="saveValue(this)" class="field-editable" contenteditable ></td>';
            var dictTemp = dataBase[cantRow[i].code]["key"] = cantRow[i].code;

        }
        newRow.append(cols);
        $("#myTable").append(newRow);
        $('#json')[0].value = (JSON.stringify(dataBase));
    }

</script>