
<div class="form-group">
  <label for="name-field">NOMBRE</label>

  <input type="text" class="form-control
  @if($errors->any()) @if($errors->has("model.name")) is-invalid @else is-valid @endif @endif;
  " id="name-field" name="model[name]" value="
@if(isset($file))
@if($errors->any()){{ old('model.name') }}@else{{ $file->name ?? '' }}@endif
@endif" required>

  @if($errors->has("model.name"))
    <div class="invalid-feedback">{{ $errors->first("model.name") }}</div>
  @else
    <div class="invalid-feedback">Invalid!</div>
  @endif
</div>


<div class="form-group">
  <label for="file-field">ARCHIVO</label>

  <input type="text" class="form-control
  @if($errors->any()) @if($errors->has("model.file")) is-invalid @else is-valid @endif @endif;
  " id="file-field" name="model[file]" value="
@if(isset($file))
@if($errors->any()){{ old('model.file') }}@else{{ $file->file ?? '' }}@endif
@endif" required>

  @if($errors->has("model.file"))
    <div class="invalid-feedback">{{ $errors->first("model.file") }}</div>
  @else
    <div class="invalid-feedback">Invalid!</div>
  @endif
</div>


<div class="form-group">
  <label for="extension-field">EXTENSION</label>

  <input type="text" class="form-control
  @if($errors->any()) @if($errors->has("model.extension")) is-invalid @else is-valid @endif @endif;
  " id="extension-field" name="model[extension]" value="
@if(isset($file))
@if($errors->any()){{ old('model.extension') }}@else{{ $file->extension ?? '' }}@endif
@endif" >

  @if($errors->has("model.extension"))
    <div class="invalid-feedback">{{ $errors->first("model.extension") }}</div>
  @else
    <div class="invalid-feedback">Invalid!</div>
  @endif
</div>


<div class="form-group">
  <label for="mime-field">MIME</label>

  <input type="text" class="form-control
  @if($errors->any()) @if($errors->has("model.mime")) is-invalid @else is-valid @endif @endif;
  " id="mime-field" name="model[mime]" value="
@if(isset($file))
@if($errors->any()){{ old('model.mime') }}@else{{ $file->mime ?? '' }}@endif
@endif" >

  @if($errors->has("model.mime"))
    <div class="invalid-feedback">{{ $errors->first("model.mime") }}</div>
  @else
    <div class="invalid-feedback">Invalid!</div>
  @endif
</div>


<div class="form-group">
  <label for="url-field">URL</label>

  <input type="text" class="form-control
  @if($errors->any()) @if($errors->has("model.url")) is-invalid @else is-valid @endif @endif;
  " id="url-field" name="model[url]" value="
@if(isset($file))
@if($errors->any()){{ old('model.url') }}@else{{ $file->url ?? '' }}@endif
@endif" >

  @if($errors->has("model.url"))
    <div class="invalid-feedback">{{ $errors->first("model.url") }}</div>
  @else
    <div class="invalid-feedback">Invalid!</div>
  @endif
</div>


<div class="form-group">
  <label for="fileable_id-field">ARCHIVABLE ID</label>


  @if($errors->has("model.fileable_id"))
    <div class="invalid-feedback">{{ $errors->first("model.fileable_id") }}</div>
  @else
    <div class="invalid-feedback">Invalid!</div>
  @endif
</div>


<div class="form-group">
  <label for="fileable_type-field">ARCHIVABLE TIPO</label>

  <input type="text" class="form-control
  @if($errors->any()) @if($errors->has("model.fileable_type")) is-invalid @else is-valid @endif @endif;
  " id="fileable_type-field" name="model[fileable_type]" value="
@if(isset($file))
@if($errors->any()){{ old('model.fileable_type') }}@else{{ $file->fileable_type ?? '' }}@endif
@endif" >

  @if($errors->has("model.fileable_type"))
    <div class="invalid-feedback">{{ $errors->first("model.fileable_type") }}</div>
  @else
    <div class="invalid-feedback">Invalid!</div>
  @endif
</div>








