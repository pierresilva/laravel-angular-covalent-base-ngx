<div class="row">
    <div class="col-md-12">

        @if($mailTemplates->count())

            <table class="table table-sm table-striped sp-omit">
              <thead>
                <tr>
                  <th scope="col"><div class="d-flex">
                    @if( method_exists($mailTemplates, 'appends') )
                      <a href="javascript:sortByColumn('id')">ID</a>
                      @if( Request::input('q.s') == 'id_asc' )<i class="material-icons">arrow_drop_up</i>
                      @elseif( Request::input('q.s') == 'id_desc' )<i class="material-icons">arrow_drop_down</i> @endif
                    @else
                      ID
                    @endif
                  </div></th>
                  <th scope="col"><div class="d-flex">
                    @if( method_exists($mailTemplates, 'appends') )
                      <a href="javascript:sortByColumn('subject')">ASUNTO</a>
                      @if( Request::input('q.s') == 'subject_asc' )<i class="material-icons">arrow_drop_up</i>
                      @elseif( Request::input('q.s') == 'subject_desc' )<i class="material-icons">arrow_drop_down</i> @endif
                    @else
                      ASUNTO                    @endif
                  </div></th>
                  <th scope="col"><div class="d-flex">
                    @if( method_exists($mailTemplates, 'appends') )
                      <a href="javascript:sortByColumn('mailable')">CLASE</a>
                      @if( Request::input('q.s') == 'mailable_asc' )<i class="material-icons">arrow_drop_up</i>
                      @elseif( Request::input('q.s') == 'mailable_desc' )<i class="material-icons">arrow_drop_down</i> @endif
                    @else
                      CLASE                    @endif
                  </div></th>
                  <th scope="col"><div class="d-flex">
                    @if( method_exists($mailTemplates, 'appends') )
                      <a href="javascript:sortByColumn('html_template')">HTML</a>
                      @if( Request::input('q.s') == 'html_template_asc' )<i class="material-icons">arrow_drop_up</i>
                      @elseif( Request::input('q.s') == 'html_template_desc' )<i class="material-icons">arrow_drop_down</i> @endif
                    @else
                      HTML                    @endif
                  </div></th>
                  <th scope="col"><div class="d-flex">
                    @if( method_exists($mailTemplates, 'appends') )
                      <a href="javascript:sortByColumn('text_template')">TEXTO</a>
                      @if( Request::input('q.s') == 'text_template_asc' )<i class="material-icons">arrow_drop_up</i>
                      @elseif( Request::input('q.s') == 'text_template_desc' )<i class="material-icons">arrow_drop_down</i> @endif
                    @else
                      TEXTO                    @endif
                  </div></th>


                  <th scope="col">CORREOS</th>


                  <th class="text-right" scope="col">OPTIONS</th>
                </tr>
              </thead>
              <tbody>
                @foreach($mailTemplates as $mailTemplate)
                    <tr>
                      <td scope="row"><a href="{{ route('mailTemplates.show', $mailTemplate->id) }}">{{$mailTemplate->id}}</a></td>
                      <td>{{$mailTemplate->subject}}</td>
                      <td>{{$mailTemplate->mailable}}</td>
                      <td>{{$mailTemplate->html_template}}</td>
                      <td>{{$mailTemplate->text_template}}</td>


                      <td>
                          @foreach($mailTemplate->mails as $mail)
                                        @if (!$loop->first) , @endif
                                        <a href="{{ route('mails.show', $mail->id) }}">{{ $mail->subject }}</a>
                          @endforeach
                      </td>


                      <td class="text-right">
                        <div class="btn-group" role="group">
                            <a class="btn btn-sm btn-primary" href="{{ route('mailTemplates.duplicate', $mailTemplate->id) }}" data-toggle="tooltip" data-placement="top" title="Duplicate"><i class="material-icons d-block">add_to_photos</i></a>
                            <a class="btn btn-sm btn-warning" href="{{ route('mailTemplates.edit', $mailTemplate->id) }}" data-toggle="tooltip" data-placement="top" title="Edit"><i class="material-icons d-block">edit</i></a>
                            <form method="POST" action="{{ route('mailTemplates.destroy', $mailTemplate->id) }}" accept-charset="UTF-8" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
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
            @if( method_exists($mailTemplates, 'appends') )
              {!! $mailTemplates->appends(Request::except('page'))->render() !!}
            @endif
        @else
            <h3 class="text-center alert alert-info">Empty!</h3>
        @endif
    </div>
</div>