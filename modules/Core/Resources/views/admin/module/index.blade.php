@extends('core::layouts.master')

@section('content')
<div class="main">
    <div class="main-header">    
        <div class="main-title mr-auto">
            {{$title}}
        </div>
        <div class="main-action">            
            <a href="{{route('core.module.publish')}}" class="btn btn-success js-post" title="{{trans('core::module.publish.tooltip')}}">
                <i class="fa fa-sync fa-fw"></i> {{trans('core::module.publish')}}
            </a>
            <a href="{{route('core.module.upload')}}" class="btn btn-primary btn-upload d-none">
                <i class="fa fa-upload fa-fw"></i> {{trans('core::module.upload')}}
            </a>
        </div>        
    </div>
    <div class="main-body scrollable">        
        <table class="table table-nowrap table-sortable">
            <thead>
                <tr>
                    <td class="text-center" width="5%">{{trans('core::module.status.label')}}</td>
                    <td colspan="2">{{trans('core::module.name.label')}}</td>
                    <td width="10%">{{trans('core::module.version.label')}}</td>
                    <td width="40%">{{trans('core::module.description.label')}}</td>
                </tr>
            </thead>        
            <tbody>  
            @foreach($modules as $name=>$module)
                <tr class="item {{$module->isEnabled() ? 'active' : 'disabled'}}">
                    <td class="text-center">
                        <i class="fa fa-2x {{$module->isEnabled() ? 'fa-check-circle text-success' : 'fa-times-circle'}}"></i>
                    </td>
                    <td width="1%" class="pr-2">
                        <div class="icon icon-md">
                            <img src="{{preview($module->getPath('module.png'), 48, 48)}}">
                        </div>
                    </td>
                    <td class="pl-2">
                        <div class="title"> <b class="text-lg">{{$module->getTitle()}}</b> <span class="text-muted">{{$name}}</span></div>
                        <div class="manage">
                            @foreach(Filter::fire('module.manage', [], $module) as $s)
                            <a href="{{$s['href'] ?? 'javascript:;'}}" class="manage-item {{$s['class'] ?? ''}}" {!!Html::attributes(array_except($s,['icon','text','href','class']))!!}>
                                <i class="{{$s['icon'] ?? ''}} fa-fw"></i> {{$s['text']}}
                            </a>
                            @endforeach
                        </div>
                    </td>
                    <td width="10%">{{$module->version}}</td>
                    <td>
                        <p>{{$module->getDescription()}}</p>
                        <div class="manage text-muted text-xs">
                            @if($module->author)
                            <span class="manage-item">{{$module->author}}</span>
                            @endif

                            @if($module->email)
                            <a class="manage-item" href="mailto:{{$module->email}}">{{$module->email}}</a>
                            @endif

                            @if($module->homepage)
                            <a class="manage-item" href="{{$module->homepage}}" target="_blank">{{$module->homepage}}</a>
                            @endif
                        </div>  
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="main-footer">
        <div class="footer-text">{{trans('core::module.description')}}</div>
    </div>
</div>
@endsection

@push('css')

@endpush

@push('js')

@endpush
