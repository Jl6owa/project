@extends('layouts.layout')
@section('content')
<div class="blocks">
  <div class="leftcolumn" style="width: 80%;">
    <div class="errorblock">
      @if ($errors->any())
      <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
      @endif
    </div>
    <form action={{route('store')}} method="post" enctype="multipart/form-data">
      @csrf
      <select id="country" name="SelectedCity" style="font-size: 2em; font-weight: 500; border-style: none; text-align: left;">
        <option value="Kyiv">Kyiv</option>
        <option value="Kharkiv">Kharkiv</option>
        <option value="Lutsk">Lutsk</option>
        <option value="Dnipro">Dnipro</option>
        <option value="Lviv">Lviv</option>
        <option value="Odessa">Odessa</option>
      </select>
      <p class="ptitle"><input type="text" name="Title" placeholder="Title here.." style="width: 500px"></p>
      <p class="pstreet"><input type="text" name="street" placeholder="Street here.." style="width: 500px"></p>
      <div class="loadpicture">
        <label style="cursor: pointer;">
          <img  class="adimage"  id="uploadPreview" src="/storage/src/noimage.png" >
          <div class="addpicture">          
            <input name="imageHere"  id="uploadImage" type="file" accept="image/*"  onchange="PreviewImage();" >        
          </div>
        </label>       
      </div>
      <p class="pstreet"><textarea name="Description" style="height:200px; width: 500px;" placeholder="Description here.."></textarea></p>
      <p class="pprice">Room count: <input type="number" name="SelectedRoomCount" min="1" max="50" placeholder="1" value="1" style="width: 60px">Sleeping places: <input type="number" name="SelectedSleepPlaces" min="1" max="50" placeholder="1" value="1" style="width: 60px"> Price: from <input type="number" min="1" max="9999" placeholder="000" name="Price" value="0"style="width: 60px"> uah</p>
        <h2>Amenities</h2>
        <div class="amenities_grid">
          <div>
            <input type="checkbox" id="1" name="wifi">
            <label for="1">Wi-Fi</label>
          </div>
          <div>
            <input type="checkbox" id="2" name="boiler">
            <label for="2">Boiler</label>
          </div>
          <div>
            <input type="checkbox" id="3" name="ac"
            <label for="3">Air conditioning</label>
          </div>
          <div>
            <input type="checkbox" id="4" name="parking">
            <label for="4">Parking</label>
          </div>
          <div>
            <input type="checkbox" id="5" name="safe">
            <label for="5">Safe</label>
          </div>
          <div>
            <input type="checkbox" id="6" name="washing_machine">
            <label for="6">Washing Machine</label>
          </div>
          <div>
            <input type="checkbox" id="7" name="tv">
            <label for="7">TV</label>
          </div>
          <div>
            <input type="checkbox" id="8" name="iron">
            <label for="8">Iron</label>
          </div>
        </div>        
        <script type="text/javascript">
        function PreviewImage() {
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);
        oFReader.onload = function (oFREvent) {
        document.getElementById("uploadPreview").src = oFREvent.target.result;
        };
        };
        </script>       
        <input type="submit" value="Submit" class="loginB" style="margin: 10px;">
      </form>
    </div>
  </div>
  @endsection