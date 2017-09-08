@extends('core::layouts.master')

@section('content')
<div class="main scrollable">
    
    <div class="jumbotron bg-primary text-white text-center">
        <div class="container-fluid">
            <h1>{{trans('core::system.environment.title')}}</h1>
            <p>{{trans('core::system.environment.description')}}</p>
        </div>
    </div>

    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header">
                {{trans('core::system.environment.server')}}
                <p class="card-text text-muted">
                    {{trans('core::system.environment.server.description')}}
                </p>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <tbody>
                    @foreach($server as $key=>$val)
                    <tr>
                        <td>{{trans("core::system.environment.server.{$key}")}}</td>
                        <td>{{$val}}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>                
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                {{trans('core::system.environment.files')}}
                <p class="card-text text-muted">
                    {{trans('core::system.environment.files.description')}}
                </p>                
            </div>
            <div class="card-body">
                {{trans('core::system.environment.files')}}
            </div>
        </div>        
    </div>
@endsection