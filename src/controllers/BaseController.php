<?php

namespace Sawan\Core\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    protected $modelsNamespacePrefix = 'App\\Models\\';

    private function getModelClass() {
        return app($this->getModelClassName());
    }
    private function getModelClassName() {
        return $this->modelsNamespacePrefix . str_replace("Controller", "", class_basename(new static));
    }
    public function index()
    {
        return $this->getModelClass()::all();
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $type = $request->id == null ?'create' : 'update';
        $model = null;
        $modelClass = $this->getModelClassName();
        $model = $type == 'create' ?  new $modelClass() : $this->show($request->id);
        if($model == null) {
            return "Model not found";
        }
        $model->fill($request->all());
        $model->save();
        return $model;
    }

    public function show($id)
    {
        return $this->getModelClass()::find($id);
    }

    public function edit($id)
    {
        return $this->getModelClass()::delete($id);
    }

    public function update(Request $request)
    {
    }

    public function destroy($id)
    {
        //
    }
}
