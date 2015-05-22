@extends('app')

@section('content')
<h1>aggregate</h1>

<hr/>
<div class="row">
    <div class="col-sm-9">
    {!! Form::open(['url' => 'search']) !!}

        <div class="form-group">
            <label class="col-sm-2 control-label">type</label>
            <div class="col-sm-10">
                {!! Form::select('type',array('1'=>'sales','2'=>'royalty'),'1',['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            <label for="input-start" class="col-sm-2 control-label">start</label>
            <div class="col-sm-10">
                {!! Form::input('date', 'published_at', date('Y-m-d'), ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            <label for="input-end" class="col-sm-2 control-label">end</label>
            <div class="col-sm-10">
                {!! Form::input('date', 'published_at', date('Y-m-d'), ['class' => 'form-control']) !!}
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

<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <table id="sample" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr><th>背番号</th><th>選手名</th><th>ポジション</th><th>所属クラブ</th><th>備考</th></tr>
                </thead>
                <tbody>
                    <tr><td>1</td><td>楢崎正剛</td><td>GK</td><td>名古屋グランパス</td><td></td></tr>
                    <tr><td>2</td><td>阿部勇樹</td><td>MF</td><td>浦和レッズ</td><td></td></tr>
                    <tr><td>3</td><td>駒野友一</td><td>DF</td><td>ジュビロ磐田</td><td></td></tr>
                    <tr><td>4</td><td>田中マルクス闘莉王</td><td>DF</td><td>名古屋グランパス</td><td></td></tr>
                    <tr><td>5</td><td>長友佑都</td><td>DF</td><td>FC東京</td><td></td></tr>
                    <tr><td>6</td><td>内田篤人</td><td>DF</td><td>鹿島アントラーズ</td><td></td></tr>
                    <tr><td>7</td><td>遠藤保仁</td><td>MF</td><td>ガンバ大阪</td><td></td></tr>
                    <tr><td>8</td><td>松井大輔</td><td>MF</td><td>グルノーブル</td><td></td></tr>
                    <tr><td>9</td><td>岡崎慎司</td><td>FW</td><td>清水エスパルス</td><td></td></tr>
                    <tr><td>10</td><td>中村俊輔</td><td>MF</td><td>横浜F・マリノス</td><td></td></tr>
                    <tr><td>11</td><td>玉田圭司</td><td>FW</td><td>名古屋グランパス</td><td></td></tr>
                    <tr><td>12</td><td>矢野貴章</td><td>FW</td><td>アルビレックス新潟</td><td></td></tr>
                    <tr><td>13</td><td>岩政大樹</td><td>DF</td><td>鹿島アントラーズ</td><td></td></tr>
                    <tr><td>14</td><td>中村憲剛</td><td>MF</td><td>川崎フロンターレ</td><td></td></tr>
                    <tr><td>15</td><td>今野泰幸</td><td>DF</td><td>FC東京</td><td></td></tr>
                    <tr><td>16</td><td>大久保嘉人</td><td>FW</td><td>ヴィッセル神戸</td><td></td></tr>
                    <tr><td>17</td><td>長谷部誠</td><td>MF</td><td>ヴォルフスブルク</td><td></td></tr>
                    <tr><td>18</td><td>本田圭佑</td><td>MF</td><td>CSKAモスクワ</td><td></td></tr>
                    <tr><td>19</td><td>森本貴幸</td><td>FW</td><td>カターニア</td><td></td></tr>
                    <tr><td>20</td><td>稲本潤一</td><td>MF</td><td>川崎フロンターレ</td><td></td></tr>
                    <tr><td>21</td><td>川島永嗣</td><td>GK</td><td>川崎フロンターレ</td><td></td></tr>
                    <tr><td>22</td><td>中澤佑二</td><td>DF</td><td>横浜F・マリノス</td><td></td></tr>
                    <tr><td>23</td><td>川口能活</td><td>GK</td><td>ジュビロ磐田</td><td></td></tr>
                    <tr><td>x</td><td>徳永悠平</td><td></td><td>FC東京</td><td>予備登録メンバー</td></tr>
                    <tr><td>x</td><td>槙野智章</td><td></td><td>サンフレッチェ広島</td><td>予備登録メンバー</td></tr>
                    <tr><td>x</td><td>石川直宏</td><td></td><td>FC東京</td><td>予備登録メンバー</td></tr>
                    <tr><td>x</td><td>小笠原満男</td><td></td><td>鹿島アントラーズ</td><td>予備登録メンバー</td></tr>
                    <tr><td>x</td><td>香川真司</td><td></td><td>セレッソ大阪</td><td>予備登録メンバー</td></tr>
                    <tr><td>x</td><td>前田遼一</td><td></td><td>ジュビロ磐田</td><td>予備登録メンバー</td></tr>
                    <tr><td>x</td><td>田中達也</td><td></td><td>浦和レッズ</td><td>予備登録メンバー</td></tr>
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

@stop
