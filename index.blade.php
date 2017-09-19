@extends('layout')

@section('header')
    <div class="page-header clearfix">
        <h1>
            <i class="glyphicon glyphicon-align-justify"></i> Todos
            <a class="btn btn-success pull-right" href="{{ route('todos.create') }}"><i class="glyphicon glyphicon-plus"></i> Create</a>
        </h1>

    </div>
@endsection

@section('content')
<form action="{{ route('todos.index') }}" method="GET">
        <table class="table table-condensed">
        <tr>
           <td>
                <input
                    type="hidden"
                    name="_token"
                    value="{{ csrf_token() }}">
                <input
                    type="text"
                    id="search-field"
                    name="search"
                    class="form-control"/>
            </td>
            <td>
                <button
                    type="submit"
                    class="btn btn-primary">Filter
                </button>
            </td>
        </tr>
        </table>
    </form>

    <div class="row">
        <div class="col-md-12">
            @if($todos->count())
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>TODO</th>
                            <th>DUEDATE</th>
                            <th class="text-right">OPTIONS</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($todos as $todo)
                            <tr>
                                <td>{{$todo->id}}</td>
                                <td>{{$todo->todo}}</td>
                                <td>{{$todo->duedate}}</td>
                                <td class="text-right">
                                    <a class="btn btn-xs btn-primary" href="{{ route('todos.show', $todo->id) }}"><i class="glyphicon glyphicon-eye-open"></i> View</a>
                                    <a class="btn btn-xs btn-warning" href="{{ route('todos.edit', $todo->id) }}"><i class="glyphicon glyphicon-edit"></i> Edit</a>
                                    <form action="{{ route('todos.destroy', $todo->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $todos->render() !!}
            @else
                <h3 class="text-center alert alert-info">Empty!</h3>
            @endif

        </div>
    </div>

@endsection