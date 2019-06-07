<?php

namespace Modules\Content\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Core\Base\AdminController;
use Modules\Content\Models\Model;
use Modules\Content\Models\Field;
use Modules\Content\Support\ModelHelper;
use Modules\Content\Http\Requests\FieldRequest;
use Module;

class FieldController extends AdminController
{
    /**
     * 首页
     *
     * @return Response
     */
    public function index($model_id)
    {
        //Field::sync($model_id);

        $this->model = Model::findOrFail($model_id);
        $this->title = trans('content::field.title');
        $this->fields = Field::where('model_id',$model_id)->orderby('sort','asc')->get();        

        // 左边允许一行多个
        $this->main = $this->fields->filter(function($item){
            return $item['position'] == 'main';
        })->values();

        // 右边只允许一行一个
        $this->side = $this->fields->filter(function($item){
            return $item['position'] == 'side';
        })->values();  

        return $this->view();
    }

    /**
     * 排序
     *
     * @return Response
     */
    public function sort(Request $request, $model_id)
    {
        foreach ($request->ids as $sort=>$id) {
            Field::where('id', $id)->update(['position' => $request->position, 'sort' => $sort]);
        }

        return $this->success(trans('master.operated'));        
    }     

    /**
     * 新建
     * 
     * @return Response
     */
    public function create($model_id)
    {
        $this->title = trans('content::field.create');

        $this->field = Field::findOrNew(0);
        $this->model = Model::findOrFail($model_id);

        $this->field->model_id = $model_id;
        $this->field->type     = 'text'; // 新建字段默认为text类型
        $this->field->system   = 0; // 新建字段为自定义字段
        $this->field->col      = 0; // 默认在主区域显示


        return $this->view();
    }

    /**
     * 保存
     *
     * @param  Request $request
     * @return Response
     */
    public function store(FieldRequest $request)
    {
        $field = new Field;
        $field->fill($request->all());
        $field->save();

        return $this->success(trans('master.created'), route('content.field.index', $request->model_id));
    } 

    /**
     * 编辑
     *
     * @return Response
     */
    public function edit($model_id, $id)
    {
        $this->title = trans('content::field.edit');

        $this->id    = $id;
        $this->field = Field::findOrFail($id);
        $this->model = Model::findOrFail($this->field->model_id);

        return $this->view();
    }

    /**
     * 更新
     *
     * @param  Request $request
     * @return Response
     */
    public function update(FieldRequest $request, $id)
    {
        $field = Field::findOrFail($id);
        $field->fill($request->all());    
        $field->save();

        return $this->success(trans('master.updated'), route('content.field.index', $field->model_id));
    }

    /**
     * 修改
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function change(Request $request, $id)
    {
        $field = Field::findOrFail($id);
        $field->fill($request->all());      
        $field->save();

        return $this->success(trans('master.operated'), route('content.field.index', $field->model_id));        
    }      

    /**
     * 删除
     *
     * @return Response
     */
    public function destroy($model_id, $id)
    {
        $field = Field::findOrFail($id);

        if ($field->system) {
            abort(403, 'system cant destroy');
        }

        $field->delete();

        return $this->success(trans('master.deleted'), route('content.field.index', $model_id));        
    }

    /**
     * 启用和禁用
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function status($model_id, $id)
    {
        $field = Field::findOrFail($id);
        $field->disabled = $field->disabled ? 0 : 1;
        $field->save();

        return $this->success(trans('master.operated'), route('content.field.index', $model_id));
    }

    /**
     * 字段属性
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function settings(Request $request, $model_id)
    {
        $types = Field::types($request->field['model_id']);

        $this->field = array_object($request->field);
        $this->type  = array_object(array_get($types, $this->field->type));

        // 如果有定义属性视图
        if ($this->type->view ?? false) {

            if (is_string($this->type->view)) {
                $this->type->view = explode('&&', $this->type->view);
            } else {
                $this->type->view = (array)$this->type->view;
            }

            if (count($this->type->view) == 1) {
                return $this->view(reset($this->type->view));
            }

            return $this->view();
        }

        return null;
    }      
}
