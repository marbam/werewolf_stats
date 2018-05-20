@extends('master.master')

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form id="insert-form" action="/store" method="POST">
  <label for="date_played">Date Played:</label>
  <input type="date" class="form-control" name="date_played" value="{{$today}}" id="date_played">
  <hr>
  {{ csrf_field() }}
  <div class="rows">
    @include('game.insert_row')
  </div>
<hr>
<button class="btn btn-success btn btn-block"type="submit">Save</button>
</form>


<script>

function add_row(test) {
    $.ajax({
        url: '/append',
        type: 'GET',
        success: function(data) {
          $('.rows').append(data);
        },
        error: function(data){
            alert('error');
        }
    });
}


function remove_row(test) {

  var count = $('.form-row').length;
  if(count == 1) {
    alert("Can't remove only player")
  } else {
    button = test;
    row = button.closest('.form-row');
    row.remove();    
  }
}

$( document ).ready(function() {

});
</script>
@endsection