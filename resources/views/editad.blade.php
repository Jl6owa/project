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
    <h1 style="text-align: left;">{{$appartments[0]->city}}</h1>
    <form action="/adview/{{$appartments[0]->id}}/edit/save" enctype="multipart/form-data" method="post">
      @method ('put')
      @csrf
      <p class="ptitle"><input type="text" name="Title" value="{{$appartments[0]->title}}" style="width: 550px"></p>
      <p class="pstreet"><input type="text" name="street" value="{{$appartments[0]->street}}" style="width: 550px"></p>
      <div class="loadpicture">
        <label style="cursor: pointer;">
          <img class="adimage"  src="{{ Storage::url($appartments[0]->imagePath)}}" alt="">
          <div class="addpicture">
            
            
            <input name="imageHere"  id="uploadImage" type="file" accept="image/*"  onchange="PreviewImage();" >
            
            
          </div>
        </label>
        
      </div>
      
      <p class="pstreet"><textarea name="Description" style="height:250px; width: 550px;">{{$appartments[0]->desription}}</textarea></p>
      <p class="pprice">Room count: <input type="number" name="SelectedRoomCount" min="1" max="50" placeholder="1" value="{{$appartments[0]->room_count}}" style="width: 60px">Sleeping places: <input type="number" name="SelectedSleepPlaces" min="1" max="50" placeholder="1" value="{{$appartments[0]->sleep_places}}" style="width: 60px"> Price: from <input type="number" min="1" max="9999" placeholder="000" name="Price" value="{{$appartments[0]->price}}"style="width: 60px"> uah</p>
      <h2>Amenities</h2>
      <div class="amenities_grid">
        <div>
          <input type="checkbox" id="1" name="wifi"  {{$appartments[0]->wifi}} >
          <label for="1">Wi-Fi</label>
        </div>
        <div>
          <input type="checkbox" id="2" name="boiler"  {{$appartments[0]->boiler}} >
          <label for="2">Boiler</label>
        </div>
        <div>
          <input type="checkbox" id="3" name="ac"  {{$appartments[0]->ac}} >
          <label for="3">Air conditioning</label>
        </div>
        <div>
          <input type="checkbox" id="4" name="parking"   {{$appartments[0]->parking}} >
          <label for="4">Parking</label>
        </div>
        <div>
          <input type="checkbox" id="5" name="safe"   {{$appartments[0]->safe}} >
          <label for="5">Safe</label>
        </div>
        <div>
          <input type="checkbox" id="6" name="washing_machine"  {{$appartments[0]->washing_machine}} >
          <label for="6">Washing Machine</label>
        </div>
        <div>
          <input type="checkbox" id="7" name="tv" {{$appartments[0]->tv}} >
          <label for="7">TV</label>
        </div>
        <div>
          <input type="checkbox" id="8" name="iron"  {{$appartments[0]->iron}} >
          <label for="8">Iron</label>
        </div>
      </div>
      <input type="submit" class="loginB" value="Save" style="border: none;">
      <a href="/adview/{{$appartments[0]->id}} title="Edit ad" class="loginB">Cancel</a>
    </form>
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
@endsection