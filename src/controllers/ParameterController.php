<?php

namespace Sawan\Core\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Sawan\Core\Models\Parameter;

class ParameterController extends Controller
{
    public function index()
    {
        $parameters = Parameter::orderByDesc('created_at')->paginate(10);

        return view('core.parameters.index', compact('parameters'));
    }

    public function create()
    {
        return view('core.parameters.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'string|required',
            'code' => 'string|required|unique:parameters',
            'value' => 'string|required'
        ]);
        $parameter = new Parameter();
        $parameter->fill($request->all());
        $parameter->save();
        return redirect()->route('parameters.index');
    }

    public function show($id)
    {
        $parameter = Parameter::find($id);

        return view('core.parameters.show', compact('parameter'));
    }

    public function edit($id)
    {
        $parameter = Parameter::find($id);

        return view('core.parameters.edit', compact('parameter'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'string|required',
            'code' => 'string|required|unique:parameters',
            'value' => 'string|required'
        ]);
        $parameter = Parameter::find($id);
        $parameter->fill($request->all());
        $parameter->save();
        return redirect()->route('parameters.index');
    }

    public function destroy($id)
    {
        $parameter = Parameter::find($id);
        $parameter->delete();
        return redirect()->route('parameters.index');
    }
}
