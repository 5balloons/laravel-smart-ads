@isset($smartAd)
<div class="smart-banner-temp" banner-slug="{{$smartAd->slug}}">
    {!! $smartAd->body !!}
</div>
@endisset
