@extends('master.master')

@section('content')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
     google.charts.load('current', {'packages':['corechart', 'bar']});
      // google.charts.setOnLoadCallback(drawWinnersChart);
      // google.charts.setOnLoadCallback(drawSurvivalChart);
      google.charts.setOnLoadCallback(drawPlayedCumulativeChart);
      google.charts.setOnLoadCallback(drawPlayedByWeekChart);
      google.charts.setOnLoadCallback(drawVictoryLossPie);
      google.charts.setOnLoadCallback(drawWinsByWeekChart);
      google.charts.setOnLoadCallback(drawLossByWeekChart);

      function drawPlayedCumulativeChart() {
        var data = google.visualization.arrayToDataTable([
          ['Date', 'played'],
          @foreach($played_cumulative as $d)
            ['{{$d[0]->format("d/m/Y")}}', 
            {{$d[1]}}
            ],
          @endforeach
        ]);

        var options = {
          title: 'Occurances over time (Cumulative)',
          curveType: 'function',
          width:1000,
          height:500,
          legend: { position: 'right' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('played_cumulative_chart'));

        chart.draw(data, options);
      }

      function drawPlayedByWeekChart() {
        var data = google.visualization.arrayToDataTable([
          ['Date', 'Occurances'],
          @foreach($played_cumulative as $d)
            ['{{$d[0]->format("d/m/Y")}}', 
            {{$d[1]}}
            ],
          @endforeach
        ]);

        var options = {
          width: 700,
          height: 500,
          legend: { position: 'none' },
          chart: { title: 'Occurance by date'},
          bars: 'vertical', // Required for Material Bar Charts.
        };

        var chart = new google.charts.Bar(document.getElementById('played_by_week_chart'));

        chart.draw(data, options);
      }

      function drawVictoryLossPie() {

        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Victory');
        data.addColumn('number', 'Players');
        data.addRows([
          ['Won', {{$victories}}],
          ['Lost', {{$losses}}],
        ]);

        var options = {title:'Overall Success',
                       width:500,
                       height:500,
                       colors: ['green', 'red'],
                       pieSliceText: 'value'
                   };

        var chart = new google.visualization.PieChart(document.getElementById('winner_pie'));
        chart.draw(data, options);
      }

      function drawWinsByWeekChart() {
        var data = google.visualization.arrayToDataTable([
          ['Date', 'Wins'],
          @foreach($wins_by_week as $d)
            ['{{$d[0]->format("d/m/Y")}}', 
            {{$d[1]}}
            ],
          @endforeach
        ]);

        var options = {
          width: 500,
          height: 500,
          legend: { position: 'none' },
          chart: { title: 'Wins by date'},
          bars: 'vertical', // Required for Material Bar Charts.
        };

        var chart = new google.charts.Bar(document.getElementById('winner_line'));

        chart.draw(data, options);
      }

      function drawLossByWeekChart() {
        var data = google.visualization.arrayToDataTable([
          ['Date', 'Losses'],
          @foreach($loss_by_week as $d)
            ['{{$d[0]->format("d/m/Y")}}', 
            {{$d[1]}}
            ],
          @endforeach
        ]);

        var options = {
          width: 500,
          height: 500,
          legend: { position: 'none' },
          chart: { title: 'Losses by date'},
          bars: 'vertical', // Required for Material Bar Charts.
        };

        var chart = new google.charts.Bar(document.getElementById('loser_line'));

        chart.draw(data, options);
      }


    </script>

    <h2 style="text-align:center; padding-top:2rem">{{$faction}}</h2>

    <table class="columns" style="margin: 0px auto;">
        <tr>
          <td><div id="played_cumulative_chart"></div></td>
          <td><div id="played_by_week_chart"></div></td>
            {{-- <td><div id="winners_div"></div></td> --}}
            {{-- <td><div id="survival_div"></div></td> --}}
        </tr>
    </table>

    <table class="columns" style="margin: 0px auto;">
        <tr>
            <td><div id="winner_pie"></div></td>
            <td><div id="winner_line"></div></td>
            <td><div id="loser_line"></div></td>
            {{-- <td><div id="survival_div"></div></td> --}}
        </tr>
    </table>




<h4></h4>
{{--     <table class="table">
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
    </table> --}}
@endsection