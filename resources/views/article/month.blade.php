@extends('layouts.app')

@section('content')
    @component('particals.jumbotron')
        <h3>{{ $time['year'] }}{{lang('Year')}}{{$time['month']}}{{lang('Month')}}</h3>

        <h6>{{ lang('Time Meta') }}</h6>
    @endcomponent

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-default">
                    <div class="card-header">{{ lang('For Articles') }} ( {{ $articles->count() }} )</div>
                    <ul class="list-group list-group-flush">
                        @forelse($articles as $article)
                            <li class="list-group-item">
                                <a href="{{ url($article->slug) }}">{{ $article->title }}</a>
                                <span class="badge float-right"><i class="fas fa-eye"></i> {{ $article->view_count }}</span>
                            </li>
                        @empty
                            <li class="nothing">{{ lang('Nothing') }}</li>
                        @endforelse
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-default">
                    {{--<div class="card-header">{{ lang('For Discussions') }} ( {{ $discussions->count() }} )</div>--}}
                    {{--<ul class="list-group list-group-flush">--}}
                        {{--@forelse($discussions as $discussion)--}}
                            {{--<li class="list-group-item">--}}
                                {{--<span class="badge">{{ $discussion->comments->count() }}</span>--}}
                                {{--<a href="{{ url('discussion', ['id' => $discussion->id]) }}">{{ $discussion->title }}</a>--}}
                            {{--</li>--}}
                        {{--@empty--}}
                            {{--<li class="nothing">{{ lang('Nothing') }}</li>--}}
                        {{--@endforelse--}}
                    {{--</ul>--}}
                </div>
            </div>
        </div>
    </div>
@endsection