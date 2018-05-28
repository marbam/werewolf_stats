@extends('master.master')

@section('content')

@if($games->isNotEmpty())
	<table class="table">
		<thead>
			<th> Date Played </th>
			<th> Players </th>
			<th> Winners </th>
			<th> Killed </th>
			<th> Details </th>
		</thead>
		<tbody>
			@foreach($games as $g)
				<tr>
					<td>{{$g->date_played->format('l, dS F y')}}</td>
					<td>{{count($g->players)}}</td>
					<td>{{count($g->players->where('victory', 1))}}</td>
					<td>{{count($g->players->where('survived', 1))}}</td>
					<td><a href="/game/{{$g->id}}">Show</a></td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	No games
@endif

@endsection