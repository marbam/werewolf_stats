@extends('master.master')

@section('content')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
     google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawWinnersChart);
      google.charts.setOnLoadCallback(drawSurvivalChart);
      google.charts.setOnLoadCallback(drawLineChart);

      function drawWinnersChart() {

        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Victory');
        data.addColumn('number', 'Players');
        data.addRows([
          ['Won', {{$pie_data[0]}}],
          ['Lost', {{$pie_data[1]}}],
        ]);

        var options = {title:'Winners and Losers',
                       width:500,
                       height:500,
                       colors: ['green', 'red'],
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
          ['Survived', {{$pie_data[2]}}],
          ['Killed', {{$pie_data[3]}}],
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




      function drawLineChart() {
        var data = google.visualization.arrayToDataTable([
          ['date_played', 'instances', 'won', 'lost', 'survived', 'died'],
          @foreach($graph_data as $d)
            ['{{$d[0]->format("d/m/Y")}}', 
            {{$d[1]}},
            {{$d[2]}},
            {{$d[3]}},
            {{$d[4]}},
            {{$d[5]}},
            ],
          @endforeach
        ]);

        var options = {
          title: 'Statistics Over Time',
          curveType: 'function',
          width:1750,
          height:500,
          legend: { position: 'right' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('line_chart'));

        chart.draw(data, options);
      }
    </script>

    <h2 style="text-align:center; padding-top:2rem">{{$role}}</h2>
        <div id="line_chart"></div>

    <table class="columns" style="margin: 0px auto;">
        <tr>
            <td><div id="winners_div"></div></td>
            <td><div id="survival_div"></div></td>
        </tr>
    </table>
<h4></h4>
    <table class="table">
        <thead>
            <th> Game Date</th>
            <th> Victory? </th>
            <th> Survival? </th>
            <th> Link </th>
        </thead>
        <tbody>
            @foreach($games as $g)
                <tr>
                    <td>{{$g->date_played->format('d/m/Y')}}</td>
                    <td>
                        @if($g->victory)
                            Won
                        @else
                            Lost
                        @endif
                    </td>
                    <td>
                        @if($g->survived)
                            Survived
                        @else
                            Killed
                        @endif
                    </td>
                    <td><a href="/game/{{$g->id}}">Show</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection