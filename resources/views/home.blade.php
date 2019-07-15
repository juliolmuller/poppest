@extends('layouts.application')

@section('body')

  @component('components.header')
  @endcomponent

  <main class="content-wrapper">
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-10">
          <h2 class="content-header">
            Pick your favorite language:
          </h2>
        </div>
        <div class="col-xs-12 col-sm-2">
          <button id="refresh-btn" type="button" class="btn btn-lg btn-outline-pop btn-block" onclick="refresh()">
            Refresh
          </button>
        </div>
      </div>
      <div class="row">
        <div class="progress col-sm-12">
          <div class="progress-bar progress-bar-striped progress-bar-animated bg-pop" role="progressbar" style="width: 100%" aria-valuemax="100"></div>
        </div>
      </div>
      <nav id="navbar" class="nav nav-pills nav-fill">
        @foreach ($languages as $language)
          <a href="#" id="panel-tab-{{ $language->id }}" onclick="activate({{ $language->id }})" class="btn btn-outline-pop nav-item">{{ $language->name }}</a>
        @endforeach
      </nav>
      <div id="panel-main">
        @foreach ($languages as $language)
          <div id="panel-board-{{ $language->id }}" style="display: none;">
            <div id="panel-loading-{{ $language->id }}" class="content text-center">
              <img src="{{ asset('img/loading.gif') }}" alt="Loading animation">
            </div>
            <div id="panel-content-{{ $language->id }}" style="display: none;"></div>
          </div>
        @endforeach
      </div>
    </div>
  </main>

  @component('components.modal')
  @endcomponent

@endsection

@section('scripts')
  @parent
  <script type="text/javascript">
    $.ajaxSetup({ headers: { 'X-CSRF-Token': '{{ csrf_token() }}'} })
    const LANGUAGES = []
    @foreach ($languages as $language)
      LANGUAGES[{{ $loop->index }}] = '{{ $language->id }}'
    @endforeach
  </script>
@endsection
