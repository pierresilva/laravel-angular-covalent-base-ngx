<div class="row">
    <div class="col-md-12">

        @if($settings->count())

            <table class="table table-sm table-striped sp-omit">
              <thead>
                <tr>
                  <th scope="col"><div class="d-flex">
                    @if( method_exists($settings, 'appends') )
                      <a href="javascript:sortByColumn('id')">ID</a>
                      @if( Request::input('q.s') == 'id_asc' )<i class="material-icons">arrow_drop_up</i>
                      @elseif( Request::input('q.s') == 'id_desc' )<i class="material-icons">arrow_drop_down</i> @endif
                    @else
                      ID
                    @endif
                  </div></th>
                  <th scope="col"><div class="d-flex">
                    @if( method_exists($settings, 'appends') )
                      <a href="javascript:sortByColumn('name')">NOMBRE</a>
                      @if( Request::input('q.s') == 'name_asc' )<i class="material-icons">arrow_drop_up</i>
                      @elseif( Request::input('q.s') == 'name_desc' )<i class="material-icons">arrow_drop_down</i> @endif
                    @else
                      NOMBRE                    @endif
                  </div></th>
                  <th scope="col"><div class="d-flex">
                    @if( method_exists($settings, 'appends') )
                      <a href="javascript:sortByColumn('code')">CÓDIGO</a>
                      @if( Request::input('q.s') == 'code_asc' )<i class="material-icons">arrow_drop_up</i>
                      @elseif( Request::input('q.s') == 'code_desc' )<i class="material-icons">arrow_drop_down</i> @endif
                    @else
                      CÓDIGO                    @endif
                  </div></th>
                  <th scope="col"><div class="d-flex">
                    @if( method_exists($settings, 'appends') )
                      <a href="javascript:sortByColumn('value')">VALOR</a>
                      @if( Request::input('q.s') == 'value_asc' )<i class="material-icons">arrow_drop_up</i>
                      @elseif( Request::input('q.s') == 'value_desc' )<i class="material-icons">arrow_drop_down</i> @endif
                    @else
                      VALOR                    @endif
                  </div></th>
                  <th scope="col"><div class="d-flex">
                    @if( method_exists($settings, 'appends') )
                      <a href="javascript:sortByColumn('rich_text')">TEXTO ENRIQUECIDO</a>
                      @if( Request::input('q.s') == 'rich_text_asc' )<i class="material-icons">arrow_drop_up</i>
                      @elseif( Request::input('q.s') == 'rich_text_desc' )<i class="material-icons">arrow_drop_down</i> @endif
                    @else
                      TEXTO ENRIQUECIDO                    @endif
                  </div></th>

                  <th scope="col">AJUSTES GRUPOS</th>



                  <th class="text-right" scope="col">OPTIONS</th>
                </tr>
              </thead>
              <tbody>
                @foreach($settings as $setting)
                    <tr>
                      <td scope="row"><a href="{{ route('settings.show', $setting->id) }}">{{$setting->id}}</a></td>
                      <td>{{$setting->name}}</td>
                      <td>{{$setting->code}}</td>
                      <td>{{$setting->value}}</td>
                      <td>{{$setting->rich_text}}</td>

                      <td>@if($setting->settingGroup)<a href="{{ route('settingGroups.show', $setting->settingGroup->id) }}">{{ $setting->settingGroup->name }}</a>@else - @endif</td>



                      <td class="text-right">
                        <div class="btn-group" role="group">
                            <a class="btn btn-sm btn-primary" href="{{ route('settings.duplicate', $setting->id) }}" data-toggle="tooltip" data-placement="top" title="Duplicate"><i class="material-icons d-block">add_to_photos</i></a>
                            <a class="btn btn-sm btn-warning" href="{{ route('settings.edit', $setting->id) }}" data-toggle="tooltip" data-placement="top" title="Edit"><i class="material-icons d-block">edit</i></a>
                            <form method="POST" action="{{ route('settings.destroy', $setting->id) }}" accept-charset="UTF-8" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
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
            @if( method_exists($settings, 'appends') )
              {!! $settings->appends(Request::except('page'))->render() !!}
            @endif
        @else
            <h3 class="text-center alert alert-info">Empty!</h3>
        @endif
    </div>
</div>