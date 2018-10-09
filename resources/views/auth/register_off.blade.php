@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3" style="margin-top: 50px;">
            <div class="well">
                <form class="form" role="form" method="POST" action="{{ url('/register') }}">
                    {{ csrf_field() }}

                    <fieldset>
                        <legend class="text-center">提示</legend>
                        <div class="text-center">
                            <span>注册功能关闭，请联系管理员</span>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
