<select name="id_partida" id="" class="form-control">
      <option class="select-wit" value="">Plan de Estudios</option>
      @foreach($partidas as $row)
        <option value="{{$row->id}}">{{$row->nombre}}</option>
        @endforeach
      </select>