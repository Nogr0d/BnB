@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h1>{{ __('Add new listing') }}</h1></div>
                    <div class="card-body">
    <form action="{{route('listing.store')}}" enctype="multipart/form-data" method="post" type="mul">
        @csrf
        <div class="form-group row">
            <label for="name" class="col-4 col-form-label">Listing name</label>
            <div class="col-8">
                <input id="name" name="name" type="text"  class="form-control">
                @if ($errors->has('name'))
                    <strong>{{$errors->first('name')}}</strong>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="name" class="col-4 col-form-label">Header image</label>
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
                        <option value="<?=$i?>"><?=$i?> adult</option>

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
                        <option value="<?=$l->id?>">{{$l->name}}</option>
                           @endforeach
                    </select>

                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="description" class="col-4 col-form-label">Description</label>
            <div class="col-8">
                <textarea id="description" name="description" cols="40" rows="8" class="form-control" ></textarea>
                @if ($errors->has('description'))
                    <strong>{{$errors->first('description')}}</strong>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="address" class="col-4 col-form-label">Address (visible only after payment)</label>
            <div class="col-8">
                <input id="address" name="address" type="text" class="form-control" />
                @if ($errors->has('address'))
                    <strong>{{$errors->first('address')}}</strong>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="bedrooms" class="col-4 col-form-label">Bedrooms</label>
            <div class="col-8">
                <select id="bedrooms" name="bedrooms" class="custom-select" >
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
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
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
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
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                </select>
                @if ($errors->has('bathrooms'))
                    <strong>{{$errors->first('bathrooms')}}</strong>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label class="col-4">Amneties</label>
            <div class="col-8">
               @foreach($amneties as $a)

                    <div class="custom-control custom-checkbox custom-control-inline">

                        <input name="amneties[]" id="amnety-<?=$a->id?>"  type="checkbox"  class="custom-control-input" value="<?=$a->id?>">
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
                    <input id="price" name="price" placeholder="ex. $80" type="text" class="form-control" >
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
                    <option value="00:00">00:00</option>
                    <option value="01:00">01:00</option>
                    <option value="02:00">02:00</option>
                    <option value="03:00">03:00</option>
                    <option value="04:00">04:00</option>
                    <option value="05:00">05:00</option>
                    <option value="06:00">06:00</option>
                    <option value="07:00">07:00</option>
                    <option value="08:00">08:00</option>
                    <option value="09:00">09:00</option>
                    <option value="10:00">10:00</option>
                    <option value="11:00">11:00</option>
                    <option value="12:00">12:00</option>
                    <option value="13:00">13:00</option>
                    <option value="14:00">14:00</option>
                    <option value="15:00">15:00</option>
                    <option value="16:00">16:00</option>
                    <option value="17:00">17:00</option>
                    <option value="18:00">18:00</option>
                    <option value="19:00">19:00</option>
                    <option value="20:00">20:00</option>
                    <option value="21:00">21:00</option>
                    <option value="22:00">22:00</option>
                    <option value="23:00">23:00</option>
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
                    <option value="00:00">00:00</option>
                    <option value="01:00">01:00</option>
                    <option value="02:00">02:00</option>
                    <option value="03:00">03:00</option>
                    <option value="04:00">04:00</option>
                    <option value="05:00">05:00</option>
                    <option value="06:00">06:00</option>
                    <option value="07:00">07:00</option>
                    <option value="08:00">08:00</option>
                    <option value="09:00">09:00</option>
                    <option value="10:00">10:00</option>
                    <option value="11:00">11:00</option>
                    <option value="12:00">12:00</option>
                    <option value="13:00">13:00</option>
                    <option value="14:00">14:00</option>
                    <option value="15:00">15:00</option>
                    <option value="16:00">16:00</option>
                    <option value="17:00">17:00</option>
                    <option value="18:00">18:00</option>
                    <option value="19:00">19:00</option>
                    <option value="20:00">20:00</option>
                    <option value="21:00">21:00</option>
                    <option value="22:00">22:00</option>
                    <option value="23:00">23:00</option>
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
                    <option value="00:00">00:00</option>
                    <option value="01:00">01:00</option>
                    <option value="02:00">02:00</option>
                    <option value="03:00">03:00</option>
                    <option value="04:00">04:00</option>
                    <option value="05:00">05:00</option>
                    <option value="06:00">06:00</option>
                    <option value="07:00">07:00</option>
                    <option value="08:00">08:00</option>
                    <option value="09:00">09:00</option>
                    <option value="10:00">10:00</option>
                    <option value="11:00">11:00</option>
                    <option value="12:00">12:00</option>
                    <option value="13:00">13:00</option>
                    <option value="14:00">14:00</option>
                    <option value="15:00">15:00</option>
                    <option value="16:00">16:00</option>
                    <option value="17:00">17:00</option>
                    <option value="18:00">18:00</option>
                    <option value="19:00">19:00</option>
                    <option value="20:00">20:00</option>
                    <option value="21:00">21:00</option>
                    <option value="22:00">22:00</option>
                    <option value="23:00">23:00</option>
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
