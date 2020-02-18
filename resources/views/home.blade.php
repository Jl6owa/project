@extends('layouts.layout')
@section('content')
<h1>Dashboard</h1>
<div class="TabsBlock">
  <button id="AdsButton" class="loginB" onclick="openTab('Ads')">My ads</button>
  <button id="ProfileButton" class="loginB" onclick="openTab('Profile')">My profile</button>
  <button id="BookingButton" class="loginB" onclick="openTab('Booking')">My bookings</button>
</div>
<div id="Ads" class="tab" >
  <div class="blocks">
    <div class="resblocks" >
      @foreach ($appartments as $appartment)
      <a href="/adview/{{$appartment->id}}" title="">
        <div class="divad">
          <div class="divimage">
            
            <form action="/home/editad/{{$appartment->id}}" enctype="multipart/form-data" method="post">
              @method ('put')
              @csrf
              <div class="adactions">
                <p class="pprice"><input type="submit" name="adaction" value="Delete" placeholder="" class="deleteB" style="border:none;"></p>
                <p class="pprice"><input type="submit" name="adaction" value="Edit" placeholder="" class="loginB" style="border:none;"></p>
              </div>
            </form>
            <img class="divadimage" src="{{ Storage::url($appartment->imagePath)}}" alt="">
            <div class="divadtext">
              <p class="titleClamp">{{$appartment->title}}</p>
              <p class="streetClamp">{{$appartment->street}}</p>
              <div class="pricesleep">
                <p class="miniprice">{{$appartment->sleep_places}}</p> <img style="text-align: center;" src="/storage/src/bed.png" alt="">
                <p class="miniprice"> from {{$appartment->price}} uah</p>
              </div>
            </div>
          </div>
        </div>
      </a>
      @endforeach
    </div>
  </div>
</div>
<div id="Profile" class="tab" style="display:none">
  <h2>My Profile</h2>
  <div class="profileEdit">
    <h2>Edit information</h2>
    <form action="/home/updateuser/change_info" enctype="multipart/form-data" method="post">
      @method ('put')
      @csrf
      <p class="pstreet">Phone number <br>
        <input type="edit" class="inputEdit" class="form-control" value="{{Auth::user()->phone_number}}" name="phone_number"></p>
        <p class="pstreet">Skype<br>
          <input type="edit" class="inputEdit" class="form-control" value="{{Auth::user()->skype}}" name="skype"></p>
          <p class="pstreet">City<br>
            <input type="edit" class="inputEdit" class="form-control" value="{{Auth::user()->city}}" name="city"></p>
            <p class="pstreet">Avatar<br>
              <label class="addb" >Load image
                <input name="avatarHere"  type="file">
                <img class="avatarimg" src="{{ Storage::url(Auth::user()->avatar)}}" alt="">
              </label>
            </p>
            <button class="loginB" type="submit">Save changes</button>
          </form>
          <h2>Edit password</h2>
          <form action="/home/updateuser/change_password" enctype="multipart/form-data" method="post">
            @method ('put')
            @csrf
            <p class="pstreet">New password
              <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password"></p>
              <p class="pstreet">Confirm password
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password"></p>
                @if ($errors->any())
                <div class="alert alert-danger">
                  <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
                @endif
                <button class="loginB" type="submit">Change password</button>
              </form>
            </div>
          </div>
          <div id="Booking" class="tab" style="display:none">
            <h2>My bookings</h2>
            <ol>
              @foreach ($myacceptedbookings as $myacceptedbooking)
              <li>
              <form action="/home/booking/" method="post" accept-charset="utf-8">
                @method ('put')
                @csrf

                <a href="/adview/{{$myacceptedbooking->ad_id}}" title="">
                  @if ($myacceptedbooking->is_booking_accepted==True)
                  <div class="bookingelement" style="background-color: #93c79f">
                  @endif
                  @if ($myacceptedbooking->is_booking_accepted==False)
                  <div class="bookingelement">
                  @endif    
                    <div class="bookingelementtext">
                      <input type="hidden" value="{{$myacceptedbooking->ad_id}}" name="ad_id"/>
                      <p class="pcity"> {{$booked_by_me->firstWhere('id',$myacceptedbooking->ad_id)->city}}</p>
                      <p class="ptitle">{{$booked_by_me->firstWhere('id',$myacceptedbooking->ad_id)->title}}</p>
                      <p class="pstreet">{{$booked_by_me->firstWhere('id',$myacceptedbooking->ad_id)->street}}</p>
                      <p class="pstreet">from:{{$myacceptedbooking->booked_from}} <input type="hidden" value="{{$myacceptedbooking->booked_from}}" name="booked_from"/></p>
                     <p class="pstreet"> till: {{$myacceptedbooking->booked_till}} <input type="hidden" value="{{$myacceptedbooking->booked_till}}" name="booked_till"/></p>
                    </div>
                    <div class="bookingelementbutton">
                      <input type="submit" style="border-style: none;" class="deleteB" name="SubmitAction" value="Cancel">
                    </div>
                  </div>
                </a>
              </form>
            </li>
              @endforeach
            </ol>
          </div>
<script>
function openTab(tabName) 
{
  var i;
  var x = document.getElementsByClassName("tab");
  for (i = 0; i < x.length; i++) 
  {
    x[i].style.display = "none";
  }
  document.getElementById(tabName).style.display = "block";
}

document.getElementById("{{$choosenTab}}").click();
</script>
@endsection