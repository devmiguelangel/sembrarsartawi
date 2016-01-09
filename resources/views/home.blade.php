@extends('layout')

@section('header')
    @include('partials.header-home')
@endsection

@section('menu-main')
    @include('partials.menu-main')
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- Horizontal form -->
            <div class="panel panel-flat border-top-primary">
                <div class="wrapper no-pad" >
                    <!--mail inbox start-->
                    @if ($user->profile->first()->slug === 'SEP' || $user->profile->first()->slug === 'COP')
                        @include('partials.inbox')
                    @endif
                    <!--mail inbox end-->
                </div>
            </div>
            <!-- /horizotal form -->
        </div>
    </div>
@endsection