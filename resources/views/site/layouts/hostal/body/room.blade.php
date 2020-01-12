
<div class="room_desc_home">

    <h4>{{$item['name']}} </h4>
    <p>
        {{$item['tipoRoom']}}
    </p>
    <div class="row">
        <!-- start pricing table -->
        <table class="table table-striped">
            <tbody>
            @foreach ($item['precio'] as $ok)
                <tr>
                    <td>{{$ok['temporada']}} (from {{$ok['inicio']}} to {{$ok['fin']}})</td>
                    <td>{{$ok['precio']}}$</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>