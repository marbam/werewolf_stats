@extends('master.master')

@section('content')
<h2>Faction Listing</h2>
<p> Click a faction to see a breakdown of games for the role</p>
	<table class="table">
		<thead> <th> Faction </th> </thead>
		<tbody> 
			@foreach($factions as $key => $faction)
				<tr>
					<td><a href="/factions/{{$key}}">{{$faction}}</a></td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endsection