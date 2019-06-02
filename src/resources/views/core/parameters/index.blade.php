@extends('adminlte::page')

@section('title', 'Parameters')
@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Parameters</h3>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{url('parameters\create')}}">
                    <i class="fa fa-plus-circle"></i> Create Parameter
                </a>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            @if($parameters->count() > 0 )
                <table class="datatable table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Code</th>
                        <th>Value</th>
                        <th>Operations</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($parameters as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->code}}</td>
                            <td>{{$item->value}}</td>
                            <td class="text-center">
                                <a class="btn btn-sm btn-info" href="{{url('parameters/'.$item->id.'/edit')}}"> Edit
                                </a>
                                <a data-id="{{$item->id}}" data-modal="parameter" class="btn btn-sm btn-danger btn-delete"
                                   data-toggle="modal" data-target="#delete-modal"> Delete
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    {{--<tfoot>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Code</th>
                        <th>Value</th>
                        <th>Operations</th>
                    </tr>
                    </tfoot>--}}
                </table>
            @else
                <div class="text-center">
                    <div class="alert alert-info alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-info"></i> Alert!</h4>
                        There is no parameters yet.
                    </div>
                </div>
            @endif
        </div>
        <!-- /.box-body -->
        @if($parameters->count() > 0 )
            <div class="box-footer">
                <div class="text-center">{{$parameters->links()}}</div>
            </div>
        @endif
    </div>
    <!-- /.box -->
    @include('core.delete-modal')
@stop
