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
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
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
        </thead>
        <tbody>
            @foreach($players as $p)
                <tr>
                    <td>{{$roles[$p->start_role]}}</td>
                    <td>{{$factions[$p->start_faction]}}</td>
                    <td>{{$roles[$p->end_role]}}</td>
                    <td>{{$factions[$p->end_faction]}}</td>
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
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection