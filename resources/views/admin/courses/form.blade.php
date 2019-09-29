<div class="row">
        <div class="form-group col-6">
          <label for="title">{{__('my.title')}}</label>
          <input type="text" name="title" class="form-control  @error('title') is-invalid @enderror" id="title" value="{{ old('title') ?? ($register->title ?? '') }}">
          @error('title')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>

        <div class="form-group col-6">
          <label for="value">{{__('my.value')}}</label>
          <input type="text" name="value" class="form-control  @error('value') is-invalid @enderror" id="value" value="{{ old('value') ?? ($register->value ?? '') }}">
          @error('value')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
    
      </div>