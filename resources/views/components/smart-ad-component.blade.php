<div>
    @isset($smartAd)
    <div id="smart-ad" ad-slug="{{$smartAd->slug}}">
        {!! $smartAd->body !!}
    </div>
    @endisset
</div>