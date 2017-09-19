@extends('layout')
@section('css')
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/css/bootstrap-datepicker.css" rel="stylesheet">
@endsection
@section('header')
    <div class="page-header">
        <h1><i class="glyphicon glyphicon-plus"></i> Todos / Create </h1>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('todos.store') }}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group @if($errors->has('todo')) has-error @endif">
                       <label for="todo-field">Todo</label>
                        <input type="text" id="todo-field" name="todo" class="form-control" value="{{ old("todo") }}"/>
                       @if($errors->has("todo"))
                        <span class="help-block">{{ $errors->first("todo") }}</span>
                       @endif
                    </div>
                <div class="form-group @if($errors->has('duedate')) has-error @endif">
                       <label for="duedate-field">Duedate</label>
                        <input type="text" id="duedate-field" name="duedate" class="form-control" value="{{ old("duedate") }}"/>
                       @if($errors->has("duedate"))
                        <span class="help-block">{{ $errors->first("duedate") }}</span>
                       @endif
                    </div>
                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Create</button>
                    <a class="btn btn-link pull-right" href="{{ route('todos.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
                </div>
            </form>

        </div>
    </div>
@endsection
@section('scripts')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/js/bootstrap-datepicker.min.js"></script>
  <script>
    $('.date-picker').datepicker({
    });
  </script>
@endsection
