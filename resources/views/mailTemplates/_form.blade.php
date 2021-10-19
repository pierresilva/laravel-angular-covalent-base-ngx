
<div class="form-group">
  <label for="subject-field">ASUNTO</label>

  <input type="text" class="form-control
  @if($errors->any()) @if($errors->has("model.subject")) is-invalid @else is-valid @endif @endif;
  " id="subject-field" name="model[subject]" value="
@if(isset($mailTemplate))
@if($errors->any()){{ old('model.subject') }}@else{{ $mailTemplate->subject ?? '' }}@endif
@endif" required>

  @if($errors->has("model.subject"))
    <div class="invalid-feedback">{{ $errors->first("model.subject") }}</div>
  @else
    <div class="invalid-feedback">Invalid!</div>
  @endif
</div>


<div class="form-group">
  <label for="mailable-field">CLASE</label>

  <input type="text" class="form-control
  @if($errors->any()) @if($errors->has("model.mailable")) is-invalid @else is-valid @endif @endif;
  " id="mailable-field" name="model[mailable]" value="
@if(isset($mailTemplate))
@if($errors->any()){{ old('model.mailable') }}@else{{ $mailTemplate->mailable ?? '' }}@endif
@endif" required>

  @if($errors->has("model.mailable"))
    <div class="invalid-feedback">{{ $errors->first("model.mailable") }}</div>
  @else
    <div class="invalid-feedback">Invalid!</div>
  @endif
</div>


<div class="form-group">
  <label for="html_template-field">HTML</label>


  @if($errors->has("model.html_template"))
    <div class="invalid-feedback">{{ $errors->first("model.html_template") }}</div>
  @else
    <div class="invalid-feedback">Invalid!</div>
  @endif
</div>


<div class="form-group">
  <label for="text_template-field">TEXTO</label>

  <textarea class="form-control
  @if($errors->any()) @if($errors->has("model.text_template")) is-invalid @else is-valid @endif @endif;
  " id="text_template-field" name="model[text_template]" rows="3" >
@if(isset($mailTemplate))
@if($errors->any()){{ old('model.text_template') }}@else{{ $mailTemplate->text_template ?? '' }}@endif
@endif</textarea>

  @if($errors->has("model.text_template"))
    <div class="invalid-feedback">{{ $errors->first("model.text_template") }}</div>
  @else
    <div class="invalid-feedback">Invalid!</div>
  @endif
</div>








