<div class="row">
    <div class="col-md-12">

        @if($userProfiles->count())

            <table class="table table-sm table-striped sp-omit">
              <thead>
                <tr>
                  <th scope="col"><div class="d-flex">
                    @if( method_exists($userProfiles, 'appends') )
                      <a href="javascript:sortByColumn('id')">ID</a>
                      @if( Request::input('q.s') == 'id_asc' )<i class="material-icons">arrow_drop_up</i>
                      @elseif( Request::input('q.s') == 'id_desc' )<i class="material-icons">arrow_drop_down</i> @endif
                    @else
                      ID
                    @endif
                  </div></th>
                  <th scope="col"><div class="d-flex">
                    @if( method_exists($userProfiles, 'appends') )
                      <a href="javascript:sortByColumn('name')">NOMBRE</a>
                      @if( Request::input('q.s') == 'name_asc' )<i class="material-icons">arrow_drop_up</i>
                      @elseif( Request::input('q.s') == 'name_desc' )<i class="material-icons">arrow_drop_down</i> @endif
                    @else
                      NOMBRE                    @endif
                  </div></th>
                  <th scope="col"><div class="d-flex">
                    @if( method_exists($userProfiles, 'appends') )
                      <a href="javascript:sortByColumn('address')">DORECCIÓN</a>
                      @if( Request::input('q.s') == 'address_asc' )<i class="material-icons">arrow_drop_up</i>
                      @elseif( Request::input('q.s') == 'address_desc' )<i class="material-icons">arrow_drop_down</i> @endif
                    @else
                      DORECCIÓN                    @endif
                  </div></th>
                  <th scope="col"><div class="d-flex">
                    @if( method_exists($userProfiles, 'appends') )
                      <a href="javascript:sortByColumn('phone')">TELÉFONO</a>
                      @if( Request::input('q.s') == 'phone_asc' )<i class="material-icons">arrow_drop_up</i>
                      @elseif( Request::input('q.s') == 'phone_desc' )<i class="material-icons">arrow_drop_down</i> @endif
                    @else
                      TELÉFONO                    @endif
                  </div></th>
                  <th scope="col"><div class="d-flex">
                    @if( method_exists($userProfiles, 'appends') )
                      <a href="javascript:sortByColumn('avatar')">AVATAR</a>
                      @if( Request::input('q.s') == 'avatar_asc' )<i class="material-icons">arrow_drop_up</i>
                      @elseif( Request::input('q.s') == 'avatar_desc' )<i class="material-icons">arrow_drop_down</i> @endif
                    @else
                      AVATAR                    @endif
                  </div></th>

                  <th scope="col">USUARIOS</th>
                  <th scope="col">CIUDADES</th>
                  <th scope="col">DEPARTAMENTOS</th>
                  <th scope="col">PAISES</th>



                  <th class="text-right" scope="col">OPTIONS</th>
                </tr>
              </thead>
              <tbody>
                @foreach($userProfiles as $userProfile)
                    <tr>
                      <td scope="row"><a href="{{ route('userProfiles.show', $userProfile->id) }}">{{$userProfile->id}}</a></td>
                      <td>{{$userProfile->name}}</td>
                      <td>{{$userProfile->address}}</td>
                      <td>{{$userProfile->phone}}</td>
                      <td>{{$userProfile->avatar}}</td>

                      <td>@if($userProfile->user)<a href="{{ route('users.show', $userProfile->user->id) }}">{{ $userProfile->user->name }}</a>@else - @endif</td>
                      <td>@if($userProfile->systCity)<a href="{{ route('systCities.show', $userProfile->systCity->id) }}">{{ $userProfile->systCity->name }}</a>@else - @endif</td>
                      <td>@if($userProfile->systRegion)<a href="{{ route('systRegions.show', $userProfile->systRegion->id) }}">{{ $userProfile->systRegion->name }}</a>@else - @endif</td>
                      <td>@if($userProfile->systCountry)<a href="{{ route('systCountries.show', $userProfile->systCountry->id) }}">{{ $userProfile->systCountry->name }}</a>@else - @endif</td>



                      <td class="text-right">
                        <div class="btn-group" role="group">
                            <a class="btn btn-sm btn-primary" href="{{ route('userProfiles.duplicate', $userProfile->id) }}" data-toggle="tooltip" data-placement="top" title="Duplicate"><i class="material-icons d-block">add_to_photos</i></a>
                            <a class="btn btn-sm btn-warning" href="{{ route('userProfiles.edit', $userProfile->id) }}" data-toggle="tooltip" data-placement="top" title="Edit"><i class="material-icons d-block">edit</i></a>
                            <form method="POST" action="{{ route('userProfiles.destroy', $userProfile->id) }}" accept-charset="UTF-8" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Delete"><i class="material-icons d-block">delete</i></button>
                            </form>
                        </div>
                      </td>
                    </tr>
                @endforeach
              </tbody>
            </table>
            @if( method_exists($userProfiles, 'appends') )
              {!! $userProfiles->appends(Request::except('page'))->render() !!}
            @endif
        @else
            <h3 class="text-center alert alert-info">Empty!</h3>
        @endif
    </div>
</div>