
<div class="form-group">
  <label for="name-field">NOMBRE</label>

  <input type="text" class="form-control
  @if($errors->any()) @if($errors->has("model.name")) is-invalid @else is-valid @endif @endif;
  " id="name-field" name="model[name]" value="
@if(isset($userProfile))
@if($errors->any()){{ old('model.name') }}@else{{ $userProfile->name ?? '' }}@endif
@endif" required>

  @if($errors->has("model.name"))
    <div class="invalid-feedback">{{ $errors->first("model.name") }}</div>
  @else
    <div class="invalid-feedback">Invalid!</div>
  @endif
</div>


<div class="form-group">
  <label for="address-field">DORECCIÓN</label>

  <input type="text" class="form-control
  @if($errors->any()) @if($errors->has("model.address")) is-invalid @else is-valid @endif @endif;
  " id="address-field" name="model[address]" value="
@if(isset($userProfile))
@if($errors->any()){{ old('model.address') }}@else{{ $userProfile->address ?? '' }}@endif
@endif" >

  @if($errors->has("model.address"))
    <div class="invalid-feedback">{{ $errors->first("model.address") }}</div>
  @else
    <div class="invalid-feedback">Invalid!</div>
  @endif
</div>


<div class="form-group">
  <label for="phone-field">TELÉFONO</label>

  <input type="text" class="form-control
  @if($errors->any()) @if($errors->has("model.phone")) is-invalid @else is-valid @endif @endif;
  " id="phone-field" name="model[phone]" value="
@if(isset($userProfile))
@if($errors->any()){{ old('model.phone') }}@else{{ $userProfile->phone ?? '' }}@endif
@endif" >

  @if($errors->has("model.phone"))
    <div class="invalid-feedback">{{ $errors->first("model.phone") }}</div>
  @else
    <div class="invalid-feedback">Invalid!</div>
  @endif
</div>


<div class="form-group">
  <label for="avatar-field">AVATAR</label>

  <input type="text" class="form-control
  @if($errors->any()) @if($errors->has("model.avatar")) is-invalid @else is-valid @endif @endif;
  " id="avatar-field" name="model[avatar]" value="
@if(isset($userProfile))
@if($errors->any()){{ old('model.avatar') }}@else{{ $userProfile->avatar ?? '' }}@endif
@endif" >

  @if($errors->has("model.avatar"))
    <div class="invalid-feedback">{{ $errors->first("model.avatar") }}</div>
  @else
    <div class="invalid-feedback">Invalid!</div>
  @endif
</div>






<div class="form-group">
  <label for="user_id-field">USUARIOS</label>

  <select class="form-control
  @if($errors->any()) @if($errors->has("model.user_id")) is-invalid @else is-valid @endif @endif
  " id="user_id-field" name="model[user_id]">
    <option value=""></option>
  @foreach( $lists["User"] as $list_key => $list_item )
    <option value="{{ $list_key }}"
      @if($errors->any())
        @if( old('user_id') == $list_key ) selected='selected' @endif
      @else
        @if( isset($userProfile) && $userProfile->user_id==$list_key )  selected='selected' @endif
      @endif
   >{{ $list_item }}</option>
  @endforeach
  </select>
  @if($errors->has("model.user_id"))
    <div class="invalid-feedback">{{ $errors->first("model.user_id") }}</div>
  @else
    <div class="invalid-feedback">Invalid!</div>
  @endif
</div>


<div class="form-group">
  <label for="syst_city_id-field">CIUDADES</label>

  <select class="form-control
  @if($errors->any()) @if($errors->has("model.syst_city_id")) is-invalid @else is-valid @endif @endif
  " id="syst_city_id-field" name="model[syst_city_id]">
    <option value=""></option>
  @foreach( $lists["SystCity"] as $list_key => $list_item )
    <option value="{{ $list_key }}"
      @if($errors->any())
        @if( old('syst_city_id') == $list_key ) selected='selected' @endif
      @else
        @if( isset($userProfile) && $userProfile->syst_city_id==$list_key )  selected='selected' @endif
      @endif
   >{{ $list_item }}</option>
  @endforeach
  </select>
  @if($errors->has("model.syst_city_id"))
    <div class="invalid-feedback">{{ $errors->first("model.syst_city_id") }}</div>
  @else
    <div class="invalid-feedback">Invalid!</div>
  @endif
</div>


<div class="form-group">
  <label for="syst_region_id-field">DEPARTAMENTOS</label>

  <select class="form-control
  @if($errors->any()) @if($errors->has("model.syst_region_id")) is-invalid @else is-valid @endif @endif
  " id="syst_region_id-field" name="model[syst_region_id]">
    <option value=""></option>
  @foreach( $lists["SystRegion"] as $list_key => $list_item )
    <option value="{{ $list_key }}"
      @if($errors->any())
        @if( old('syst_region_id') == $list_key ) selected='selected' @endif
      @else
        @if( isset($userProfile) && $userProfile->syst_region_id==$list_key )  selected='selected' @endif
      @endif
   >{{ $list_item }}</option>
  @endforeach
  </select>
  @if($errors->has("model.syst_region_id"))
    <div class="invalid-feedback">{{ $errors->first("model.syst_region_id") }}</div>
  @else
    <div class="invalid-feedback">Invalid!</div>
  @endif
</div>


<div class="form-group">
  <label for="syst_country_id-field">PAISES</label>

  <select class="form-control
  @if($errors->any()) @if($errors->has("model.syst_country_id")) is-invalid @else is-valid @endif @endif
  " id="syst_country_id-field" name="model[syst_country_id]">
    <option value=""></option>
  @foreach( $lists["SystCountry"] as $list_key => $list_item )
    <option value="{{ $list_key }}"
      @if($errors->any())
        @if( old('syst_country_id') == $list_key ) selected='selected' @endif
      @else
        @if( isset($userProfile) && $userProfile->syst_country_id==$list_key )  selected='selected' @endif
      @endif
   >{{ $list_item }}</option>
  @endforeach
  </select>
  @if($errors->has("model.syst_country_id"))
    <div class="invalid-feedback">{{ $errors->first("model.syst_country_id") }}</div>
  @else
    <div class="invalid-feedback">Invalid!</div>
  @endif
</div>




