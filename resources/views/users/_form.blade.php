
<div class="form-group">
  <label for="name-field">NOMBRE</label>

  <input type="text" class="form-control
  @if($errors->any()) @if($errors->has("model.name")) is-invalid @else is-valid @endif @endif;
  " id="name-field" name="model[name]" value="
@if(isset($user))
@if($errors->any()){{ old('model.name') }}@else{{ $user->name ?? '' }}@endif
@endif" required>

  @if($errors->has("model.name"))
    <div class="invalid-feedback">{{ $errors->first("model.name") }}</div>
  @else
    <div class="invalid-feedback">Invalid!</div>
  @endif
</div>


<div class="form-group">
  <label for="email-field">EMAIL</label>

  <input type="text" class="form-control
  @if($errors->any()) @if($errors->has("model.email")) is-invalid @else is-valid @endif @endif;
  " id="email-field" name="model[email]" value="
@if(isset($user))
@if($errors->any()){{ old('model.email') }}@else{{ $user->email ?? '' }}@endif
@endif" required>

  @if($errors->has("model.email"))
    <div class="invalid-feedback">{{ $errors->first("model.email") }}</div>
  @else
    <div class="invalid-feedback">Invalid!</div>
  @endif
</div>


<div class="form-group">
  <label for="password-field">CONTRASEÑA</label>

  <input type="text" class="form-control
  @if($errors->any()) @if($errors->has("model.password")) is-invalid @else is-valid @endif @endif;
  " id="password-field" name="model[password]" value="
@if(isset($user))
@if($errors->any()){{ old('model.password') }}@else{{ $user->password ?? '' }}@endif
@endif" required>

  @if($errors->has("model.password"))
    <div class="invalid-feedback">{{ $errors->first("model.password") }}</div>
  @else
    <div class="invalid-feedback">Invalid!</div>
  @endif
</div>


<div class="form-group">
  <label for="first_name-field">NOMBRE</label>

  <input type="text" class="form-control
  @if($errors->any()) @if($errors->has("model.first_name")) is-invalid @else is-valid @endif @endif;
  " id="first_name-field" name="model[first_name]" value="
@if(isset($user))
@if($errors->any()){{ old('model.first_name') }}@else{{ $user->first_name ?? '' }}@endif
@endif" >

  @if($errors->has("model.first_name"))
    <div class="invalid-feedback">{{ $errors->first("model.first_name") }}</div>
  @else
    <div class="invalid-feedback">Invalid!</div>
  @endif
</div>


<div class="form-group">
  <label for="last_name-field">APELLIDOS</label>

  <input type="text" class="form-control
  @if($errors->any()) @if($errors->has("model.last_name")) is-invalid @else is-valid @endif @endif;
  " id="last_name-field" name="model[last_name]" value="
@if(isset($user))
@if($errors->any()){{ old('model.last_name') }}@else{{ $user->last_name ?? '' }}@endif
@endif" >

  @if($errors->has("model.last_name"))
    <div class="invalid-feedback">{{ $errors->first("model.last_name") }}</div>
  @else
    <div class="invalid-feedback">Invalid!</div>
  @endif
</div>


<div class="form-group">
  <label for="accept_terms_condition-field"></label>


  @if($errors->has("model.accept_terms_condition"))
    <div class="invalid-feedback">{{ $errors->first("model.accept_terms_condition") }}</div>
  @else
    <div class="invalid-feedback">Invalid!</div>
  @endif
</div>






<div class="form-group">
  <label for="syst_position_id-field">CARGOS</label>

  <select class="form-control
  @if($errors->any()) @if($errors->has("model.syst_position_id")) is-invalid @else is-valid @endif @endif
  " id="syst_position_id-field" name="model[syst_position_id]">
    <option value=""></option>
  @foreach( $lists["SystPosition"] as $list_key => $list_item )
    <option value="{{ $list_key }}"
      @if($errors->any())
        @if( old('syst_position_id') == $list_key ) selected='selected' @endif
      @else
        @if( isset($user) && $user->syst_position_id==$list_key )  selected='selected' @endif
      @endif
   >{{ $list_item }}</option>
  @endforeach
  </select>
  @if($errors->has("model.syst_position_id"))
    <div class="invalid-feedback">{{ $errors->first("model.syst_position_id") }}</div>
  @else
    <div class="invalid-feedback">Invalid!</div>
  @endif
</div>





<div class="form-group manytomany">
    <label for="pivotsuserCheckbox">USUARIOS ROLES</label>
    <div class="form-check form-check-inline flex-wrap">
        @foreach($lists['UserRole'] as $list_key => $list_item)
        <div class="form-group mb-1">
          <input name="pivots[user_role][{{ $list_key }}][id]" type="checkbox" id="pivotsUserRoleCheckbox{{ $list_key }}" value="{{ $list_key }}" class="form-check-input manytomany-trigger
              @if($errors->has('pivots.user_role.'.$list_key.'.*')) is-invalid @endif
              "
              @if( $errors->any() && old('pivots.user_role.'.$list_key.'.id')) checked
              @elseif( !$errors->any() && isset($user) && $user->userRoles->find($list_key) ) checked
              @endif
          ><label class="form-check-label mr-2" for="pivotsUserRoleCheckbox{{ $list_key }}">{{ $list_item }}</label>
        </div>
        @endforeach
    </div>
    @if ($errors->has('pivots.user.*.*'))
    <div><span class="text-danger">There were some problems with your pivot input.</span></div>
    @endif

    <!-- manytomany Modal -->
    <div class="modal fade manytomany-modal needs-validation-with-save" id="userRoleModal" tabindex="-1" role="dialog" aria-labelledby="userRoleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">UserRole Option</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary save">Save changes</button>
          </div>
        </div>
      </div>
    </div>

    @if( old('pivots.user_role') )
        @foreach( old('pivots.user_role') as $user_role_id => $user_role )
            @foreach( $user_role as $pivot_key => $pivot_value )
                @if( $loop->index > 0 )
                    <input type="hidden" name="pivots[user_role][{{ $user_role_id }}][{{$pivot_key}}]" value="{{$pivot_value}}" parent_name="pivots[user_role][{{ $user_role_id }}]">
                @endif
            @endforeach
        @endforeach
    @elseif( isset($user) )
        @foreach( $user->userRoles as $user_role )
            @foreach( $user_role->pivot->toArray() as $pivot_key => $pivot_value )
                @if( $loop->index > 1 && $pivot_key !== 'created_at' && $pivot_key !== 'updated_at')
                    <input type="hidden" name="pivots[user_role][{{ $user_role->id }}][{{$pivot_key}}]" value="{{$pivot_value}}" parent_name="pivots[user_role][{{ $user_role->id }}]">
                @endif
            @endforeach
        @endforeach
    @endif
    @if($errors->has('pivots.user_role.*.*'))
        @foreach($errors->get('pivots.user_role.*') as $error_key => $error_value)
                    <input type="hidden" name="errors.{{$error_key}}" value="{{$error_value[0]}}" disabled="disabled">
        @endforeach
    @endif

</div>

