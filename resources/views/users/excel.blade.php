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
                <h4 class="title">Import Excel or CSV file</a></h4>
            </div>
            <div class="content">
                <form action="{{ url('excel/import/mass') }}" role="form" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="spreadsheet">File to import</label>
                                <input type="file" class="form-control border-input" id="spreadsheet" name="spreadsheet">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <button type="submit" class="btn btn-success btn-fill btn-wd">Import File</button>
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
