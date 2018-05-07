    <div class="form-row">
      <div class="col">
        <select class="form-control" placeholder="Starting Role">
          @foreach($roles as $id => $role)
            <option value="{{$id}}">{{$role}}</option>
          @endforeach
        </select>
      </div>
    <div class="col">
        <select class="form-control" placeholder="Starting Faction">
          @foreach($factions as $id => $faction)
            <option value="{{$id}}">{{$faction}}</option>
          @endforeach
        </select>
      </div>
      <div class="col">
        <select class="form-control" placeholder="Ending Role">
          @foreach($roles as $id => $role)
            <option value="{{$id}}">{{$role}}</option>
          @endforeach
        </select>
      </div>
    <div class="col">
        <select class="form-control" placeholder="Ending Faction">
          @foreach($factions as $id => $faction)
            <option value="{{$id}}">{{$faction}}</option>
          @endforeach
        </select>
    </div>
    <div class="col">
        <select id="survived" class="form-control">
          <option selected>Survived</option>
          <option>Killed!</option>
        </select>
      </div>

      <div class="col">
        <select id="victory" class="form-control">
          <option selected>Won</option>
          <option>Lost</option>
        </select>
      </div>
      <div class="col"> 
        <button type="button" class="btn btn-primary add-button" onclick="add_row()">Add Another</button>
        <button type="button" class="btn btn-danger remove-button" onclick="remove_row(this)">Remove</button>
      </div>
    </div>
  </div>