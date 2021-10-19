
<div class="form-group">
  <label for="name-field">NOMBRE</label>

  <input type="text" class="form-control
  @if($errors->any()) @if($errors->has("model.name")) is-invalid @else is-valid @endif @endif;
  " id="name-field" name="model[name]" value="
@if(isset($setting))
@if($errors->any()){{ old('model.name') }}@else{{ $setting->name ?? '' }}@endif
@endif" required>

  @if($errors->has("model.name"))
    <div class="invalid-feedback">{{ $errors->first("model.name") }}</div>
  @else
    <div class="invalid-feedback">Invalid!</div>
  @endif
</div>


<div class="form-group">
  <label for="code-field">CÓDIGO</label>

  <input type="text" class="form-control
  @if($errors->any()) @if($errors->has("model.code")) is-invalid @else is-valid @endif @endif;
  " id="code-field" name="model[code]" value="
@if(isset($setting))
@if($errors->any()){{ old('model.code') }}@else{{ $setting->code ?? '' }}@endif
@endif" required>

  @if($errors->has("model.code"))
    <div class="invalid-feedback">{{ $errors->first("model.code") }}</div>
  @else
    <div class="invalid-feedback">Invalid!</div>
  @endif
</div>


<div class="form-group">
  <label for="value-field">VALOR</label>


  @if($errors->has("model.value"))
    <div class="invalid-feedback">{{ $errors->first("model.value") }}</div>
  @else
    <div class="invalid-feedback">Invalid!</div>
  @endif
</div>


<div class="form-group">
  <label for="rich_text-field">TEXTO ENRIQUECIDO</label>


  @if($errors->has("model.rich_text"))
    <div class="invalid-feedback">{{ $errors->first("model.rich_text") }}</div>
  @else
    <div class="invalid-feedback">Invalid!</div>
  @endif
</div>






<div class="form-group">
  <label for="setting_group_id-field">AJUSTES GRUPOS</label>

  <select class="form-control
  @if($errors->any()) @if($errors->has("model.setting_group_id")) is-invalid @else is-valid @endif @endif
  " id="setting_group_id-field" name="model[setting_group_id]">
    <option value=""></option>
  @foreach( $lists["SettingGroup"] as $list_key => $list_item )
    <option value="{{ $list_key }}"
      @if($errors->any())
        @if( old('setting_group_id') == $list_key ) selected='selected' @endif
      @else
        @if( isset($setting) && $setting->setting_group_id==$list_key )  selected='selected' @endif
      @endif
   >{{ $list_item }}</option>
  @endforeach
  </select>
  @if($errors->has("model.setting_group_id"))
    <div class="invalid-feedback">{{ $errors->first("model.setting_group_id") }}</div>
  @else
    <div class="invalid-feedback">Invalid!</div>
  @endif
</div>




