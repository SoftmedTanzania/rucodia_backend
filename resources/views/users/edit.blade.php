@extends('layouts.admin')
@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="header">
                <h4 class="title">Update User Details</h4>
            </div>
            <div class="content">
                <form action="{{ url('users') }}/{{ $user->id }}" role="form" method="POST">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" class="form-control border-input" placeholder="firstname" id="firstname" name="firstname" value="{{ $user->firstname }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Middle Name</label>
                                <input type="text" class="form-control border-input" placeholder="middlename" id="middlename" name="middlename" value="{{ $user->middlename }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" class="form-control border-input" placeholder="surname" id="surname" name="surname" value="{{ $user->surname }}" >
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="phone">Mobile Phone</label>
                                <input type="phone" class="form-control border-input" placeholder="phone" id="phone" name="phone" value="{{ $user->phone }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" class="form-control border-input" placeholder="Username" id="username" name="username" value="{{ $user->username }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="level">User Role</label>
                                <select name="level" id="level" class="form-control border-input">
                                    <option value="@foreach($user->levels as $level) {{ $level->id }} @endforeach" autofocus>@foreach($user->levels as $level) {{ $level->name }} @endforeach</option>
                                    @foreach($levels as $level)
                                        <option value="{{ $level->id }}">{{ ucfirst($level->name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control border-input" id="password" name="password" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password_confirmation">Repeat Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control border-input" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="region">Region</label>
                                <select id="region" name="region" class="form-control border-input">
                                <option value="@foreach($user->wards as $ward) {{ $ward->id }} @endforeach" autofocus>@foreach($user->wards as $ward) {{ $ward->district->region->name }} @endforeach</option>
                                    @foreach($regions as $region)
                                        <option value="{{ $region->id }}">{{ $region->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="district">District</label>
                                <select id="district" name="district" class="form-control border-input">
                                <option value="@foreach($user->wards as $ward) {{ $ward->id }} @endforeach" autofocus>@foreach($user->wards as $ward) {{ $ward->district->name }} @endforeach</option>
                                    @foreach($districts as $district)
                                        <option value="{{ $district->id }}">{{ $district->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                        <div class="form-group">
                                <label for="ward">Ward</label>
                                <select id="ward" name="ward" class="form-control border-input">
                                <option value="@foreach($user->wards as $ward) {{ $ward->id }} @endforeach" autofocus>@foreach($user->wards as $ward) {{ $ward->name }} @endforeach</option>
                                    @foreach($wards as $ward)
                                        <option value="{{ $ward->id }}">{{ $ward->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Location/Business name</label>
                                <input type="text" class="form-control border-input" placeholder="e.g Bora Shop" id="location" name="location" value="@foreach($user->locations as $location) {{ $location->name }} @endforeach" disabled>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Latitude</label>
                                <input type="text" class="form-control border-input" placeholder="e.g -2.129001" id="latitude" name="latitude" disabled>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Longitude</label>
                                <input type="text" class="form-control border-input" placeholder="e.g 30.155438" id="longitude" name="longitude" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-success btn-fill btn-wd">Update User</button>
                    </div>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="{{ url('assets/js/jquery-3.2.1.min.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    $('#region').on('change', function(e){
        console.log(e);
        var region_id = e.target.value;
 
        $.get('{{ url('users') }}/districts/' + region_id, function(data) {
            console.log(data);
            $('#district').empty();
            $.each(data, function(index,subCatObj){
                $('#district').append("<option value='"+subCatObj.id+"'>"+subCatObj.name+"</option>");
            });
        });
    });

    $('#district').on('change', function(e){
        console.log(e);
        var district_id = e.target.value;
 
        $.get('{{ url('users') }}/wards/' + district_id, function(data) {
            console.log(data);
            $('#ward').empty();
            $.each(data, function(index,subCatObj){
                $('#ward').append("<option value='"+subCatObj.id+"'>"+subCatObj.name+"</option>");
            });
        });
    });
</script>
@endsection