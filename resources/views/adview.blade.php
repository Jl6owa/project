<head>
	<link rel="stylesheet" href="/storage/src/assets/dateTimePicker.css">
	<script type="text/javascript" src="/storage/src/scripts/components/jquery.min.js"></script>
	<script type="text/javascript" src="/storage/src/scripts/dateTimePicker.min.js"></script>
</head>
@extends('layouts.layout')
@section('content')
<div class="blocks">
	<div class="leftcolumn">
		@if ($message = Session::get('fail'))
		<div class="errorblock">		
			<ul>
				<li>{{ $message }}</li>
			</ul>
		</div>
		@endif
		@if ($message = Session::get('success'))
		<div class="successblock">		
			<ul>
				<li>{{ $message }}</li>
			</ul>
		</div>
		@endif
		<h1 style="text-align: left;color: black;">{{$appartments[0]->city}}</h1>
		<p class="ptitle">{{$appartments[0]->title}}</p>
		<p class="pstreet">{{$appartments[0]->street}}</p>
		<img  class="adimage"  src="{{ Storage::url($appartments[0]->imagePath)}}" alt="">	
		<p class="pdescrip">{{$appartments[0]->desription}}</p>
		<p class="pprice">Room count: {{$appartments[0]->room_count}} Sleeping places: {{$appartments[0]->sleep_places}} Price: from {{$appartments[0]->price}} uah</p>
		<h2 >Amenities</h2>
		<div class="amenities_grid" style="pointer-events: none;" >
			<div>
				<input type="checkbox" id="1" name="wifi"    {{$appartments[0]->wifi}} >
				<label for="1">Wi-Fi</label>
			</div>		
			<div>
				<input type="checkbox" id="2" name="boiler"  {{$appartments[0]->boiler}} >
				<label for="2">Boiler</label>
			</div>
			<div>				
				<input type="checkbox" id="3" name="ac"    {{$appartments[0]->ac}} >
				<label for="3">Air conditioning</label>
			</div>			
			<div>				
				<input type="checkbox" id="4" name="parking"    {{$appartments[0]->parking}} >
				<label for="4">Parking</label>
			</div>
			<div>				
				<input type="checkbox" id="5" name="safe"    {{$appartments[0]->safe}} >
				<label for="5">Safe</label>
			</div>
			<div>				
				<input type="checkbox" id="6" name="washing_machine"  {{$appartments[0]->washing_machine}} >
				<label for="6">Washing Machine</label>
			</div>
			<div>				
				<input type="checkbox" id="7" name="tv"   {{$appartments[0]->tv}} >
				<label for="7">TV</label>
			</div>
			<div>				
				<input type="checkbox" id="8" name="iron"   {{$appartments[0]->iron}} >
				<label for="8">Iron</label>
			</div>
		</div>
		<iframe
		width="600"
		height="450"
		frameborder="0" style="border-radius: 8px; margin: 10px;"
		src="https://www.google.com/maps/embed/v1/place?key=AIzaSyCQqBGks1Gp8TFjn21EXRSroHFJv51KZL4
		&q={{$appartments[0]->street}},{{$appartments[0]->city}}" allowfullscreen>
		</iframe>		
	</div>
	<div class="rightcolumn">
		<div class="avatar">
			<h2>Owner info</h2>
			<p class="pstreet">{{$appartments[0]->owner}}</p>
			<p class="pstreet">{{$phone->phone_number}}</p>
			@if (Auth::check())
			@if (Auth::user()->name == $appartments[0]->owner)
			<a href="/adview/{{$appartments[0]->id}}/edit" title="Edit ad" class="loginB">Edit ad</a>
			@endif
			<div>
				<div id="basic" data-toggle="calendar" ></div>
				@if (Auth::user()->name <> $appartments[0]->owner)
				<form action="/adview/book/{{$appartments[0]->id}}" method="post" enctype="multipart/form-data">
					@csrf
					<input type="date" id="start" name="bookstart"
					value="<?php echo date('Y-m-d'); ?>"
					min="2020-01-01" >
					<input type="date" id="end" name="bookend"
					value="<?php echo date('Y-m-d'); ?>"
					min="2020-01-01" ></br>
					<input type="submit" class="loginB" value="Request booking" >
				</form>
				@endif
				@if (Auth::user()->name == $appartments[0]->owner)
				<h2>Booking requests</h2>
				@foreach ($bookings as $booking)
				@if ($booking->is_booking_accepted==False)
				<form action="/home/booking/" method="post" accept-charset="utf-8">
					@method ('put')
					@csrf
					<div class="bookingelement">
						<div class="bookingelementtext">
							Booked by:{{$booking->booked_by_user}}<br>
							From:{{$booking->booked_from}} <input type="hidden" value="{{$booking->booked_from}}" name="booked_from"/><br>
							Till: {{$booking->booked_till}} <input type="hidden" value="{{$booking->booked_till}}" name="booked_till"/><br>
							<input type="hidden" value="{{$booking->ad_id}}" name="ad_id"/>
						</div>
						<div class="bookingelementbutton">
							<input type="submit" name="SubmitAction" class="loginB" value="Accept">
							<input type="submit" name="SubmitAction" class="deleteB" value="Cancel">
						</div>
					</div>
				</form>
				@endif
				@endforeach			
				<h2>Accepted bookings</h2>
				@foreach ($bookings as $booking)
				@if ($booking->is_booking_accepted==True)
				<form action="/home/booking/" method="post" accept-charset="utf-8">
					@method ('put')
					@csrf
					<div class="bookingelement">
						<div class="bookingelementtext">
							booked by:{{$booking->booked_by_user}}<br>
							from:{{$booking->booked_from}} <input type="hidden" value="{{$booking->booked_from}}" name="booked_from"/><br>
							till: {{$booking->booked_till}} <input type="hidden" value="{{$booking->booked_till}}" name="booked_till"/><br>
							<input type="hidden" value="{{$booking->ad_id}}" name="ad_id"/>
						</div>
						<div class="bookingelementbutton">
							<input type="submit" class="deleteB" name="SubmitAction" value="Decline">
						</div>
					</div>
					
				</form>
				@endif
				@endforeach
				@endif
				@endif
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
var s= {!! json_encode($bookedstring) !!};
console.log(s);
$(document).ready(function()
{
	$('#basic').calendar({
	unavailable: s,
	onSelectDate: function(date, month, year){
		document.getElementById("start").value = new Date(year,month,date);
}
});
})
</script>
@endsection