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
                <h4 class="title">Add a new subcategory</h4>
            </div>
            <div class="content">
                <form action="{{ url('subcategories') }}/{{ $subcategory->id }}" role="form" method="POST">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}
                    <div class="row">
                        <div class="col-md-4">
                            <label for="category">Category</label>
                            <select id="category" name="category" class="form-control border-input">
                                <option>Select a category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control border-input" id="name" name="name" value="{{ $subcategory->name }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text" name="description" id="description" class="form-control border-input" value="{{ $subcategory->description }}">
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-success btn-fill btn-wd">Update Subsubcategory</button>
                    </div>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection