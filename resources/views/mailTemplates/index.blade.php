@extends('layouts.de_app')

@section('content')
  <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-12">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/" class="d-inline-flex"><i class="material-icons mr-1">home</i> Home</a></li>

                  @if ( $query_params = Request::input('q') )

                      <li class="breadcrumb-item active"><a href="{{ route('mailTemplates.index') }}">{{ $model_title_list['mailTemplates'] }}</a></li>
                      <li class="breadcrumb-item active">condition(
                      @foreach( $query_params as $key => $value )
                          @if (!$loop->first) / @endif {{ $key }} : {{ $value }}
                      @endforeach
                      )</li>
                  @else
                      <li class="breadcrumb-item active">{{ $model_title_list['mailTemplates'] }}</li>
                  @endif

                </ol>
              </nav>
              <div class="card">
                  <div class="card-body">
                      <h1 class="d-flex mb-3">
                          <i class="material-icons align-self-center mr-1">view_headline</i>
                          <span class="d-inline-block">{{ $model_title_list['mailTemplates'] }}</span>
                          <a class="btn btn-success d-inline-flex ml-auto" href="{{ route('mailTemplates.create') }}"><i class="material-icons align-self-center mr-1">add_circle</i><span class="align-self-center">Create</span></a>
                      </h1>

                      <p><button class="btn btn-primary btn-sm" type="button" data-toggle="collapse" data-target="#search-area" aria-expanded="false" aria-controls="search-area">Search</button></p>
                      <div class="collapse mb-4" id="search-area">
                        <div class="card card-body">

                          <form id="search" action="{{ route('mailTemplates.index') }}" accept-charset="UTF-8" method="get">
                            <input type="hidden" name="q[s]" value="{{ @(Request::input('q')['s']) ?: '' }}" />
                            <div class="form-group row">
                              <label for="q_id_eq" class="col-sm-2 col-form-label col-form-label-sm">ID</label>
                              <div class="col-sm-10">
                                <input class="form-control form-control-sm" id="q_id_eq" name="q[id:eq]" type="search" value="{{ @(Request::input('q.id:eq')) }}">
                              </div>
                            </div>

                                                                                                                <div class="form-group row">
                              <label for="q_subject_cont" class="col-sm-2 col-form-label col-form-label-sm">ASUNTO</label>
                              <div class="col-sm-10">
                                <input class="form-control form-control-sm" id="q_subject_cont" name="q[subject:cont]" type="search" value="{{ @(Request::input('q.subject:cont')) }}">
                              </div>
                            </div>
                                                                                                                                                                        <div class="form-group row">
                              <label for="q_mailable_cont" class="col-sm-2 col-form-label col-form-label-sm">CLASE</label>
                              <div class="col-sm-10">
                                <input class="form-control form-control-sm" id="q_mailable_cont" name="q[mailable:cont]" type="search" value="{{ @(Request::input('q.mailable:cont')) }}">
                              </div>
                            </div>
                                                                                                                                                                        <div class="form-group row">
                              <label for="q_html_template_cont" class="col-sm-2 col-form-label col-form-label-sm">HTML</label>
                              <div class="col-sm-10">
                                <input class="form-control form-control-sm" id="q_html_template_cont" name="q[html_template:cont]" type="search" value="{{ @(Request::input('q.html_template:cont')) }}">
                              </div>
                            </div>
                                                                                                                                                                        <div class="form-group row">
                              <label for="q_text_template_cont" class="col-sm-2 col-form-label col-form-label-sm">TEXTO</label>
                              <div class="col-sm-10">
                                <input class="form-control form-control-sm" id="q_text_template_cont" name="q[text_template:cont]" type="search" value="{{ @(Request::input('q.text_template:cont')) }}">
                              </div>
                            </div>
                                                                                    
                                                                                                                <div class="form-group row">
                              <label for="q_mails_id_eq" class="col-sm-2 col-form-label col-form-label-sm">CORREOS<br>hasMany</label>
                              <div class="col-sm-10">
                                {{--<input class="form-control form-control-sm" id="q_mails_id_eq" name="q[mails.id:eq]" type="search" value="{{ @(Request::input('q.mails.id:eq')) }}">--}}
                                <select class="form-control"
                                    id="q_mails_id_eq"
                                    name="q[mails.id:eq]">
                                <option value=""></option>
                                @foreach( $lists["Mail"] as $list_key => $list_item )
                                    <option value="{{ $list_key }}"
                                    @if( $list_key == @(Request::input('q.mails.id:eq')) )  selected='selected' @endif
                                    >{{ $list_item }}</option>
                                @endforeach
                                </select>
                              </div>
                            </div>
                                                                                    
                            <div class="form-group row mb-0">
                                <div class="col-sm-10 offset-sm-2">
                                    <input type="submit" name="commit" value="Search" class="btn btn-primary btn-sm" />
                                </div>
                            </div>
                          </form>

                        </div>
                      </div>

                      @include('mailTemplates._table')
                  </div>
              </div>
          </div>
      </div>
  </div>
@endsection
