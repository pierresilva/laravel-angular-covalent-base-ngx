@extends('layouts.de_app')

@section('content')
  <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-12">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/" class="d-inline-flex"><i class="material-icons mr-1">home</i> Home</a></li>

                  @if ( $query_params = Request::input('q') )

                      <li class="breadcrumb-item active"><a href="{{ route('users.index') }}">{{ $model_title_list['users'] }}</a></li>
                      <li class="breadcrumb-item active">condition(
                      @foreach( $query_params as $key => $value )
                          @if (!$loop->first) / @endif {{ $key }} : {{ $value }}
                      @endforeach
                      )</li>
                  @else
                      <li class="breadcrumb-item active">{{ $model_title_list['users'] }}</li>
                  @endif

                </ol>
              </nav>
              <div class="card">
                  <div class="card-body">
                      <h1 class="d-flex mb-3">
                          <i class="material-icons align-self-center mr-1">view_headline</i>
                          <span class="d-inline-block">{{ $model_title_list['users'] }}</span>
                          <a class="btn btn-success d-inline-flex ml-auto" href="{{ route('users.create') }}"><i class="material-icons align-self-center mr-1">add_circle</i><span class="align-self-center">Create</span></a>
                      </h1>

                      <p><button class="btn btn-primary btn-sm" type="button" data-toggle="collapse" data-target="#search-area" aria-expanded="false" aria-controls="search-area">Search</button></p>
                      <div class="collapse mb-4" id="search-area">
                        <div class="card card-body">

                          <form id="search" action="{{ route('users.index') }}" accept-charset="UTF-8" method="get">
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
                              <label for="q_email_cont" class="col-sm-2 col-form-label col-form-label-sm">EMAIL</label>
                              <div class="col-sm-10">
                                <input class="form-control form-control-sm" id="q_email_cont" name="q[email:cont]" type="search" value="{{ @(Request::input('q.email:cont')) }}">
                              </div>
                            </div>
                                                                                                                                                                                                                                                                                        <div class="form-group row">
                              <label for="q_first_name_cont" class="col-sm-2 col-form-label col-form-label-sm">NOMBRE</label>
                              <div class="col-sm-10">
                                <input class="form-control form-control-sm" id="q_first_name_cont" name="q[first_name:cont]" type="search" value="{{ @(Request::input('q.first_name:cont')) }}">
                              </div>
                            </div>
                                                                                                                                                                        <div class="form-group row">
                              <label for="q_last_name_cont" class="col-sm-2 col-form-label col-form-label-sm">APELLIDOS</label>
                              <div class="col-sm-10">
                                <input class="form-control form-control-sm" id="q_last_name_cont" name="q[last_name:cont]" type="search" value="{{ @(Request::input('q.last_name:cont')) }}">
                              </div>
                            </div>
                                                                                                                                                                        <div class="form-group row">
                              <label for="q_accept_terms_condition_cont" class="col-sm-2 col-form-label col-form-label-sm"></label>
                              <div class="col-sm-10">
                                <input class="form-control form-control-sm" id="q_accept_terms_condition_cont" name="q[accept_terms_condition:cont]" type="search" value="{{ @(Request::input('q.accept_terms_condition:cont')) }}">
                              </div>
                            </div>
                                                                                    
                                                                                    <div class="form-group row">
                              <label for="q_syst_position_id_eq" class="col-sm-2 col-form-label col-form-label-sm">CARGOS<br>belongsTo</label>
                              <div class="col-sm-10">
                                {{--<input class="form-control form-control-sm" id="q_syst_position_id_eq" name="q[syst_position_id:eq]" type="search" value="{{ @(Request::input('q.syst_position_id:eq')) }}">--}}
                                <select class="form-control"
                                    id="q_syst_position_id_eq"
                                    name="q[syst_position_id:eq]">
                                <option value=""></option>
                                @foreach( $lists["SystPosition"] as $list_key => $list_item )
                                    <option value="{{ $list_key }}"
                                            @if( $list_key == @(Request::input('q.syst_position_id:eq')) )  selected='selected' @endif
                                    >{{ $list_item }}</option>
                                @endforeach
                                </select>
                              </div>
                            </div>
                                                                                                                                                                                                    <div class="form-group row">
                              <label for="q_user_profiles_id_eq" class="col-sm-2 col-form-label col-form-label-sm">PERFILES DE USUARIOS<br>hasMany</label>
                              <div class="col-sm-10">
                                {{--<input class="form-control form-control-sm" id="q_user_profiles_id_eq" name="q[userProfiles.id:eq]" type="search" value="{{ @(Request::input('q.userProfiles.id:eq')) }}">--}}
                                <select class="form-control"
                                    id="q_user_profiles_id_eq"
                                    name="q[userProfiles.id:eq]">
                                <option value=""></option>
                                @foreach( $lists["UserProfile"] as $list_key => $list_item )
                                    <option value="{{ $list_key }}"
                                    @if( $list_key == @(Request::input('q.userProfiles.id:eq')) )  selected='selected' @endif
                                    >{{ $list_item }}</option>
                                @endforeach
                                </select>
                              </div>
                            </div>
                                                                                                                                                                        <div class="form-group row">
                              <label for="q_coun_meeting_citations_id_eq" class="col-sm-2 col-form-label col-form-label-sm">JUNTAS CITACIONES<br>hasMany</label>
                              <div class="col-sm-10">
                                {{--<input class="form-control form-control-sm" id="q_coun_meeting_citations_id_eq" name="q[counMeetingCitations.id:eq]" type="search" value="{{ @(Request::input('q.counMeetingCitations.id:eq')) }}">--}}
                                <select class="form-control"
                                    id="q_coun_meeting_citations_id_eq"
                                    name="q[counMeetingCitations.id:eq]">
                                <option value=""></option>
                                @foreach( $lists["CounMeetingCitation"] as $list_key => $list_item )
                                    <option value="{{ $list_key }}"
                                    @if( $list_key == @(Request::input('q.counMeetingCitations.id:eq')) )  selected='selected' @endif
                                    >{{ $list_item }}</option>
                                @endforeach
                                </select>
                              </div>
                            </div>
                                                                                                                                                                        <div class="form-group row">
                              <label for="q_coun_members_id_eq" class="col-sm-2 col-form-label col-form-label-sm">JUNTAS MIEMBROS<br>hasMany</label>
                              <div class="col-sm-10">
                                {{--<input class="form-control form-control-sm" id="q_coun_members_id_eq" name="q[counMembers.id:eq]" type="search" value="{{ @(Request::input('q.counMembers.id:eq')) }}">--}}
                                <select class="form-control"
                                    id="q_coun_members_id_eq"
                                    name="q[counMembers.id:eq]">
                                <option value=""></option>
                                @foreach( $lists["CounMember"] as $list_key => $list_item )
                                    <option value="{{ $list_key }}"
                                    @if( $list_key == @(Request::input('q.counMembers.id:eq')) )  selected='selected' @endif
                                    >{{ $list_item }}</option>
                                @endforeach
                                </select>
                              </div>
                            </div>
                                                                                                                                                                                                    <div class="form-group row">
                              <label for="q_user_role_id_cont" class="col-sm-2 col-form-label col-form-label-sm">USUARIOS ROLES<br>belongsToMany</label>
                              <div class="col-sm-10">
                                {{--<input class="form-control form-control-sm" id="q_user_role_id_cont" name="q[userRoles.user_role_id:eq]" type="search" value="{{ @(Request::input('q.userRoles.user_role_id:eq')) }}">--}}
                                <select class="form-control"
                                    id="q_user_role_id_eq"
                                    name="q[userRoles.user_role_id:eq]">
                                <option value=""></option>
                                @foreach( $lists["UserRole"] as $list_key => $list_item )
                                    <option value="{{ $list_key }}"
                                    @if( $list_key == @(Request::input('q.userRoles.user_role_id:eq')) )  selected='selected' @endif
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

                      @include('users._table')
                  </div>
              </div>
          </div>
      </div>
  </div>
@endsection
