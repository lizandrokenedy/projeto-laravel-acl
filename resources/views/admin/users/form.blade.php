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
    <label for="emai">{{__('my.email')}}</label>
    <input type="mail" name="email" class="form-control  @error('email') is-invalid @enderror" id="email"
      value="{{ old('email')  ?? ($register->email ?? '') }}">
    @error('email')
    <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
    </span>
    @enderror
  </div>
  <div class="form-group col-6">
    <label for="password">{{__('my.password')}}</label>
    <input type="password" name="password" class="form-control  @error('password') is-invalid @enderror" id="password"
      value="">
    @error('password')
    <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
    </span>
    @enderror
  </div>
  <div class="form-group col-6">
    <label for="password_confirmation">{{__('my.confirm')}}</label>
    <input type="password" name="password_confirmation"
      class="form-control  @error('password_confirmation') is-invalid @enderror" id="password_confirmation" value="">
  </div>


  <div class="form-group col-6">
      <label for="roles">{{__('my.roles')}}</label>
      <select class="form-control" multiple name="roles[]" id="roles">
        @foreach ($roles as $key => $value)
            @php
                $select = '';
                if(old('roles') ?? false){
                  foreach (old('roles') as $key => $id) {
                    if($id == $value->id){
                      $select = 'selected';
                    }
                  }
                }else {
                  if($register ?? false){
                    foreach ($register->roles as $key => $role) {
                    if($role->id == $value->id){
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