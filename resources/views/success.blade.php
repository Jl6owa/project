@extends('layouts.layout')

@section('content')
<div class="actionsdiv">
<div class="elementdiv">
	<a href="/adview/{{$createdID}}" title="See your AD" class="loginB">See your AD</a>
</div>
<div class="elementdiv">
	<a href="/addhome/create" title="See your AD" class="addb">Add another one</a>
</div>
</div>
@endsection