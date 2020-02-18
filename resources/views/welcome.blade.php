@extends('layouts.layout')
@section('content')
<div class="mainimage">
  <div class="paneloverimage">
    <form name="form" action="/searchres/" method="get">
      <div class="searchbuttonP">          
        <input type="submit" value="Find your stay" class="mainimageText">     
      </div>
      <div class="searchpanel">   
        <div class="searchlabels">
          <p>City</p>
          <p>Number of rooms</p>
          <p>Sleep places</p>
          <p>Dates from</p>
          <p>Dates to</p>
        </div>
        <div class="searchcontent"> 
          <select id="city" name="selectedCity">
            <option value="All">All</option>
            <option value="Dnipro">Dnipro</option>
            <option value="Kharkiv">Kharkiv</option>
            <option value="Kyiv">Kyiv</option>
            <option value="Lutsk">Lutsk</option>
            <option value="Lviv">Lviv</option>
            <option value="Odessa">Odessa</option>
          </select>     
          <select id="rooms" name="selectedRooms">
            <option value="All">All</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
          </select>
          <select id="rooms" name="selectedSleepPlaces">
            <option value="All">All</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
          </select>
          <input type="date" id="start" name="trip_start"
          value="<?php echo date('Y-m-d'); ?>"
          min="2020-01-01" >
          <input type="date" id="end" name="trip_end"
          value="<?php echo date('Y-m-d'); ?>"
          min="2020-01-01" >
        </div>
      </div>     
    </div>
  </form>
</div>
<div class="blocks">
  @foreach($cities as $city)  
  <a href="/searchres/{{$city->city}}" >
    <div class="block" style="background-image: url(/storage/src/{{$city->city}}.png);">   
      <p class="blockstext"> {{$city->city}}</p>
      <p class="blocksT"> {{$classifiedscount[$loop->index]}} classifieds</p>
    </div>
  </a>
  @endforeach
</div>
@endsection