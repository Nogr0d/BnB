@extends('layouts.app')

@section('content')
    <div class="search-page">
    <div class="container">
        <h1 class="page-title">Search results</h1>
    </div>
    <div class="container pt-4">
        @forelse($listings as $listing)
            <a href="<?=route("listing.show", ["id"=>$listing->id])?>">
                @include("listing-single")

            </a>
        @empty
            Unfortunately we couldn't find any listings for your search.
            @endforelse
    </div>
    </div>
@endsection