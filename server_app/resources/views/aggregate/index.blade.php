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

<div onclick="obj=document.getElementById('notice').style; obj.display=(obj.display=='none')?'block':'none';">
<a style="cursor:pointer;">表示の注意</a>
</div>
<!--// 折りたたみ -->
<!-- 折りたたまれ -->
<div id="notice" style="display:none;clear:both;">
<ul>
    <li>salse</li>
    サービススイッチを除いたコインの投入数です。
    2月以降のデータが表示できます。
    <li>royalty</li>
    写真の出力数です。
    5月以降のデータが表示できます。
    <li>データについて</li>
    主に第2弾以降のデータを対象に集計しています。
    5月以降は完全に第二弾で集計しているため、5月時点で第一弾の筐体は0として表示されます。<br>
</ul>
</div>

<div class="row">
    <div class="col-sm-9">
        {!! Form::open(['url' => 'aggregate']) !!}

        <div class="form-group">
            <label class="col-sm-2 control-label">type</label>
            <div class="col-sm-10">
                {!! Form::select('type',array('1'=>'sales','2'=>'royalty'),Input::old('type', Input::get('type')),['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            <label for="input-start" class="col-sm-2 control-label">start</label>
            <div class="col-sm-10">
                {!! Form::input('date', 'start', Input::old(date('Y-m-d'), Input::get('start')), ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            <label for="input-end" class="col-sm-2 control-label">end</label>
            <div class="col-sm-10">
                <!-- {!! Form::input('date', 'end', date('Y-m-d'), ['class' => 'form-control']) !!} -->
                {!! Form::input('date', 'end', Input::old(date('Y-m-d'), Input::get('end')), ['class' => 'form-control']) !!}
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

@if (!empty($fileList))
<br/>
<!-- 折りたたみ -->
<div onclick="obj=document.getElementById('csv').style; obj.display=(obj.display=='none')?'block':'none';">
<a style="cursor:pointer;">クリックでダウンロードリスト展開</a>
</div>
<!--// 折りたたみ -->
<!-- 折りたたまれ -->
<div id="csv" style="display:none;clear:both;">
    @foreach ($fileList as $file)
    <a href="{{ url('aggregate', $file) }}">{{$file}}</a><br/>
    @endforeach

</div>
<!--// 折りたたまれ -->
@endif
<br/>



@if (!empty($data))
※項目名をクリックでソートできます
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