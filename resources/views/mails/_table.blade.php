<div class="row">
    <div class="col-md-12">

        @if($mails->count())

            <table class="table table-sm table-striped sp-omit">
              <thead>
                <tr>
                  <th scope="col"><div class="d-flex">
                    @if( method_exists($mails, 'appends') )
                      <a href="javascript:sortByColumn('id')">ID</a>
                      @if( Request::input('q.s') == 'id_asc' )<i class="material-icons">arrow_drop_up</i>
                      @elseif( Request::input('q.s') == 'id_desc' )<i class="material-icons">arrow_drop_down</i> @endif
                    @else
                      ID
                    @endif
                  </div></th>
                  <th scope="col"><div class="d-flex">
                    @if( method_exists($mails, 'appends') )
                      <a href="javascript:sortByColumn('subject')">ASUNTO</a>
                      @if( Request::input('q.s') == 'subject_asc' )<i class="material-icons">arrow_drop_up</i>
                      @elseif( Request::input('q.s') == 'subject_desc' )<i class="material-icons">arrow_drop_down</i> @endif
                    @else
                      ASUNTO                    @endif
                  </div></th>
                  <th scope="col"><div class="d-flex">
                    @if( method_exists($mails, 'appends') )
                      <a href="javascript:sortByColumn('receiver')">PARA</a>
                      @if( Request::input('q.s') == 'receiver_asc' )<i class="material-icons">arrow_drop_up</i>
                      @elseif( Request::input('q.s') == 'receiver_desc' )<i class="material-icons">arrow_drop_down</i> @endif
                    @else
                      PARA                    @endif
                  </div></th>
                  <th scope="col"><div class="d-flex">
                    @if( method_exists($mails, 'appends') )
                      <a href="javascript:sortByColumn('html')">HTML</a>
                      @if( Request::input('q.s') == 'html_asc' )<i class="material-icons">arrow_drop_up</i>
                      @elseif( Request::input('q.s') == 'html_desc' )<i class="material-icons">arrow_drop_down</i> @endif
                    @else
                      HTML                    @endif
                  </div></th>
                  <th scope="col"><div class="d-flex">
                    @if( method_exists($mails, 'appends') )
                      <a href="javascript:sortByColumn('text')">TEXTO</a>
                      @if( Request::input('q.s') == 'text_asc' )<i class="material-icons">arrow_drop_up</i>
                      @elseif( Request::input('q.s') == 'text_desc' )<i class="material-icons">arrow_drop_down</i> @endif
                    @else
                      TEXTO                    @endif
                  </div></th>

                  <th scope="col">CORREOS PLANTILLAS</th>



                  <th class="text-right" scope="col">OPTIONS</th>
                </tr>
              </thead>
              <tbody>
                @foreach($mails as $mail)
                    <tr>
                      <td scope="row"><a href="{{ route('mails.show', $mail->id) }}">{{$mail->id}}</a></td>
                      <td>{{$mail->subject}}</td>
                      <td>{{$mail->receiver}}</td>
                      <td>{{$mail->html}}</td>
                      <td>{{$mail->text}}</td>

                      <td>@if($mail->mailTemplate)<a href="{{ route('mailTemplates.show', $mail->mailTemplate->id) }}">{{ $mail->mailTemplate->subject }}</a>@else - @endif</td>



                      <td class="text-right">
                        <div class="btn-group" role="group">
                            <a class="btn btn-sm btn-primary" href="{{ route('mails.duplicate', $mail->id) }}" data-toggle="tooltip" data-placement="top" title="Duplicate"><i class="material-icons d-block">add_to_photos</i></a>
                            <a class="btn btn-sm btn-warning" href="{{ route('mails.edit', $mail->id) }}" data-toggle="tooltip" data-placement="top" title="Edit"><i class="material-icons d-block">edit</i></a>
                            <form method="POST" action="{{ route('mails.destroy', $mail->id) }}" accept-charset="UTF-8" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
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
            @if( method_exists($mails, 'appends') )
              {!! $mails->appends(Request::except('page'))->render() !!}
            @endif
        @else
            <h3 class="text-center alert alert-info">Empty!</h3>
        @endif
    </div>
</div>