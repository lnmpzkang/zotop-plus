<div class="side">
    <div class="side-header">
        <a href="{{route('developer.module.index')}}" title="{{trans('core::master.back')}}" data-placement="right" class="mr-3"><i class="fa fa-angle-left"></i></a>
        {{$module->title}}   
    </div>
    <div class="side-body scrollable">
        <ul class="nav nav-pills nav-side">
            <li class="nav-item">
                <a class="nav-link {{Route::active('developer.module.show')}}" href="{{route('developer.module.show',$module->name)}}">
                    <i class="fa fa-info-circle fa-fw"></i> {{trans('developer::module.show')}}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{Route::active('developer.module.controller')}}" href="{{route('developer.module.controller',[$module->name,'admin'])}}">
                    <i class="fa fa-sitemap fa-fw"></i> {{trans('developer::controller.title')}}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{Route::active('developer.migration.index')}}" href="{{route('developer.migration.index',[$module->name])}}">
                    <i class="fa fa-database fa-fw"></i> {{trans('developer::migration.title')}}
                </a>
            </li>              
            <li class="nav-item">
                <a class="nav-link {{Route::active('developer.command.index')}}" href="{{route('developer.command.index',[$module->name])}}">
                    <i class="fa fa-terminal fa-fw"></i> {{trans('developer::command.title')}}
                </a>
            </li>                                  
        </ul>        
    </div>
    <div class="side-footer">
        
    </div>
</div>