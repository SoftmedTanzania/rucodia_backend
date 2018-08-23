@extends('layouts.admin')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card card-plain">
            <div class="header">
                <h4 class="title">Users</h4>
                <p class="category">All registered users in the database.</p>
            </div>
            <div class="content table-responsive table-full-width">
                <table class="table table-hover">
                    <thead>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Username</th>
                        <th>Ward</th>
                        <th>Level</th>
                        <th>&nbsp;</th>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->firstname }} {{ $user->middlename }} {{ $user->surname }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>{{ $user->username }}</td>
                                
                                <td>
                                    @foreach($user->wards as $ward)
                                        {{ $ward->name }}
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($user->levels as $level)
                                        {{ $level->name }}
                                    @endforeach
                                </td>
                                <td><a href="{{ url('/users/'.$user->id) }}">View</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
            <div class="col-xs-9">
                {{ $users->links() }}
            </div>
            <div class="col-xs-3 text-right">
                <a href="{{ url('users/create') }}" class="btn btn-success btn-circle" title="Add More"><i class="fa fa-plus"></i></a>
            </div>
        </div>
    </div>
</div>
@endsection
