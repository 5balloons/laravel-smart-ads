@isset($smartAd)
<div class="smart-ad-temp" ad-slug="{{$smartAd->slug}}">
    {!! $smartAd->body !!}
</div>
@endisset
