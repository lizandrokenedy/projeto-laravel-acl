<div class="row">
  <div class="form-group col-6">
    <label for="name">{{__('my.name')}}</label>
    <input type="text" name="name" class="form-control  @error('name') is-invalid @enderror" id="name"
      value="{{ old('name') ?? ($register->name ?? '') }}">
    @error('name')
    <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
    </span>
    @enderror
  </div>

  <div class="form-group col-6">
    <label for="description">{{__('my.description')}}</label>
    <input type="text" name="description" class="form-control  @error('description') is-invalid @enderror"
      id="description" value="{{ old('description') ?? ($register->description ?? '') }}">
    @error('description')
    <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
    </span>
    @enderror
  </div>

  <div class="form-group col-6">
    <label for="permissions">{{__('my.permissions')}}</label>
    <select class="form-control" multiple name="permissions[]" id="permissions">
      @foreach ($permissions as $key => $value)
          @php
              $select = '';
              if(old('permissions') ?? false){
                foreach (old('permissions') as $key => $id) {
                  if($id == $value->id){
                    $select = 'selected';
                  }
                }
              }else {
                if($register ?? false){
                  foreach ($register->permissions as $key => $permission) {
                  if($permission->id == $value->id){
                    $select = 'selected';
                  }
                }
                }
              }

          @endphp
          <option {{$select}} value="{{$value->id}}">{{$value->name}}</option>
      @endforeach
    </select>
  </div>

</div>