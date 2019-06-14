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
          <button type="submit" class="btn btn-lg btn-outline-success btn-block" onclickk="refreshAll()">
            Refresh
          </button>
        </div>
      </div>
      <nav id="navbar" class="nav nav-pills nav-fill">
        @foreach ($languages as $language)
          <a href="#" id="language-tab-{{ $language->id }}" onload="refresh({{ $language->id }})" onclick="activate({{ $language->id }})" class="btn btn-outline-success nav-item">{{ $language->name }}</a>
        @endforeach
      </nav>
      <div id="panel-0" class="content text-center">
        <img src="{{ asset('img/loading.gif') }}" alt="Loading animation">
      </div>

      @component('components.modal')
      @endcomponent

    </div>
  </main>

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
