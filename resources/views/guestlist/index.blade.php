@extends('layouts.app')
@section('content')
<div class="container">
    <h1 class="page-title">My reservations</h1>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">Booking ID</th>
            <th scope="col">Listing</th>
            <th scope="col">Guest name</th>
            <th scope="col">Check-in</th>
            <th scope="col">Check-out</th>
            <th scope="col">Guests</th>
            <th scope="col">Details</th>
        </tr>
        </thead>
        <tbody>

    @forelse($reservations as $r)
      <tr>
            <th scope="row"><?=$r->id?></th>
            <td>{{$r->listing->name}}</td>
            <td>{{$r->user->name}}</td>
            <td><?=date("d.m.Y", strtotime($r->start))?></td>
            <td><?=date("d.m.Y", strtotime($r->end))?></td>
            <td><?=$r->guests?></td>

          <td>  <a href="<?=route("guestlist.show", ["id"=>$r->id])?>">Details</a></td>
        </tr>
@empty
        <tr><td>You have no confirmed guests so far :(</td></tr>
    @endforelse

    </tbody>
    </table>
</div>
    @endsection