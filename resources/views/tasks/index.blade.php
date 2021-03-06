@extends('layouts.app')

@section('content')
    <div class="container">
        <div class=" col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    New Task
                </div>

                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    @include('common.errors')

                    <!-- New Task Form -->
                    <form action="{{ url('task') }}" method="POST" class="form-horizontal">
                        {{ csrf_field() }}

                        <!-- Task Name -->
                        <div class="form-group">
                            <label for="task-name" class="col-sm-3 control-label">Task</label>

                            <div class="col-sm-6">
                                <input type="text" name="name" id="task-name" class="form-control" value="{{ old('task') }}">
                            </div>
                        </div>
                            <div class="form-group">
                                <label for="task-description" class="col-sm-3 control-label">description</label>

                                <div class="col-sm-6">
                                    <textarea type="text" name="description" id="task-description" class="form-control" value="{{ old('task') }}"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="task-rank" class="col-sm-3 control-label">rank</label>

                                <div class="col-sm-6">
                                    <input type="text" name="rank" id="task-rank" class="form-control" value="{{ old('task') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="task-list" class="col-sm-3 control-label">List</label>

                                <div class="col-sm-6">
                                    <input type="text" name="list" id="task-list" class="form-control" value="{{ old('task') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="task-listrank" class="col-sm-3 control-label">Rank of List</label>

                                <div class="col-sm-6">
                                    <input type="text" name="listrank" id="task-listrank" class="form-control" value="{{ old('task') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="task-board" class="col-sm-3 control-label">board</label>

                                <div class="col-sm-6">
                                    <input type="text" name="board" id="task-board" class="form-control" value="{{ old('task') }}">
                                </div>
                            </div>

                        <!-- Add Task Button -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-btn fa-plus"></i>Add Task
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


            @foreach($tasks->unique('board') as $boards)
                <div class="panel panel-danger  " style="border-width: thick ; border-color:#843534 ">
                    <div class="text-center panel-heading">
                       <strong class="text-center text-danger"> {{$boards->board}}</strong>
                    </div>
            @foreach($tasks->unique('list') as $lists)
                        @if($boards->board==$lists->board)
                    <div class="panel panel-warning" style="border-width: thick ; border-color:#2b542c">
                    <div class="panel-heading" style="background-color: #faf2cc">
                       <strong> {{$lists->list}}</strong>
                        <div class="">
                                <form action="{{url('uplist/' . $lists->id)}}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="text" name="list"  class="form-control" value='' >
                                    <button  type="submit" id="update-list-{{ $lists->id }}" class="btn btn-warning btn-xs btn-update ">Update list name</button>
                                </form>
                                <form  action="{{url('uplistrank/' . $lists->id)}}" method="POST">
                                    {{ csrf_field() }}
                                    <input class="input-sm form-control" type="text" name="listrank" value='{{ $lists->listrank }}' >
                                    <button  type="submit" id="update-listrank-{{ $lists->id }}" class="btn btn-warning btn-xs btn-update ">Update rank of list</button>
                                </form>
                        </div>
                    </div>


                    <div class="panel-body">
                        <table class="table table-striped task-table">
                            <thead>
                                <th>&nbsp;</th>
                            </thead>
                            <tbody>
                                @foreach ($tasks as $task)
                                    @if ($task->list == $lists->list)
                                    <tr>
                                        <td class="table-text "><strong>{{ $task->name }}</strong></td>
                                        @if($task->description!="")
                                        <td class="table-text">
                                            <div>{{ $task->description }}</div>

                                            <form action="{{url('nulldesc/' . $task->id)}}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}

                                                <button type="submit" id="delete-description-{{ $task->id }}" class="btn btn-danger btn-xs btn-update ">Delete description</button>
                                            </form>
                                            </td>

                                        @else
                                            <td>&nbsp;</td>
                                    @endif
                                        <td>
                                            <form action="{{url('updesc/' . $task->id)}}" method="POST">
                                                {{ csrf_field() }}
                                                <input type="text" name="description"  class="form-control" value='{{ $task->description }}' >
                                                <button  type="submit" id="update-description-{{ $task->id }}" class="btn btn-warning btn-xs btn-update ">Update or add description</button>
                                            </form>
                                        </td>
                                        <td>
                                        <form action="{{url('uprank/' . $task->id)}}" method="POST">
                                            {{ csrf_field() }}
                                            <input class="input-sm form-control" type="text" name="rank" value='{{ $task->rank }}' >
                                            <button  type="submit" id="update-rank-{{ $task->id }}" class="btn btn-warning btn-xs btn-update ">Update rank</button>
                                        </form>
                                        </td>
                                        <!-- Task Delete Button -->
                                        <td>
                                            <form action="{{url('task/' . $task->id)}}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}

                                                <button type="submit" id="delete-task-{{ $task->id }}" class="btn btn-danger">
                                                    <i class="fa fa-btn fa-trash"></i>Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                @endif

                    @endforeach
                </div>

                @endforeach
        </div>
        </div>
    </div>
@endsection
