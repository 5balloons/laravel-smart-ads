@isset($smartAd)
<div class="smart-banner-temp" banner-slug="{{$smartAd->slug}}">
    @if($smartAd->adType == 'HTML')
        {!! $smartAd->body !!}
    @elseif($smartAd->adType == 'IMAGE')
        <a href="{{($smartAd->imageUrl ? $smartAd->imageUrl : '#')}}" target="_blank">
            <img src="{{asset('storage/'.$smartAd->image)}}" alt="{{$smartAd->imageAlt}}" />
        </a>
    @endif
</div>
@endisset
