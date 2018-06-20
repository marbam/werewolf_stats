@extends('master.master')

@section('content')

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawWinnersChart);
      google.charts.setOnLoadCallback(drawSurvivalChart);

      function drawWinnersChart() {

        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Victory');
        data.addColumn('number', 'Players');
        data.addRows([
          ['Won', {{count($players->where('victory', 1))}}],
          ['Lost', {{count($players->where('victory', 0))}}],
        ]);

        var options = {title:'Winners and Losers',
                       width:500,
                       height:500,
                       colors: ['green', 'grey'],
                       pieSliceText: 'value'
                   };

        var chart = new google.visualization.PieChart(document.getElementById('winners_div'));
        chart.draw(data, options);
      }

      function drawSurvivalChart() {

        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Alive');
        data.addColumn('number', 'Died');
        data.addRows([
          ['Survived', {{count($players->where('survived', 1))}}],
          ['Killed', {{count($players->where('survived', 0))}}],
        ]);

        var options = {title:'Survival and Kills',
                       width:500,
                       height:500,
                       colors: ['blue', 'black'],
                       pieSliceText: 'value'
                   };

        var chart = new google.visualization.PieChart(document.getElementById('survival_div'));
        chart.draw(data, options);
      }
    </script>

  <h2>Game Details</h2>
  <h4>Played on {{$game->date_played->format('d/m/Y')}} with {{count($players)}} players.</h4> 

  <table class="columns">
      <tr>
          <td><div id="winners_div"></div></td>
          <td><div id="survival_div"></div></td>
      </tr>
  </table>
  <h4>Player Listing</h4>
  <table class="table">
      <thead>
          <th> Starting Role </th>
          <th> Starting Faction </th>
          <th> Ending Role </th>
          <th> Ending Faction </th>
          <th> Victory? </th>
          <th> Survival? </th>
          @if(Auth::check())
            <th> Options </th>
          @endif
      </thead>
      <tbody>
          @foreach($players as $p)
              <tr class="player_row" data-player="{{$p->id}}" data-start_role="{{$p->start_role}}" data-start_faction="{{$p->start_faction}}" data-end_role="{{$p->end_role}}" data-end_faction="{{$p->end_faction}}" data-victory="{{$p->victory}}" data-survived="{{$p->survived}}">
                  <td><a href="/roles/{{$p->start_role}}">{{$roles[$p->start_role]}}</a></td>
                  <td><a href="/factions/{{$p->start_faction}}">{{$factions[$p->start_faction]}}</a></td>
                  <td><a href="/roles/{{$p->end_role}}">{{$roles[$p->end_role]}}</a></td>
                  <td><a href="/factions/{{$p->end_faction}}">{{$factions[$p->end_faction]}}</a></td>
                  <td>
                      @if($p->victory)
                          Won
                      @else
                          Lost
                      @endif
                  </td>
                  <td>
                      @if($p->survived)
                          Survived
                      @else
                          Killed
                      @endif
                  </td>
                  @if(Auth::check())
                    <td>
                      <button class="btn btn-warning" onclick="set_modal_fields(this)" data-toggle="modal" data-target="#editModal">Edit</button>
                      <button class="btn btn-danger" onclick="delete_player(this)">Delete</button>
                    </td>
                  @endif
              </tr>
          @endforeach
      </tbody>
  </table>

<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit Player...</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" data-id="">

        <label for="start_role">Start Role</label>
        <select class="form-control" id="start_role" name="start_role">
          @foreach($roles as $id => $role)
            <option value="{{$id}}">{{$role}}</option>
          @endforeach
        </select>

        <label for="start_faction">Start Faction</label>
        <select class="form-control" id="start_faction"  name="start_faction">
          @foreach($factions as $id => $faction)
            <option value="{{$id}}">{{$faction}}</option>
          @endforeach
        </select>

        <label for="end_role">End Role</label>
        <select class="form-control" id="end_role" name="end_role">
          @foreach($roles as $id => $role)
            <option value="{{$id}}">{{$role}}</option>
          @endforeach
        </select>

        <label for="end_faction">End Faction</label>
        <select class="form-control" id="end_faction" name="end_faction">
          @foreach($factions as $id => $faction)
            <option value="{{$id}}">{{$faction}}</option>
          @endforeach
        </select>


        <label for="victory">Victory</label>
        <select id="victory" name="victory" id="victory" class="form-control">
          <option value="1">Won</option>
          <option value="0">Lost</option>
        </select>

        <label for="survived">Survived</label>
        <select id="survived" name="survived" id="survived" class="form-control">
          <option value="1">Survived</option>
          <option value="0">Killed</option>
        </select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-success" onclick="send_update()">Save changes</button>
      </div>
    </div>
  </div>
</div>


  <script>
  @if(Auth::check())
      function delete_player(button_clicked) {
        if(confirm("Are you sure?")) {
          var player_row = $(button_clicked).closest('.player_row');
          var player_id = player_row.data('player');

          $.ajax({
              url: '/delete_player',
              type: 'POST',
              data: {
                      "player_id": player_id  ,
                      "_token": "{{ csrf_token() }}"
                    },
              success: function(data) {
                if(data == "deleted") {
                    player_row.remove();
                    alert("Reloading page with new data...");
                    location.reload();
                } else if(data == "last_one") {
                    alert("You've deleted everyone, returning you back to the listing...");
                    location.href = "/list";
                }
              },
              error: function(data){
                  alert('something went wrong...');
              }
          });

        }
      }

      function set_modal_fields(button_clicked) {
        var player_row = $(button_clicked).closest('.player_row');
        $('.modal-body').attr('data-id', player_row.data('player'));
        $('#start_role').val(player_row.data('start_role'));
        $('#start_faction').val(player_row.data('start_faction'));
        $('#end_role').val(player_row.data('end_role'));
        $('#end_faction').val(player_row.data('end_faction'));
        $('#survived').val(player_row.data('survived'));
        $('#victory').val(player_row.data('victory'));
      }


      function send_update() {
        var id = $('.modal-body').data('id');
        $.ajax({
            url: '/edit_player',
            type: 'POST',
            data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id,
                    "start_role": $('#start_role').val(),
                    "start_faction": $('#start_faction').val(),
                    "end_role": $('#end_role').val(),
                    "end_faction": $('#end_faction').val(),
                    "survived": $('#survived').val(),
                    "victory": $('#victory').val(),
                  },
            success: function(data) {
              if(data == "updated") {
                  alert("Reloading page with new data...");
                  location.reload();
              } else if(data == "last_one") {
                  alert('Saving failed.');
              }
            },
            error: function(data){
                alert('something went wrong...');
            }
        });
      }

    @else
      function delete_player(button_clicked) {}
      function set_modal_fields(button_clicked) {}
      function send_update() {}

    @endif
  </script>

@endsection