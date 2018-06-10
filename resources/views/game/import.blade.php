@extends('master.master')

@section('content')

	<h2>Game Import</h2>
	<p>Logically, this page should only really be used for testing/one offs</p>
	<p>With that in mind, here are your steps for csv import:</p>
	<ul>
		<li>Rename your CSV file to "import.csv"</li>
		<li>Place under /storage/public directory on server</li>
		<li>Click GO button</li>
	</ul>
	<p><strong>Please note that this will wipe out all of your existing games...</strong></p>

	<button class="btn btn-success" onclick="window.location.href='/game/import_start';">Go!</button>

@endsection