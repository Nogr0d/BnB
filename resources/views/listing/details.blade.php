@extends('layouts.app')
@section('meta')
@endsection
@section('content')
    <div class="container">




        <h1 class="page-title">My listing "{{$listing->name}}"   <a style="float:right" class="ml-2 mb-1 btn btn-primary" href="<?=route('listing.edit', ["id"=>$listing->id])?>">Edit</a></h1>



        <div class="alert alert-<?=$listing->visible?"success":"danger"?>">
            This listing is currently <b><?=$listing->visible?"visible":"hidden"?></b>. <a  href="<?=route('listing.toggle', ["id"=>$listing->id])?>">Click to toggle.</a>
        </div>
        <div class="row justify-content-center">


            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" data-toggle="collapse" data-target="#gallery" aria-expanded="false" aria-controls="galleryExample"><h3>Image gallery</h3></div>
                    <div class="card-body collapse" id="gallery">
                        <div class="card-table">
                            <div class="row header">
                                <div class="col-4">Image title</div>
                                <div class="col-5">Preview</div>
                                <div class="col-3">Controls</div>
                            </div>
                            @foreach($listing->images as $image)
                                <div class="row">
                                    <div class="col-4">{{$image->title}}</div>
                                    <div class="col-5"><img src="<?=$image->getPublicURL()?>" /></div>
                                    <div class="col-3">     <button class="btn btn-primary" data-href="<?=route('image.delete', ["id"=>$image->id])?>" data-toggle="modal" data-target="#confirm-delete">
                                            Delete
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                            <div class="text-right mt-2">
                                <button class="btn btn-primary" data-toggle="modal" data-target="#imageModal">Add image</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-12 mt-5">
                <div class="card">
                    <div class="card-header" data-toggle="collapse" data-target="#prices" aria-expanded="false" aria-controls="collapseExample"><h3>Pricing periods</h3></div>
                    <div class="card-body collapse" id="prices">
                        <div class="card-table">
                            <div class="row header">
                                <div class="col-3">Date from</div>
                                <div class="col-3">Date to</div>
                                <div class="col-3">Price</div>
                                <div class="col-3">Controls</div>
                            </div>
                            @foreach($listing->prices as $price)
                                <div class="row">
                                <div class="col-3"><?=date("d.m.Y", strtotime($price->start))?></div>
                                <div class="col-3"><?=date("d.m.Y", strtotime($price->end))?></div>
                                <div class="col-3"><?=number_format($price->price, 2)?></div>
                                <div class="col-3">     <button class="btn btn-primary" data-href="<?=route('price.delete', ["id"=>$price->id])?>" data-toggle="modal" data-target="#confirm-delete">
                                        Delete
                                    </button></div>
                                </div>
                                @endforeach

                            <div class="text-right mt-2">
                                <button class="btn btn-primary" data-toggle="modal" data-target="#priceModal">New price</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mt-5">
                <div class="card">
                    <div class="card-header" data-toggle="collapse" data-target="#reservations" aria-expanded="false" aria-controls="reservations"><h3>Blocked dates</h3></div>
                    <div class="card-body collapse" id="reservations">
                        <div class="card-table">
                            <div class="row header">
                                <div class="col-4">Date from</div>
                                <div class="col-4">Date to</div>
                                <div class="col-4">Controls</div>
                            </div>
                            @foreach($reservations as $reservation)
                                <div class="row">
                                    <div class="col-4"><?=date("d.m.Y", strtotime($reservation->start))?></div>
                                    <div class="col-4"><?=date("d.m.Y", strtotime($reservation->end))?></div>
                                    <div class="col-4">
                                        @if($reservation->owner_reservation)
                                            <button class="btn btn-primary" data-href="<?=route('listing.unblock', ["id"=>$reservation->id])?>" data-toggle="modal" data-target="#confirm-delete">
                                               Unblock
                                            </button>
                                            @else
                                        @endif

                                    </div>
                                </div>
                            @endforeach

                            <div class="text-right mt-2">
                                <button class="btn btn-primary" data-toggle="modal" data-target="#blockModal">Block dates</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="modal fade" id="priceModal" tabindex="-1" role="dialog" aria-labelledby="priceModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="priceModalLabel">Create a new pricing period</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                   <form id="priceForm" method="post" action="<?=route('price.store')?>">
                       @csrf
                    <div class="form-group">
                        <label>Date from</label>
                        <input type="text" name="start" class="datepicker form-control" />
                    </div>
                       <div class="form-group">
                           <label>Date to</label>
                           <input type="text" name="end" class="datepicker form-control" />
                       </div>
                       <div class="form-group">
                           <label>Price</label>
                           <input type="text" class="form-control" name="price" placeholder="ex. 120,00">
                       </div>
                       <input type="hidden" name="listing_id" value="<?=$listing->id?>">
                   </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="priceSubmit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="blockModal" tabindex="-1" role="dialog" aria-labelledby="blockModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="blockModalLabel">Block dates</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="blockForm" method="post" action="<?=route('listing.block')?>">
                        @csrf
                        <div class="form-group">
                            <label>Date from</label>
                            <input type="text" name="start" class="datepicker form-control" />
                        </div>
                        <div class="form-group">
                            <label>Date to</label>
                            <input type="text" name="end" class="datepicker form-control" />
                        </div>

                        <input type="hidden" name="listing_id" value="<?=$listing->id?>">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="blockSubmit" class="btn btn-primary">Block</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="blockModalLabel">Add a gallery image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form enctype="multipart/form-data" id="imageForm" method="post" action="<?=route('image.store', ["id"=>$listing->id])?>">
                        @csrf
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control required" placeholder="Describe the image content" />
                        </div>
                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" name="image", class="form-control required" />
                        </div>


                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="imageSubmit" class="btn btn-primary">Add image</button>
                </div>
            </div>
        </div>
    </div>
<script>
    $("#priceSubmit").on("click", function () {

        //TODO: FE validacija

        $("#priceForm").submit();
    })
    $("#blockSubmit").on("click", function () {

        //TODO: FE validacija

        $("#blockForm").submit();
    })
    $("#imageSubmit").on("click", function () {
        $form=$("#imageForm");
        if(UI.basicValidation($form))  $form.submit();;
    })

</script>
@endsection