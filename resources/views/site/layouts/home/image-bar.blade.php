@foreach($data['mainImages'] as $item)

    <li data-transition="random" data-slotamount="7" data-masterspeed="1000">
        <img src={{$item['url']}} alt="slide" >
    </li>
@endforeach
