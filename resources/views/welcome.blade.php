@extends('master.master')

@section('content')

<style>
.border-top { border-top: 1px solid #e5e5e5; }
.border-bottom { border-bottom: 1px solid #e5e5e5; }

.box-shadow { box-shadow: 0 .25rem .75rem rgba(0, 0, 0, .05); }

.flex-equal > * {
  -ms-flex: 1;
  flex: 1;
}
@media (min-width: 768px) {
  .flex-md-equal > * {
    -ms-flex: 1;
    flex: 1;
  }
}

.overflow-hidden { overflow: hidden; }

.linkbox {
    cursor: pointer;
    padding-top: 1rem !important;
}

h1 {
    text-align: center;
    font-style: italic;
}

ion-icon {
    font-size: 48px;
}

</style>

    <div class="jumbotron">
        <h1> Bristol Werewolf </h1>
    </div>

    <div class="d-md-flex flex-md-equal w-100 my-md-3 pl-md-3">
      @if(Auth::check())
          <div class="bg-dark mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center text-white overflow-hidden linkbox" id="add">
            <div class="my-3 py-3">
              <ion-icon name="md-add"></ion-icon>
              <h2 class="display-5">Add Game</h2>
              <p class="lead">Add new data to the system</p>
            </div>
          </div>
      @else
        <div class="bg-dark mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center text-white overflow-hidden linkbox" id="login">
            <div class="my-3 py-3">
              <ion-icon name="log-in"></ion-icon>
              <h2 class="display-5">Login</h2>
              <p class="lead">Login to the system</p>
            </div>
          </div>
      @endif
      <div class="bg-light mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden linkbox" id="list">
        <div class="my-3 p-3">
          <ion-icon name="md-list"></ion-icon>
          <h2 class="display-5">Games Listing</h2>
          <p class="lead">View the games</p>
        </div>
      </div>
    </div>

    <div class="d-md-flex flex-md-equal w-100 my-md-3 pl-md-3">
      <div class="bg-light mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden linkbox" id="roles">
        <div class="my-3 p-3">
          <ion-icon name="md-person"></ion-icon>
          <h2 class="display-5">Roles</h2>
          <p class="lead">Analysis of Roles</p>
        </div>
      </div>
      <div class="bg-dark mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center text-white overflow-hidden linkbox" id="factions">
        <div class="my-3 py-3">
          <ion-icon name="md-moon"></ion-icon>
          <h2 class="display-5">Factions</h2>
          <p class="lead">Analysis of Factions</p>
        </div>
      </div>
    </div>

    @if(Auth::check())
      <div class="d-md-flex flex-md-equal w-100 my-md-3 pl-md-3">
        <div class="bg-light mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden linkbox" id="users">
          <div class="my-3 p-3">
            <ion-icon name="md-contacts"></ion-icon>
            <h2 class="display-5">Users</h2>
            <p class="lead">Manage System Admin</p>
          </div>
        </div>
      </div>
    @endif

    <script>

        $('#login').on('click', function() {
            window.location.href = "/insert";
        });

        $('#add').on('click', function() {
            window.location.href = "/insert";
        });

        $('#list').on('click', function() {
            window.location.href = "/list";
        });

        $('#roles').on('click', function() {
            window.location.href = "/roles";
        });

        $('#factions').on('click', function() {
            window.location.href = "/factions";
        });

        $('#users').on('click', function() {
            window.location.href = "/users";
        });

    </script>
@endsection