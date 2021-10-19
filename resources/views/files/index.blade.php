@extends('layouts.de_app')

@section('content')
  <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-12">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/" class="d-inline-flex"><i class="material-icons mr-1">home</i> Home</a></li>

                  @if ( $query_params = Request::input('q') )

                      <li class="breadcrumb-item active"><a href="{{ route('files.index') }}">{{ $model_title_list['files'] }}</a></li>
                      <li class="breadcrumb-item active">condition(
                      @foreach( $query_params as $key => $value )
                          @if (!$loop->first) / @endif {{ $key }} : {{ $value }}
                      @endforeach
                      )</li>
                  @else
                      <li class="breadcrumb-item active">{{ $model_title_list['files'] }}</li>
                  @endif

                </ol>
              </nav>
              <div class="card">
                  <div class="card-body">
                      <h1 class="d-flex mb-3">
                          <i class="material-icons align-self-center mr-1">view_headline</i>
                          <span class="d-inline-block">{{ $model_title_list['files'] }}</span>
                          <a class="btn btn-success d-inline-flex ml-auto" href="{{ route('files.create') }}"><i class="material-icons align-self-center mr-1">add_circle</i><span class="align-self-center">Create</span></a>
                      </h1>

                      <p><button class="btn btn-primary btn-sm" type="button" data-toggle="collapse" data-target="#search-area" aria-expanded="false" aria-controls="search-area">Search</button></p>
                      <div class="collapse mb-4" id="search-area">
                        <div class="card card-body">

                          <form id="search" action="{{ route('files.index') }}" accept-charset="UTF-8" method="get">
                            <input type="hidden" name="q[s]" value="{{ @(Request::input('q')['s']) ?: '' }}" />
                            <div class="form-group row">
                              <label for="q_id_eq" class="col-sm-2 col-form-label col-form-label-sm">ID</label>
                              <div class="col-sm-10">
                                <input class="form-control form-control-sm" id="q_id_eq" name="q[id:eq]" type="search" value="{{ @(Request::input('q.id:eq')) }}">
                              </div>
                            </div>

                                                                                                                <div class="form-group row">
                              <label for="q_name_cont" class="col-sm-2 col-form-label col-form-label-sm">NOMBRE</label>
                              <div class="col-sm-10">
                                <input class="form-control form-control-sm" id="q_name_cont" name="q[name:cont]" type="search" value="{{ @(Request::input('q.name:cont')) }}">
                              </div>
                            </div>
                                                                                                                                                                        <div class="form-group row">
                              <label for="q_file_cont" class="col-sm-2 col-form-label col-form-label-sm">ARCHIVO</label>
                              <div class="col-sm-10">
                                <input class="form-control form-control-sm" id="q_file_cont" name="q[file:cont]" type="search" value="{{ @(Request::input('q.file:cont')) }}">
                              </div>
                            </div>
                                                                                                                                                                        <div class="form-group row">
                              <label for="q_extension_cont" class="col-sm-2 col-form-label col-form-label-sm">EXTENSION</label>
                              <div class="col-sm-10">
                                <input class="form-control form-control-sm" id="q_extension_cont" name="q[extension:cont]" type="search" value="{{ @(Request::input('q.extension:cont')) }}">
                              </div>
                            </div>
                                                                                                                                                                        <div class="form-group row">
                              <label for="q_mime_cont" class="col-sm-2 col-form-label col-form-label-sm">MIME</label>
                              <div class="col-sm-10">
                                <input class="form-control form-control-sm" id="q_mime_cont" name="q[mime:cont]" type="search" value="{{ @(Request::input('q.mime:cont')) }}">
                              </div>
                            </div>
                                                                                                                                                                        <div class="form-group row">
                              <label for="q_url_cont" class="col-sm-2 col-form-label col-form-label-sm">URL</label>
                              <div class="col-sm-10">
                                <input class="form-control form-control-sm" id="q_url_cont" name="q[url:cont]" type="search" value="{{ @(Request::input('q.url:cont')) }}">
                              </div>
                            </div>
                                                                                                                                                                        <div class="form-group row">
                              <label for="q_fileable_id_cont" class="col-sm-2 col-form-label col-form-label-sm">ARCHIVABLE ID</label>
                              <div class="col-sm-10">
                                <input class="form-control form-control-sm" id="q_fileable_id_cont" name="q[fileable_id:cont]" type="search" value="{{ @(Request::input('q.fileable_id:cont')) }}">
                              </div>
                            </div>
                                                                                                                                                                        <div class="form-group row">
                              <label for="q_fileable_type_cont" class="col-sm-2 col-form-label col-form-label-sm">ARCHIVABLE TIPO</label>
                              <div class="col-sm-10">
                                <input class="form-control form-control-sm" id="q_fileable_type_cont" name="q[fileable_type:cont]" type="search" value="{{ @(Request::input('q.fileable_type:cont')) }}">
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

                      @include('files._table')
                  </div>
              </div>
          </div>
      </div>
  </div>
@endsection
