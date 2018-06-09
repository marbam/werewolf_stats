@extends('master.master')

@section('content')

	@if($users->isEmpty())
		<h2>No users in system</h2>
	@else
		<table class="table">
			<thead> 
				<th> Name </th> 
				<th> Email </th> 
				<th> Access </th> 
			</thead>
			<tbody> 
				@foreach($users as $key => $user)
					<tr>
						<td>{{$user->name}}</td>
						<td>{{$user->email}}</td>
						<td>
					        <button type="button" class="btn btn-success approve-button" @if($user->approved) style="display:none" @endif onclick="approve(this, {{$user->id}})">Approve</button>
					        <button type="button" class="btn btn-primary revoke-button" @if(!$user->approved) style="display:none" @endif onclick="revoke(this, {{$user->id}})">Revoke</button>
					        <button type="button" class="btn btn-danger delete-button" onclick="remove(this, {{$user->id}})">Delete User</button>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	@endif

@endsection

<script>
function approve(row, user) {
    $.ajax({
        url: '/approve_user',
        type: 'POST',
        data: {
                "user_id": user,
                "_token": "{{ csrf_token() }}"
              },
        success: function(data) {
		    var td = $(row.closest('td'));
		    $(td).find('.approve-button').css('display', 'none');
		    $(td).find('.revoke-button').css('display', 'inline-block');
        },
        error: function(data){
            alert('something went wrong...');
        }
    });
}

function revoke(row, user) {
    $.ajax({
        url: '/revoke_user',
        type: 'POST',
        data: {
                "user_id": user,
                "_token": "{{ csrf_token() }}"
              },
        success: function(data) {
		    var td = $(row.closest('td'));
		    $(td).find('.approve-button').css('display', 'inline-block');
		    $(td).find('.revoke-button').css('display', 'none');
        },
        error: function(data){
            alert('something went wrong...');
        }
    });
}

function remove(row, user) {
	alert('clicked')
	if(confirm('Are you sure you want to delete this user?')) {
	    $.ajax({
	        url: '/delete_user',
	        type: 'POST',
	        data: {
	                "user_id": user,
	                "_token": "{{ csrf_token() }}"
	              },
	        success: function(data) {
			    var tr = $(row.closest('tr'));
			    $(tr).remove();
	        },
	        error: function(data){
	            alert('something went wrong...');
	        }
	    });
	}


}
</script>