@extends('adminlte::page')

@section('title', 'Parameters')
@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Update Parameter</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            @if ($errors->any())
                <div class="alert alert-error">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form role="form" method="post" action="{{route('parameters.update',['id'=> $parameter->id])}}"
                  enctype="multipart/form-data">
                {{csrf_field()}}
                {{method_field('put')}}
                <div class="box-body">
                    <div class="form-group">
                        <label for="inputName">Name</label>
                        <input value="{{is_null(old('name')) ? $parameter->name : old('name')}}" name="name" type="text"
                               class="form-control" id="name"
                               placeholder="Enter Name">
                    </div>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label for="inputName">Code</label>
                        <input value="{{is_null(old('code')) ? $parameter->code : old('code')}}" name="code" type="text"
                               class="form-control" id="code"
                               placeholder="Enter Code">
                    </div>
                </div>

                <div class="box-body">
                    <div class="form-group">
                        <label for="inputName">Value</label>
                        <input value="{{is_null(old('value')) ? $parameter->value : old('value')}}" name="value" type="text"
                               class="form-control" id="value"
                               placeholder="Enter Value">
                    </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right">Submit</button>
                </div>
            </form>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
@stop
