@extends('layouts.app')
@section('content')
    <div class="reservation-page container">


       @if(!$reservation->hasBegun()) <a href="<?=route("reservations.cancel", ["id"=>$reservation->id])?>"><div id="cancelButton" class="btn btn-danger">Cancel reservation</div></a>
       @endif

           <h1>Booking #<?=$reservation->id?></h1>

        <div class="details">


        </div>

        <div class="payment section">
        <h5>Invoice details</h5>


            @if($reservation->paid)
                <div class="alert-success alert-block p-1">
                    You have sucessfully paid for this booking - it is now considered final. <br/>

                </div>
                <h4 class="my-3">The exact address of the listing is: <b>{{$reservation->listing->address}}</b> </h4>
            @else
                <div class="alert-danger alert-block p-1">
                We're still waiting on your payment.
                </div>
            @endif
            <div class="section-content">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Listing</th>
                    <th scope="col">Check-in</th>
                    <th scope="col">Check-out</th>
                    <th scope="col">Guests</th>

                    <th scope="col">Total price</th>
                    <th scope="col">Status</th>
                </tr>
                </thead>
                <tbody>
                    <tr>

                        <td>{{$reservation->listing->name}}</td>
                        <td><?=date("d.m.Y", strtotime($reservation->start))?></td>
                        <td><?=date("d.m.Y", strtotime($reservation->end))?></td>
                        <td><?=$reservation->guests?></td>
                        <td><?=$reservation->price?></td>
                        <td>@if($reservation->paid) Paid @else  <a href="<?=$paypalLink?>"><button class="btn btn-primary">Pay via PayPal</button></a> @endif</td>

                    </tr>
            </table>

            </div>
        </div>

        <div class="section">
            <h5>Chat with your host</h5>


            @if($reservation->paid)
                <div class="section-content">
                <div class="chat-widget">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-primary">

                                    <div class="panel-collapse" id="">
                                        <div class="panel-body">
                                            <ul class="chat">
                                                @foreach($reservation->messages as $msg)
                                                <li class="<?=$msg->isMine()?"right":"left"?> clearfix"><span class="chat-img pull-<?=$msg->isMine()?"right":"left"?> ml-1">
                            <img src="http://placehold.it/50/<?=$msg->isMine()?"b78a62":"55C1E8"?>/fff&text=<?=$msg->isMine()?"You":"Host"?>" alt="User Avatar" class="img-circle" />
                        </span>
                                                    <div class="chat-body clearfix">
                                                        <div class="header">
                                                            <strong class="primary-font"><?=$msg->user->name?></strong> <small class="pull-right text-muted">
                                                                <span class="glyphicon glyphicon-time"></span><?=$msg->created_at->diffForHumans()?></small>
                                                        </div>
                                                        <p>
                                                            {{$msg->text}}
                                                        </p>
                                                    </div>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="panel-footer">
                                            <form id="chatForm" action="<?=route('reservations.chat', ["id"=>$reservation->id])?>" method="post">
                                                @csrf
                                            <div class="input-group">

                                                <input name="text" id="btn-input" type="text" class="form-control input-sm" placeholder="Type your message here..." />
                                                <span class="input-group-btn">
                            <button type="button" class="btn btn-warning btn-sm" id="btn-chat">
                                Send</button>
                        </span>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                </div>
                </div>
            @else
                <div class="alert-danger alert-block p-1">
                    Chatting will be available once you complete your payment
                </div>
            @endif

        </div>

        <div class="section">
            <h5>Leave a review</h5>
            @if($reservation->isOver())
                @if(!$reservation->review)
            <div class="section-content">
                <form  id="reviewForm" method="post" action="<?=route('reservations.rate', ["id"=>$reservation->id])?>">
                    <div class="form-group rating">
                    <label>
                        <input type="radio" name="stars" value="1" />
                        <span class="icon">★</span>
                    </label>
                    <label>
                        <input type="radio" name="stars" value="2" />
                        <span class="icon">★</span>
                        <span class="icon">★</span>
                    </label>
                    <label>
                        <input type="radio" name="stars" value="3" />
                        <span class="icon">★</span>
                        <span class="icon">★</span>
                        <span class="icon">★</span>
                    </label>
                    <label>
                        <input type="radio" name="stars" value="4" />
                        <span class="icon">★</span>
                        <span class="icon">★</span>
                        <span class="icon">★</span>
                        <span class="icon">★</span>
                    </label>
                    <label>
                        <input type="radio" name="stars" value="5" />
                        <span class="icon">★</span>
                        <span class="icon">★</span>
                        <span class="icon">★</span>
                        <span class="icon">★</span>
                        <span class="icon">★</span>
                    </label>
                    </div>
                    <div class="form-group">
                        <textarea id="reviewText" name="text"  rows="5" class="form-control" placeholder="Describe your stay.."></textarea>
                    </div>
                    <div class="form-group text-right" >
                        <button class="btn btn-primary" type="button" id="reviewButton" >Send review</button>
                    </div>
                    @csrf
                </form>
            </div>
                    @else
                    <div class="alert-success">
                        You have already rated this booking. You gave it <?=$reservation->review->stars?> stars.
                    </div>
                    @endif

                @else
                <div class="alert-danger alert-block">
                    This booking isn't over yet - you'll be able to leave a review once your stay is over.
                </div>
            @endif
        </div>
        <script>
            $("#btn-chat").on("click", function () {
                if($("#btn-input").val().length==0){
                    UI.showToast('Please enter a message.')
                }
                else {
                    $("#chatForm").submit();
                }
            })
            $("#reviewButton").on("click", function () {
                if($("#reviewText").val().length<10){
                UI.showToast('Please describe your stay a bit more.');
            }
                else {
                    $("#reviewForm").submit();
                }
            })
        </script>


    </div>
@endsection