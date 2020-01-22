<?php
use App\Hook\Facades\Action;
use App\Hook\Facades\Filter;

/**
 * 扩展后台全局导航
 */
// Filter::listen('global.navbar',function($navbar) {
//     // 只在本地模式下不显示
//     if (allow('developer.index') && app()->environment('local')) {
//         $navbar['developer'] = [
//             'text'   => trans('developer::developer.title'),
//             'href'   => route('developer.index'),
//             'active' => Route::is('developer.*')
//         ];
//     }
//     return $navbar;
// }, 80);

/**
 * 扩展模块管理
 */
Filter::listen('global.start',function($navbar){
    
    // 无权限或者非本地模式下不显示
    if (allow('developer.module') && app()->environment('local')) {
        $navbar['developer-module'] = [
            'text' => trans('developer::module.title'),
            'href' => route('developer.module.index'),
            'icon' => 'fa fa-puzzle-piece bg-warning text-white',
            'tips' => trans('developer::module.description'),
        ];
    }
    
    return $navbar;

}, 100);

Action::listen('module.make.full', 'Modules\Developer\Hooks\ModuleMake@full');



