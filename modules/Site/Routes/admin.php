<?php
use Illuminate\Routing\Router;

// Site 模块后台路由
$router->group(['prefix' =>'site'], function (Router $router) {
    
    // 模板选择
    $router->get('select/view/{theme?}','SiteController@selectView')->name('site.view.select');


    // 系统设置
    $router->group(['prefix' =>'config'], function (Router $router) {
        $router->any('base','ConfigController@base')->name('site.config.base')->middleware('allow:site.config.base');
        $router->any('wap','ConfigController@wap')->name('site.config.wap')->middleware('allow:site.config.wap');
        $router->any('seo','ConfigController@seo')->name('site.config.seo')->middleware('allow:site.config.seo');
        $router->any('maintain','ConfigController@maintain')->name('site.config.maintain')->middleware('allow:site.config.maintain');
    });    
});
