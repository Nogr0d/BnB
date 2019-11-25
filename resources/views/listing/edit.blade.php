@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h1>Edit listing "{{$listing->name}}"</h1></div>
                    <div class="card-body">
                        <form action="" enctype="multipart/form-data" method="post">
                            @csrf
                            <div class="form-group row">
                                <label for="name" class="col-4 col-form-label">Listing name</label>
                                <div class="col-8">
                                    <input id="name" name="name" type="text"  class="form-control" value="{{$listing->name}}">
                                    @if ($errors->has('name'))
                                        <strong>{{$errors->first('name')}}</strong>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-4 col-form-label">Header image (upload new)</label>
                                <div class="col-8">
                                    <input id="image" name="image" type="file" accept="image/jpeg,image/png"  class="form-control">
                                    @if ($errors->has('image'))
                                        <strong>{{$errors->first('image')}}</strong>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="guests" class="col-4 col-form-label">Guests</label>
                                <div class="col-8">
                                    <select id="guests" name="guests" class="custom-select" >
                                        @for($i=1; $i<13; $i++)
                                            <option @if($i==$listing->guests) selected @endif value="<?=$i?>"><?=$i?> adult</option>

                                        @endfor
                                    </select>
                                    @if ($errors->has('guests'))
                                        <strong>{{$errors->first('guests')}}</strong>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="location" class="col-4 col-form-label">Location</label>
                                <div class="col-8">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fa fa-location-arrow"></i>
                                            </div>
                                        </div>
                                        <select id="location_id" name="location_id"  class="form-control">
                                            @foreach($locations as $l)
                                                <option @if($l->id==$listing->location_id) selected @endif value="<?=$l->id?>">{{$l->name}}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="description" class="col-4 col-form-label">Description</label>
                                <div class="col-8">
                                    <textarea id="description" name="description" cols="40" rows="8" class="form-control" >{{$listing->description}}</textarea>
                                    @if ($errors->has('description'))
                                        <strong>{{$errors->first('description')}}</strong>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="address" class="col-4 col-form-label">Address (visible only after payment)</label>
                                <div class="col-8">
                                    <input id="address" name="address" type="text" class="form-control" value="{{$listing->address}}" />
                                    @if ($errors->has('address'))
                                        <strong>{{$errors->first('address')}}</strong>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="bedrooms" class="col-4 col-form-label">Bedrooms</label>
                                <div class="col-8">
                                    <select id="bedrooms" name="bedrooms" class="custom-select" >
                                        @for($i=1; $i<5; $i++)
                                            <option @if($i==$listing->bedrooms) selected @endif value="<?=$i?>"><?=$i?></option>

                                        @endfor

                                    </select>
                                    @if ($errors->has('bedrooms'))
                                        <strong>{{$errors->first('bedrooms')}}</strong>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="beds" class="col-4 col-form-label">Beds</label>
                                <div class="col-8">
                                    <select id="beds" name="beds" class="custom-select" >

                                        @for($i=1; $i<8; $i++)
                                            <option @if($i==$listing->$i) selected @endif value="<?=$i?>"><?=$i?></option>

                                        @endfor
                                    </select>
                                    @if ($errors->has('beds'))
                                        <strong>{{$errors->first('beds')}}</strong>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="bathrooms" class="col-4 col-form-label">Bathrooms</label>
                                <div class="col-8">
                                    <select id="bathrooms" name="bathrooms" class="custom-select">
                                        @for($i=1; $i<4; $i++)
                                            <option @if($i==$listing->$i) selected @endif value="<?=$i?>"><?=$i?></option>

                                        @endfor
                                    </select>
                                    @if ($errors->has('bathrooms'))
                                        <strong>{{$errors->first('bathrooms')}}</strong>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-4">Amneties</label>
                                <div class="col-8">
                                    <?php $listingAmneties=$listing->amneties->pluck('id')->toArray();
//                                    dd($listingAmneties);
                                    // ?>
                                    @foreach($amneties as $a)

                                        <div class="custom-control custom-checkbox custom-control-inline">

                                            <input @if(in_array($a->id, $listingAmneties)) checked @endif name="amneties[]" id="amnety-<?=$a->id?>"  type="checkbox"  class="custom-control-input" value="<?=$a->id?>">
                                            <label for="amnety-<?=$a->id?>" class="custom-control-label"><?=$a->name?></label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="price" class="col-4 col-form-label">Base price</label>
                                <div class="col-8">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fa fa-dollar"></i>
                                            </div>
                                        </div>
                                        <input id="price" name="price" placeholder="ex. $80" type="text" value="<?=$listing->price?>" class="form-control" >
                                        @if ($errors->has('price'))
                                            <strong>{{$errors->first('price')}}</strong>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="check-in-from" class="col-4 col-form-label">Check-in from</label>
                                <div class="col-8">
                                    <select id="check_in_from" name="check_in_from"  class="custom-select">

                                        @for($i=0; $i<24; $i++)
                                            <?php $value=str_pad($i, 2, '0', STR_PAD_LEFT).":00";

                                            ?>
                                                <option  @if($value==$listing->check_in_from) selected @endif value="00:00"><?=$value?></option>

                                        @endfor


                                    </select>
                                    @if ($errors->has('check_in_from'))
                                        <strong>{{$errors->first('check_in_from')}}</strong>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label for="check-in-to" class="col-4 col-form-label">Check-in to</label>
                                <div class="col-8">
                                    <select id="check_in_to" name="check_in_to" class="custom-select" >
                                        @for($i=0; $i<24; $i++)
                                            <?php $value=str_pad($i, 2, '0', STR_PAD_LEFT).":00";

                                            ?>
                                            <option  @if($value==$listing->check_in_to) selected @endif value="00:00"><?=$value?></option>

                                        @endfor

                                    </select>
                                    @if ($errors->has('check_in_to'))
                                        <strong>{{$errors->first('check_in_to')}}</strong>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="check-out" class="col-4 col-form-label">Check-out max</label>
                                <div class="col-8">
                                    <select id="check_out" name="check_out" class="custom-select" >
                                        @for($i=0; $i<24; $i++)
                                            <?php $value=str_pad($i, 2, '0', STR_PAD_LEFT).":00";

                                            ?>
                                            <option  @if($value==$listing->check_out) selected @endif value="00:00"><?=$value?></option>

                                        @endfor
                                    </select>
                                    @if ($errors->has('check_out'))
                                        <strong>{{$errors->first('check_out')}}</strong>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="offset-4 col-8">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>



                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
