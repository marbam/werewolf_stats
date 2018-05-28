@extends('master.master')

@section('content')
<h2>Role Listing</h2>
<p> Click a role to see a breakdown of games for the role</p>
	<table class="table">
		<thead> <th> Role Name </th> </thead>
		<tbody> 
			@foreach($roles as $key => $role)
				<tr>
					<td><a href="/roles/{{$key}}">{{$role}}</a></td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endsection