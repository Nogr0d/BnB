@extends('layouts.app')

@section('content')
            <div class="s002">
                <form method="GET" action="<?=route('search')?>" id="searchForm">
                    <fieldset>
                        <legend>SEARCH APARTMENT</legend>
                    </fieldset>
                    <div class="inner-form">
                        <div class="input-field fouth-wrap" style="flex-grow:1!important; min-width: 190px!important; max-width: none!important; border-right: 1px solid #ddd!important;">
                            <div class="icon-wrap">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"></path>
                                </svg>
                            </div>


                            <select data-trigger="" name="location" id="location">
                                <option value="0" placeholder="">Choose a location</option>
                                @foreach($locations as $l)
                                    <option value="<?=$l->id?>">{{$l->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="input-field second-wrap">
                            <div class="icon-wrap">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <path d="M17 12h-5v5h5v-5zM16 1v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2h-1V1h-2zm3 18H5V8h14v11z"></path>
                                </svg>
                            </div>
                            <input name="checkin" class="datepicker" id="checkin" type="text" placeholder="Check-in" />
                        </div>
                        <div class="input-field third-wrap">
                            <div class="icon-wrap">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <path d="M17 12h-5v5h5v-5zM16 1v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2h-1V1h-2zm3 18H5V8h14v11z"></path>
                                </svg>
                            </div>
                            <input name="checkout" class="datepicker" id="checkout" type="text" placeholder="Check-out" />
                        </div>
                        <div class="input-field fouth-wrap">
                            <div class="icon-wrap">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"></path>
                                </svg>
                            </div>
                            <select data-trigger="" name="people" id="location">
                                <option value="1" placeholder="">1 Adult</option>
                                @for($i=2; $i<9; $i++)
                                    <option value="<?=$i?>"><?=$i?> Adults</option>
                                    @endfor
                            </select>
                        </div>
                        <div class="input-field fifth-wrap">
                            <button id="searchSubmit" class="btn-search" type="button">SEARCH</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="popular-locations">
                <h2>Popular locations
                </h2>
                <div class="content">
                @for($i=0; $i<3; $i++)
                    @if(isset($locations[$i]))
                        @php $l=$locations[$i] @endphp
                       <a href="/BnB/public/search?location=<?=$l->id?>&people=2"><div style="background:url('{{$l->image}}') no-repeat center; background-size:cover" class="popular-location">
                            <h5>{{$l->name}}</h5>
                        </div>
                       </a>

                        @endif
                    @endfor
                </div>
            </div>


            <script src="/js/extention/choices.js"></script>

            <script>
                const choices = new Choices('[data-trigger]',
                        {
                            searchEnabled: false,
                            itemSelectText: '',
                        });

                $("#searchSubmit").on("click", function () {
                   if($("#location").val()==0) {
                       UI.showToast('Please choose a location.')
                   }
                   else if($("#people").val()==0){
                       UI.showToast('Please choose the number of people.')
                   }
                   else if($("#checkin").val().length!=$("#checkout").val().length){
                       UI.showToast('Please choose both a check in and check out date - or none at all.')
                   }
                   else {
                      $("#searchForm").submit();
                   }
                })

            </script>



@endsection
