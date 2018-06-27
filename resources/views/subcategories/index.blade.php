@extends('layouts.admin')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card card-plain">
            <div class="header">
                <h4 class="title">Subsubcategories</h4>
                <p class="subcategory">All Subsubcategories in the database.</p>
            </div>
            <div class="content table-responsive table-full-width">
                <table class="table table-hover">
                    <thead>
                        <th>ID</th>
                        <th>Category</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Created At</th>
                        <th>Created By</th>
                        <th>&nbsp;</th>
                    </thead>
                    <tbody>
                        @foreach ($subcategories as $subcategory)
                            <tr>
                                <td>{{ $subcategory->id }}</td>
                                <td>@foreach ($subcategory->categories as $category)
                                        {{ $category->name }}
                                    @endforeach
                                </td>
                                <td>{{ $subcategory->name }}</td>
                                <td>{{ $subcategory->description }}</td>
                                <td>{{ $subcategory->created_at }}</td>
                                <td>{{ $subcategory->created_by }}</td>
                                <td><a href="{{ url('/subcategories/'.$subcategory->id) }}">View</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-xs-9">
            </div>
            <div class="col-xs-3 text-right">
                <a href="{{ url('subcategories/create') }}" class="btn btn-success btn-circle" title="Add More"><i class="fa fa-plus"></i></a>
            </div>
        </div>
    </div>
</div>
@endsection