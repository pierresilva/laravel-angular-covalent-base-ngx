
<div class="form-group">
  <label for="name-field">NOMBRE</label>

  <input type="text" class="form-control
  @if($errors->any()) @if($errors->has("model.name")) is-invalid @else is-valid @endif @endif;
  " id="name-field" name="model[name]" value="
@if(isset($userRole))
@if($errors->any()){{ old('model.name') }}@else{{ $userRole->name ?? '' }}@endif
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
@if(isset($userRole))
@if($errors->any()){{ old('model.code') }}@else{{ $userRole->code ?? '' }}@endif
@endif" required>

  @if($errors->has("model.code"))
    <div class="invalid-feedback">{{ $errors->first("model.code") }}</div>
  @else
    <div class="invalid-feedback">Invalid!</div>
  @endif
</div>









<div class="form-group manytomany">
    <label for="pivotsuserRoleCheckbox">USUARIOS</label>
    <div class="form-check form-check-inline flex-wrap">
        @foreach($lists['User'] as $list_key => $list_item)
        <div class="form-group mb-1">
          <input name="pivots[user][{{ $list_key }}][id]" type="checkbox" id="pivotsUserCheckbox{{ $list_key }}" value="{{ $list_key }}" class="form-check-input manytomany-trigger
              @if($errors->has('pivots.user.'.$list_key.'.*')) is-invalid @endif
              "
              @if( $errors->any() && old('pivots.user.'.$list_key.'.id')) checked
              @elseif( !$errors->any() && isset($userRole) && $userRole->users->find($list_key) ) checked
              @endif
          ><label class="form-check-label mr-2" for="pivotsUserCheckbox{{ $list_key }}">{{ $list_item }}</label>
        </div>
        @endforeach
    </div>
    @if ($errors->has('pivots.user_role.*.*'))
    <div><span class="text-danger">There were some problems with your pivot input.</span></div>
    @endif

    <!-- manytomany Modal -->
    <div class="modal fade manytomany-modal needs-validation-with-save" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">User Option</h4>
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

    @if( old('pivots.user') )
        @foreach( old('pivots.user') as $user_id => $user )
            @foreach( $user as $pivot_key => $pivot_value )
                @if( $loop->index > 0 )
                    <input type="hidden" name="pivots[user][{{ $user_id }}][{{$pivot_key}}]" value="{{$pivot_value}}" parent_name="pivots[user][{{ $user_id }}]">
                @endif
            @endforeach
        @endforeach
    @elseif( isset($userRole) )
        @foreach( $userRole->users as $user )
            @foreach( $user->pivot->toArray() as $pivot_key => $pivot_value )
                @if( $loop->index > 1 && $pivot_key !== 'created_at' && $pivot_key !== 'updated_at')
                    <input type="hidden" name="pivots[user][{{ $user->id }}][{{$pivot_key}}]" value="{{$pivot_value}}" parent_name="pivots[user][{{ $user->id }}]">
                @endif
            @endforeach
        @endforeach
    @endif
    @if($errors->has('pivots.user.*.*'))
        @foreach($errors->get('pivots.user.*') as $error_key => $error_value)
                    <input type="hidden" name="errors.{{$error_key}}" value="{{$error_value[0]}}" disabled="disabled">
        @endforeach
    @endif

</div>


<div class="form-group manytomany">
    <label for="pivotsuserRoleCheckbox">USUARIOS PERMISOS</label>
    <div class="form-check form-check-inline flex-wrap">
        @foreach($lists['UserPermission'] as $list_key => $list_item)
        <div class="form-group mb-1">
          <input name="pivots[user_permission][{{ $list_key }}][id]" type="checkbox" id="pivotsUserPermissionCheckbox{{ $list_key }}" value="{{ $list_key }}" class="form-check-input manytomany-trigger
              @if($errors->has('pivots.user_permission.'.$list_key.'.*')) is-invalid @endif
              "
              @if( $errors->any() && old('pivots.user_permission.'.$list_key.'.id')) checked
              @elseif( !$errors->any() && isset($userRole) && $userRole->userPermissions->find($list_key) ) checked
              @endif
          ><label class="form-check-label mr-2" for="pivotsUserPermissionCheckbox{{ $list_key }}">{{ $list_item }}</label>
        </div>
        @endforeach
    </div>
    @if ($errors->has('pivots.user_role.*.*'))
    <div><span class="text-danger">There were some problems with your pivot input.</span></div>
    @endif

    <!-- manytomany Modal -->
    <div class="modal fade manytomany-modal needs-validation-with-save" id="userPermissionModal" tabindex="-1" role="dialog" aria-labelledby="userPermissionModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">UserPermission Option</h4>
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

    @if( old('pivots.user_permission') )
        @foreach( old('pivots.user_permission') as $user_permission_id => $user_permission )
            @foreach( $user_permission as $pivot_key => $pivot_value )
                @if( $loop->index > 0 )
                    <input type="hidden" name="pivots[user_permission][{{ $user_permission_id }}][{{$pivot_key}}]" value="{{$pivot_value}}" parent_name="pivots[user_permission][{{ $user_permission_id }}]">
                @endif
            @endforeach
        @endforeach
    @elseif( isset($userRole) )
        @foreach( $userRole->userPermissions as $user_permission )
            @foreach( $user_permission->pivot->toArray() as $pivot_key => $pivot_value )
                @if( $loop->index > 1 && $pivot_key !== 'created_at' && $pivot_key !== 'updated_at')
                    <input type="hidden" name="pivots[user_permission][{{ $user_permission->id }}][{{$pivot_key}}]" value="{{$pivot_value}}" parent_name="pivots[user_permission][{{ $user_permission->id }}]">
                @endif
            @endforeach
        @endforeach
    @endif
    @if($errors->has('pivots.user_permission.*.*'))
        @foreach($errors->get('pivots.user_permission.*') as $error_key => $error_value)
                    <input type="hidden" name="errors.{{$error_key}}" value="{{$error_value[0]}}" disabled="disabled">
        @endforeach
    @endif

</div>

