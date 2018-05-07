@extends('master.master')

@section('content')

<form id="insert-form" action="/test" method="POST">
  <div class="rows">
    @include('game.insert_row')
  </div>
<button type="submit">Save</button>
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