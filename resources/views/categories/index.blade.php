@extends('layouts.admin')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card card-plain">
            <div class="header">
                <h4 class="title">Categories</h4>
                <p class="category">All Categories in the database.</p>
            </div>
            <div class="content table-responsive table-full-width">
                <table class="table table-hover">
                    <thead>
                        <th>ID</th>
                        <th>UUID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Created At</th>
                        <th>&nbsp;</th>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->uuid }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->description }}</td>
                                <td> {{ $category->created_at }} </td>
                                <td><a href="{{ url('/categories/'.$category->id) }}">View</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-xs-9">
            </div>
            <div class="col-xs-3 text-right">
                <a href="{{ url('categories/create') }}" class="btn btn-success btn-circle" title="Add More"><i class="fa fa-plus"></i></a>
            </div>
        </div>
    </div>
</div>
@endsection