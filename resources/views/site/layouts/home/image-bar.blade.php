@foreach($data['mainImages'] as $item)

    <li data-transition="random" data-slotamount="7" data-masterspeed="1000">
        <img src={{$item['url']}} alt="slide" >
        <div class="tp-caption large_black sfr" data-x="105" data-y="197" data-speed="1200" data-start="1100" data-easing="easeInOutBack"
             style="font-family: 'Playfair Display', serif; font-size: 48px;color: #fffefa; margin-bottom: 23px; text-transform: uppercase; line-height: 40px;">
            A brand New Hotel
        </div>
        <div class="tp-caption large_black sfr" data-x="105" data-y="255" data-speed="1500" data-start="1400" data-easing="easeInOutBack"
             style="font-family: 'Playfair Display', serif; font-size: 48px;color: #131e2a; margin-bottom: 23px; text-transform: uppercase; line-height: 40px;">
            Beyond Ordinary
        </div>
        <div class="tp-caption lfb carousel-caption-inner" data-x="105" data-y="313" data-speed="1300" data-start="1700" data-easing="easeInOutBack"
             style="background: #f7c411; padding: 10px; cursor: pointer;">
            <a href="#" class="" style="background: #f7c411; border-radius: 0; color: #313a45; display: inline-block;  font-size: 18px; padding: 8px 34px; text-transform: uppercase; border: 1px solid #9e811a;">Explore IT</a>
        </div>
    </li>
@endforeach
