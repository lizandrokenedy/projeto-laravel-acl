<div class="row">
        <div class="form-group col-6">
          <label for="name">{{__('my.name')}}</label>
          <input type="text" name="name" class="form-control  @error('name') is-invalid @enderror" id="name" value="{{ old('name') ?? ($register->name ?? '') }}">
          @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>

        <div class="form-group col-6">
          <label for="description">{{__('my.description')}}</label>
          <input type="text" name="description" class="form-control  @error('description') is-invalid @enderror" id="description" value="{{ old('description') ?? ($register->description ?? '') }}">
          @error('description')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
    
      </div>