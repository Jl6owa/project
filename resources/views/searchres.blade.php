@extends('layouts.layout')
@section('content')
<div class="resultsTitle">
	<h1>Search Results for '{{ implode(', ', $k )}}'</h1>
</div>
<div class="blocks">
	<div class="resblocks" >
		@foreach ($appartments as $appartment)
		<a href="/adview/{{$appartment->id}}" title="">
			<div class="divad">
				<div class="divimage">
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
@endsection