@extends('app')

@section('content')
<h1>aggregate</h1>

@include('errors.form_errors')

@if (!empty($error))
<ul class="alert alert-danger">
    <li>{{ $error }}</li>
</ul>
@endif

<hr/>
<div class="row">
    <div class="col-sm-9">
        {!! Form::open(['url' => 'aggregate']) !!}

        <div class="form-group">
            <label class="col-sm-2 control-label">type</label>
            <div class="col-sm-10">
                {!! Form::select('type',array('1'=>'sales','2'=>'royalty'),'1',['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            <label for="input-start" class="col-sm-2 control-label">start</label>
            <div class="col-sm-10">
                {!! Form::input('date', 'start', date('Y-m-d'), ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            <label for="input-end" class="col-sm-2 control-label">end</label>
            <div class="col-sm-10">
                {!! Form::input('date', 'end', date('Y-m-d'), ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                {!! Form::submit('search', ['class' => 'btn btn-default']) !!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>

<br/>

@if (!empty($data))

<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <table id="sample" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        @foreach ($header as $value)
                        <th>{{ $value }}.</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>

                    @foreach ($data as $store)
                    <tr>
                        @foreach ($store as $value)
                        <th>{{ $value }}</th>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
<link href="DT_bootstrap.css" rel="stylesheet">
<script src="http://code.jquery.com/jquery.js"></script>
<script src="js/jquery.dataTables.min.js"></script>

<script src="http://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    $('table#sample').dataTable();
</script>
@endif

@stop