@extends('master.master')

@section('content')

@if($games->isNotEmpty())
    @if(Auth::check())
		<button class="btn btn-dark" id="export_games" style="float:right">Export Games</button>
	@endif
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
    @if(Auth::check())
		<button class="btn btn-dark" id="import_games" style="float:right">Import Games</button>
	@endif
@endif

<script>
	$('#export_games').on('click', function() {
		window.location.href = "/export_games";
	})

	$('#import_games').on('click', function() {
		window.location.href = "/game/import";
	});
</script>


@endsection