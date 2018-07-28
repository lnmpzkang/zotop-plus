<?php

namespace Modules\Core\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Core\Base\AdminController;
use Module;
use Artisan;
use Filter;
use Action;

class ModulesController extends AdminController
{
    /**
     * 模块管理
     *
     * @return Response
     */
    public function index()
    {
        $this->title   = trans('core::modules.title');
        $this->modules = module();

        return $this->view();
    }

    /**
     * 启用模块
     * 
     * @param  string $name 模块名称
     * @return json
     */
    public function enable(Request $request, $name)
    {
        Module::enable($name);

        return $this->success(trans('core::master.actived'), $request->referer());
    }

    /**
     * 启用模块
     * 
     * @param  string $name 模块名称
     * @return json
     */
    public function disable(Request $request, $name)
    {
        // 卸载前置Hook
        if (! Filter::fire('module.disabling', $this, $name) ) {
            return $this->error($this->error);
        }    

        Module::disable($name);

        return $this->success(trans('core::master.disabled'), $request->referer());
    }

    /**
     * 安装模块
     * 
     * @param  string $name 模块名称
     * @return json
     */
    public function install(Request $request, $module)
    {  
        // install
        Artisan::call('module:execute', [
            'action'  => 'install',
            'module'  => $module,
            '--force' => true,
            '--seed'  => false,
        ]);

        return $this->success(trans('core::modules.installed'), $request->referer());
    }

    /**
     * 卸载模块
     * 
     * @param  string $name 模块名称
     * @return json
     */
    public function uninstall(Request $request, $module)
    {
        // 卸载前置Hook
        if (! Filter::fire('module.uninstalling', $this, $module) ) {
            return $this->error($this->error);
        }

        // install
        Artisan::call('module:execute', [
            'action'  => 'uninstall',
            'module'  => $module,
            '--force' => true,
            '--seed'  => false,
        ]);        

        return $this->success(trans('core::modules.uninstalled'), $request->referer());
    }

    /**
     * 删除模块
     * 
     * @param  string $name 模块名称
     * @return json
     */
    public function delete(Request $request, $name)
    {
        // 卸载前置Hook
        if (! Filter::fire('module.deleting', $this, $name) ) {
            return $this->error($this->error);
        }
        
        // Find Module
        $module = Module::find($name);

        // 已安装模块禁止删除
        if ($module->active or $module->installed) {
            return $this->error(trans('core::modules.core_operate_forbidden'));
        }

        $module->delete();

        return $this->success(trans('core::master.deleted'), $request->referer());
    }       
}
