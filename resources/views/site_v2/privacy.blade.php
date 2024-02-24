@extends('site_v2.layouts.index')

@section('content')
    <div class="container mycontainer">
        <div class="row">
            <div class="col-12">
                <h1 class="mt-5 mb-3 text-center">{{$page->h1_header[App::getLocale() ?? 'ar'] ?? '' }}</h1>
                <div style="text-align: right">
                    {!! $page->editor_section[App::getLocale() ?? 'ar'] ?? '' !!}
                </div>
            </div>
        </div>
    </div>

@endsection
