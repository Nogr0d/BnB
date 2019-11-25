@extends('layouts.app')
@section('content')
    <div class="container"><h1 class="page-title">My listings</h1></div>
<div class="container pt-4">
    @forelse($listings as $listing)
        <a href="<?=route("listing.details", ["id"=>$listing->id])?>">
        @include("listing-single")
        </a>
            @empty
            <div class="no-results">
                You have no listings so far. <a href="<?=route('listing.create')?>"><b>Add a listing</b></a>
            </div>
        @endforelse


</div>
@endsection