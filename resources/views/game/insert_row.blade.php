    <div class="form-row">
      <div class="col">
        <select class="form-control" name="players[start_role][]" placeholder="Starting Role">
          @foreach($roles as $id => $role)
            <option value="{{$id}}">{{$role}}</option>
          @endforeach
        </select>
      </div>
    <div class="col">
        <select class="form-control" name="players[start_faction][]" placeholder="Starting Faction">
          @foreach($factions as $id => $faction)
            <option value="{{$id}}">{{$faction}}</option>
          @endforeach
        </select>
      </div>
      <div class="col">
        <select class="form-control" name="players[end_role][]" placeholder="Ending Role">
          @foreach($roles as $id => $role)
            <option value="{{$id}}">{{$role}}</option>
          @endforeach
        </select>
      </div>
    <div class="col">
        <select class="form-control" name="players[end_faction][]" placeholder="Ending Faction">
          @foreach($factions as $id => $faction)
            <option value="{{$id}}">{{$faction}}</option>
          @endforeach
        </select>
    </div>
    <div class="col">
        <select id="survived" name="players[survived][]" class="form-control">
          <option value="1" selected>Survived</option>
          <option value="0" >Killed</option>
        </select>
      </div>

      <div class="col">
        <select id="victory" name="players[victory][]" class="form-control">
          <option value="1" selected>Won</option>
          <option value="0">Lost</option>
        </select>
      </div>
      <div class="col"> 
        <button type="button" class="btn btn-primary add-button" onclick="add_row()">Add Another</button>
        <button type="button" class="btn btn-danger remove-button" onclick="remove_row(this)">Remove</button>
      </div>
    </div>
  </div>