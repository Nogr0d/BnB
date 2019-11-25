<?php /* @var $listing \App\Listing */
?>

<div class="listing-single-row">
    <div class="image">
        <img src="<?=$listing->image->getPublicURL()?>" alt="{{$listing->name}}">
        <div class="price-overlay">
            from {{$listing->price}}&euro; per night
        </div>
    </div>
    <div class="content">
        <div class="title">{{$listing->name}}</div>
        <div class="sections">
        <div class="section">
            <img  class="icon" src="/svg/location.svg" ><span>{{$listing->location->name}}</span>
        </div>
            <div class="section">
                <img  class="icon" src="/svg/user.svg" ><span>Up to {{$listing->guests}} guest(s)</span>
            </div>
            <div class="section">
                <img  class="icon" src="/svg/beds.svg" ><span>{{$listing->bedrooms}} bedroom(s), {{$listing->beds}} bed(s)</span>
            </div>
            <div class="section">
                <img  class="icon" src="/svg/bathrooms.svg" ><span>{{$listing->bathrooms}} bathroom(s)</span>
            </div>
            @if(count($listing->amneties))
            <div class="section">
                <?=implode(" | ", $listing->amneties->pluck('name')->toArray())?>
            </div>
                @endif
        </div>
    </div>
</div>
