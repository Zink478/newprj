@extends('layouts.app')

@section('content')
<div class="container">
{{--    <div class="row justify-content-center">--}}
{{--        <div class="col-md-8">--}}
{{--            <div class="card">--}}
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <div id="app">
{{--                            <posts-component></posts-component>--}}
                            <tour-component></tour-component>
                            <list-component ></list-component>
                            <table-component ></table-component>
                            <items-component ></items-component>
                            <notifications class="topnotif" position="center" group="foo" />

{{--                        </div>--}}

{{--                </div>--}}
{{--            </div>--}}
        </div>
    </div>
</div>
@endsection
