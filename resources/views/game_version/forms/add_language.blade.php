@extends('layouts.app')
@section('content')
    <div class="row margin-bottom-30">
        <div class="col-md-6">
            <div class="panel">
                <div class="panel-heading">
                    <div class="panel-title"><h4>{!! __('messages.add_language') !!}</h4></div>
                </div><!--.panel-heading-->
                <div class="panel-body">
                    <form id="gameVersion-handling-form" class="memoriForm" method="POST"
                          action="{{route('addGameVersionLanguage')}}"
                          enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="game_version_id" value="{{$gameVersionId}}">
                        <div class="row">
                            <div class="col-md-3">{!! __('messages.language') !!}</div><!--.col-md-3-->
                            <div class="col-md-6">
                                <select class="selecter width-percent-80" name="lang_id">
                                    @foreach($languages as $language)
                                        <option value="{{$language->id}}">{{$language->name}}</option>
                                    @endforeach
                                </select>
                            </div><!--.col-md-9-->
                            <div class="col-md-3">
                                <button type="submit" id="gameVersionLangSubmitBtn" class="btn btn-primary btn-ripple">
                                    {!! __('messages.add_language') !!}
                                </button>
                            </div><!--.col-md-9-->
                        </div><!--.row-->
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
