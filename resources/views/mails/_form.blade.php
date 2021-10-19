
<div class="form-group">
  <label for="subject-field">ASUNTO</label>

  <input type="text" class="form-control
  @if($errors->any()) @if($errors->has("model.subject")) is-invalid @else is-valid @endif @endif;
  " id="subject-field" name="model[subject]" value="
@if(isset($mail))
@if($errors->any()){{ old('model.subject') }}@else{{ $mail->subject ?? '' }}@endif
@endif" required>

  @if($errors->has("model.subject"))
    <div class="invalid-feedback">{{ $errors->first("model.subject") }}</div>
  @else
    <div class="invalid-feedback">Invalid!</div>
  @endif
</div>


<div class="form-group">
  <label for="receiver-field">PARA</label>

  <input type="text" class="form-control
  @if($errors->any()) @if($errors->has("model.receiver")) is-invalid @else is-valid @endif @endif;
  " id="receiver-field" name="model[receiver]" value="
@if(isset($mail))
@if($errors->any()){{ old('model.receiver') }}@else{{ $mail->receiver ?? '' }}@endif
@endif" required>

  @if($errors->has("model.receiver"))
    <div class="invalid-feedback">{{ $errors->first("model.receiver") }}</div>
  @else
    <div class="invalid-feedback">Invalid!</div>
  @endif
</div>


<div class="form-group">
  <label for="html-field">HTML</label>


  @if($errors->has("model.html"))
    <div class="invalid-feedback">{{ $errors->first("model.html") }}</div>
  @else
    <div class="invalid-feedback">Invalid!</div>
  @endif
</div>


<div class="form-group">
  <label for="text-field">TEXTO</label>

  <textarea class="form-control
  @if($errors->any()) @if($errors->has("model.text")) is-invalid @else is-valid @endif @endif;
  " id="text-field" name="model[text]" rows="3" >
@if(isset($mail))
@if($errors->any()){{ old('model.text') }}@else{{ $mail->text ?? '' }}@endif
@endif</textarea>

  @if($errors->has("model.text"))
    <div class="invalid-feedback">{{ $errors->first("model.text") }}</div>
  @else
    <div class="invalid-feedback">Invalid!</div>
  @endif
</div>






<div class="form-group">
  <label for="mail_template_id-field">CORREOS PLANTILLAS</label>

  <select class="form-control
  @if($errors->any()) @if($errors->has("model.mail_template_id")) is-invalid @else is-valid @endif @endif
  " id="mail_template_id-field" name="model[mail_template_id]">
    <option value=""></option>
  @foreach( $lists["MailTemplate"] as $list_key => $list_item )
    <option value="{{ $list_key }}"
      @if($errors->any())
        @if( old('mail_template_id') == $list_key ) selected='selected' @endif
      @else
        @if( isset($mail) && $mail->mail_template_id==$list_key )  selected='selected' @endif
      @endif
   >{{ $list_item }}</option>
  @endforeach
  </select>
  @if($errors->has("model.mail_template_id"))
    <div class="invalid-feedback">{{ $errors->first("model.mail_template_id") }}</div>
  @else
    <div class="invalid-feedback">Invalid!</div>
  @endif
</div>




