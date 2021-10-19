@extends('layouts.de_app')

@section('content')
  <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-12">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/" class="d-inline-flex"><i class="material-icons mr-1">home</i> Home</a></li>
                  <li class="breadcrumb-item"><a href="{{ route('mailTemplates.index') }}">{{ $model_title_list['mailTemplates'] }}</a></li>
                  <li class="breadcrumb-item active">#{{ $mailTemplate->id }}</li>
                </ol>
              </nav>
              <div class="card">
                  <div class="card-body">
                      <h1 class="d-flex mb-3">
                          <i class="material-icons align-self-center mr-1">subject</i>
                          <span class="d-inline-block">{{ $model_title_list['mailTemplates'] }} / Show #{{$mailTemplate->id}}</span>
                          <form class="ml-auto" method="POST" action="{{ route('mailTemplates.destroy', $mailTemplate->id) }}" accept-charset="UTF-8" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
                              {{ method_field('DELETE') }}
                              {{ csrf_field() }}
                              <div class="btn-group" role="group">
                                  <a class="btn btn-sm btn-primary" href="{{ route('mailTemplates.duplicate', $mailTemplate->id) }}" data-toggle="tooltip" data-placement="top" title="Duplicate"><i class="material-icons d-block">add_to_photos</i></a>
                                  <a class="btn btn-sm btn-warning" href="{{ route('mailTemplates.edit', $mailTemplate->id) }}" data-toggle="tooltip" data-placement="top" title="Edit"><i class="material-icons d-block">edit</i></a>
                                  <button type="submit" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Delete"><i class="material-icons d-block">delete</i></button>
                              </div>
                          </form>
                      </h1> 

                      <ul class="list-group list-group-flush mt-4">
                        <li class="list-group-item d-inline-flex flex-wrap"><div><strong>ID ： </strong></div><div>{{$mailTemplate->id}}</div></li>

                                                                              <li class="list-group-item d-inline-flex flex-wrap"><div><strong>ASUNTO : </strong></div><div>{{ $mailTemplate->subject }}</div></li>
                                                                                                                  <li class="list-group-item d-inline-flex flex-wrap"><div><strong>CLASE : </strong></div><div>{{ $mailTemplate->mailable }}</div></li>
                                                                                                                  <li class="list-group-item d-inline-flex flex-wrap"><div><strong>HTML : </strong></div><div>{{ $mailTemplate->html_template }}</div></li>
                                                                                                                  <li class="list-group-item d-inline-flex flex-wrap"><div><strong>TEXTO : </strong></div><div>{{ $mailTemplate->text_template }}</div></li>
                                                      
                                                      
                                                            <li class="list-group-item"><p><strong>CORREOS : </strong></p><div>
                          @include('mails._table', ['mails' => $mailTemplate->mails])
                        </div></li>
                                    
                                                      
                      </ul>
                      <div class="d-flex justify-content-end mt-3">
                          <a class="btn btn-secondary d-inline-flex mr-3" href="{{ route('mailTemplates.index') }}"><i class="material-icons">fast_rewind</i> Back</a>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
@endsection