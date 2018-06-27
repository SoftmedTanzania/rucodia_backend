@extends('layouts.admin')
@section('content')
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">{{ $subcategory->name }} Details</h4>
                                <p class="subcategory">showing...</p>
                            </div>
                            <div class="content">
                                <div class="typo-line">
                                    <h2><p class="subcategory">Cat</p>{{ $subcategory->name }} <br><small>Name</small> </h2>
                                </div>
                                <div class="typo-line">
                                    <h2><p class="subcategory">Details</p>{{ $subcategory->description }} <br><small>Description</small> </h2>
                                </div>
                                <div class="typo-line">
                                    <h2><p class="subcategory">Meta</p>{{ $subcategory->created_at }} <br><small>Created At</small> </h2>
                                </div>
                                <div class="typo-line">
                                    <h2><p class="subcategory">ID</p>{{ $subcategory->uuid }} <br><small>UUID</small> </h2>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="text-center">
                            <a href="{{url('subcategories')}}/{{$subcategory->id}}/edit" type="submit" class="btn btn-success btn-fill btn-wd">Update Subcategory</a>
                        </div>
                    </div>
                    <div class="col-sm-4">&nbsp;</div>
                    <div class="col-sm-4">
                        <div class="text-center">
                            <form action="{{ url('subcategories') }}/{{ $subcategory->id }}" role="form" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-danger btn-fill btn-wd">Delete Subcategory</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection