@extends('layouts.app')
@section('content')

    <div class="listing-page px-5">
        <div class="row pt-5">
            <div class="col-md-8">
        @include('listing-single')
        <blockquote><p>{{$listing->description}}</p></blockquote>


            <div class="gallery-section">
                        <div class="gallery-item" data-caption="{{$listing->image->title}}" data-src="<?=$listing->image->getPublicURL()?>"></div>
                    @foreach($listing->images as $image)
                        <div class="gallery-item" data-caption="{{$image->title}}" data-src="<?=$image->getPublicURL()?>">
                        </div>
                    @endforeach
                </div>



            <script>
                var lightbox = $('.gallery-item').simpleLightbox({sourceAttr:'data-src', captionsData:'data-caption'});
                $(".listing-single-row .image").on("click", function () {
                    $(".gallery-item").eq(0).trigger('click')
                })
            </script>
            <div class="reviews-section">
                <h5>What others say</h5>
                @forelse($listing->reviews as $review)
                    <div class="review-item">
                        <div class="date">{{$review->created_at->format("d.m.Y")}}</div>
                        <h5><?=$review->reservation->user->name?></h5>
                        <b>Rating: @for($i=1; $i<=5; $i++) <span class="<?=$i<=$review->stars?"active":""?>">★</span> @endfor</b><br>
                        <hr>
                        {{$review->text}}
                    </div>
                   @empty
                    <div class="text-center p-2">
                        There have been no reviews for this listing so far.
                    </div>
                    @endforelse
            </div>
            </div>
            <div class="col-md-4">

            <script type="text/javascript" src="/js/moment.min.js"></script>

            <script type="text/javascript" src="/js/daterangepicker.js"></script>

            <link rel="stylesheet" type="text/css" href="/js/daterangepicker.css" />
            <div class="listing-section booking-section">
                <h5>Book now</h5>
                @if($listing->isMine())
                    <div class="alert-danger text-center p-2">
                        This is your own listing. You cannot make reservations for this one :)
                    </div>
                @else
                <div class="section-content">
                    <form method="post" action="">
                        <div class="form-group">
                        <input class="form-control" type="text" name="datefilter" value="" />

                        <script type="text/javascript">
                            $(function() {
                                var reservations=<?=$reservations->toJSON()?>;

                                $('input[name="datefilter"]').daterangepicker({

                                    locale: {
                                        cancelLabel: 'Clear'
                                    },
                                    isInvalidDate:function (date) {


                                        var result=true;
                                        for(var i=0; i<reservations.length; i++){
                                            var start=moment(reservations[i].start);
                                            var end=moment(reservations[i].end);
                                            console.log("pregledivam", date.format("Y-MM-DD"), start.format("Y-MM-DD"), end.format("Y-MM-DD"), reservations[i].start, reservations[i].end)
                                            if(start.isSameOrBefore(date)&&end.isSameOrAfter(date)) result=false;

                                        }
                                        return !result;
                                    }
                                });



                            });
                        </script>
                        </div>
                        <div class="form-group">
                            <label>Number of people</label>
                            <input autocomplete="off" name="guests" type="number" min="1" max="<?=$listing->guests?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>A message for the homeowner</label>
                            <textarea name="message" class="form-control"></textarea>
                        </div>
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-primary">Book now!</button>
                        </div>
                        @csrf
                    </form>
                </div>
                    @endif
            </div>

    </div>
        </div>
    </div>



@endsection
