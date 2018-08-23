@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-4 col-md-5">
        <div class="card card-user">
            <div class="image">
                <!-- <img src="{{ url('assets/img/background/user_bg.jpg') }}" alt="..."/> -->
                <img alt="location map" src='{{ $map }}'>
            </div>
            <div class="content">
                <div class="author">
                    &nbsp;<br><br><br><br>
                    <!-- <img class="avatar border-white" src="{{ url('assets/img/faces/face-0.jpg') }}" alt="..."/> -->
                    <h4 class="title">{{ $user->firstname }} {{ $user->surname }}<br />
                        <a href="#"><small>{{ '@'.$user->username }}</small></a>
                    </h4>
                </div>
                <p class="description text-center">
                    <strong>Region:</strong> @foreach($user->wards as $ward){{ $ward->district->region->name }}@endforeach<br>
                    <strong>District:</strong> @foreach($user->wards as $ward){{ $ward->district->name }}@endforeach<br>
                    <strong>Ward:</strong>@foreach($user->wards as $ward) {{ $ward->name }} @endforeach
                </p>
            </div>
            <hr>
            <div class="text-center">
                <div class="row">
                    <div class="col-md-3 col-md-offset-1">
                        <h5>12<br /><small>Products</small></h5>
                    </div>
                    <div class="col-md-4">
                    <h5>{{ count($user->transactions) }}<br /><small>Transactions</small></h5>
                    </div>
                    <div class="col-md-3">
                        <h5>{{ $user->revenue }}<br /><small>Revenue</small></h5>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="col-lg-8 col-md-7">
        <div class="card">
            <div class="header">
                <h4 class="title">Other Details</h4>
            </div>
            <div class="content">
                <ul class="list-unstyled team-members">
                            <li>
                                <div class="row">
                                    <div class="col-xs-9">
                                        {{ $user->firstname }}
                                        <br />
                                        <span class="text-muted"><small>First Name</small></span>
                                    </div>

                                    <div class="col-xs-3 text-right">
                                        <btn class="btn btn-sm btn-success btn-icon"><i class="fa fa-asterisk"></i></btn>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-xs-9">
                                        {{ $user->middlename }}
                                        <br />
                                        <span class="text-muted"><small>Middle Name</small></span>
                                    </div>

                                    <div class="col-xs-3 text-right">
                                        <btn class="btn btn-sm btn-success btn-icon"><i class="fa fa-asterisk"></i></btn>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-xs-9">
                                        {{ $user->surname }}
                                        <br />
                                        <span class="text-muted"><small>Last Name</small></span>
                                    </div>

                                    <div class="col-xs-3 text-right">
                                        <btn class="btn btn-sm btn-success btn-icon"><i class="fa fa-asterisk"></i></btn>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-xs-9">
                                        {{ $user->phone }}
                                        <br />
                                        <span class="text-muted"><small>Mobile Phone</small></span>
                                    </div>

                                    <div class="col-xs-3 text-right">
                                        <btn class="btn btn-sm btn-success btn-icon"><i class="fa fa-asterisk"></i></btn>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-xs-9">
                                        @foreach ($user->locations as $location) {{ $location->name }} @endforeach
                                        <br />
                                        <span class="text-muted"><small>Business Name</small></span>
                                    </div>

                                    <div class="col-xs-3 text-right">
                                        <btn class="btn btn-sm btn-success btn-icon"><i class="fa fa-asterisk"></i></btn>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="text-center">
                                            <a href="{{url('users')}}/{{$user->id}}/edit" type="submit" class="btn btn-success btn-fill btn-wd">Update User</a href="{{ url('/user/$user->id/edit') }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">&nbsp;</div>
                                    <div class="col-sm-4">
                                        <div class="text-center">
                                            <form action="{{ url('users') }}/{{ $user->id }}" role="form" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <!-- <a type="submit" class="btn btn-danger btn-fill btn-wd">Delete User</a> -->
                                                <button type="submit" class="btn btn-danger btn-fill btn-wd">Delete User</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
            </div>
        </div>
    </div>
</div>
@endsection