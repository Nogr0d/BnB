@extends('layouts.app')
@section('content')
    <div class="reservation-page container">
        <h1>Booking #<?=$reservation->id?></h1>
        <h2>Guest name: <b>{{$reservation->user->name}}</b></h2>
        <div class="details">


        </div>
        <div class="payment section">
        <h5>Invoice details</h5>
            <div class="section-content">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Listing</th>
                    <th scope="col">Check-in</th>
                    <th scope="col">Check-out</th>
                    <th scope="col">Guests</th>
                    <th scope="col">
                        Price per night</th>
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
                        <td>@if($reservation->paid) Paid @else  <a href="<?=$reservation->getPaymentLink()?>"><button class="btn btn-primary">Pay via PayPal</button></a> @endif</td>

                    </tr>
            </table>

            </div>
        </div>
        @if($reservation->deleted_at)
            <div class="alert alert-danger">
                THIS RESERVATION WAS CANCELED AT {{$reservation->deleted_at->format("d.m.Y H:i")}}
            </div>
            @else
        <div class="section">
            <h5>Chat with your guest</h5>


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
                            <img src="http://placehold.it/50/<?=$msg->isMine()?"b78a62":"55C1E8"?>/fff&text=<?=$msg->isMine()?"You":"Guest"?>" alt="User Avatar" class="img-circle" />
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
            <h5>Guests review</h5>
            @if($reservation->isOver())
            <div class="section-content">
            @if($reservation->review)

                        <div class="form-group rating">

                            <label>
                                <span class="icon">★</span>
                                <span class="icon">★</span>
                                <span class="icon">★</span>
                                <span class="icon">★</span>
                                <span class="icon">★</span>
                            </label>
                            <label>
                                <input type="radio" name="stars" checked value="<?=$reservation->review->stars?>" />
                               @for($i=0; $i<$reservation->review->stars; $i++)
                                    <span class="icon">★</span>

                                @endfor
                            </label>
                        </div>
                        <div class="form-group">
                            <textarea id="reviewText" readonly="" name="text"  rows="5" class="form-control" >{{$reservation->review->text}}</textarea>
                        </div>

                    </form>
                @else
                    <div class="alert-danger alert-block">
                        Your guest has not written a review yet.
                    </div>
                @endif
            </div>
                @else
                <div class="alert-danger alert-block">
                    This booking isn't over yet - Your guest will be able to leave a review once his/hers stay is over.
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
        </script>
            @endif
    </div>

@endsection