@extends('layouts.admin')
@section('content')
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">{{ $category->name }} Details</h4>
                                <p class="category">showing...</p>
                            </div>
                            <div class="content">
                                <div class="typo-line">
                                    <h2><p class="category">Cat</p>{{ $category->name }} <br><small>Name</small> </h2>
                                </div>
                                <div class="typo-line">
                                    <h2><p class="category">Details</p>{{ $category->description }} <br><small>Description</small> </h2>
                                </div>
                                <div class="typo-line">
                                    <h2><p class="category">Meta</p>{{ $category->created_at }} <br><small>Created At</small> </h2>
                                </div>
                                <div class="typo-line">
                                    <h2><p class="category">ID</p>{{ $category->uuid }} <br><small>UUID</small> </h2>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="text-center">
                            <a href="{{url('categories')}}/{{$category->id}}/edit" type="submit" class="btn btn-success btn-fill btn-wd">Update Category</a>
                        </div>
                    </div>
                    <div class="col-sm-4">&nbsp;</div>
                    <div class="col-sm-4">
                        <div class="text-center">
                            <form action="{{ url('categories') }}/{{ $category->id }}" role="form" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-danger btn-fill btn-wd">Delete Category</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection