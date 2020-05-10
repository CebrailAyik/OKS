@extends('admin.master')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Ödev Listesi
                            <a href="/admin/odev/create">
                                <button type="submit" class="btn btn-success btn-sm">
                                    Ödev Ekle
                                </button>
                            </a>
                        </h3>
                        {{--<div class="btn-group ">--}}
                        {{--<button type="button" class="btn btn-block btn-info btn-sm" data-toggle="modal" data-target="#modal-default">--}}
                        {{--Karşılaştır--}}
                        {{--</button>--}}
                        {{--</div>--}}
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="form-group">
                            <label>G.B.Y => GENEL BENZERLİK YÜZDESİ</label>
                        </div>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Adı</th>
                                <th>Soyadı</th>
                                <th>Ders</th>
                                <th>Dosya Adı</th>
                                <th>G.B.Y</th>
                                <th>G.B.Y(Benzer İçeriği Hesaba Katma)</th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach( $odevler as  $odev  )
                                <tr>
                                    <td><div class="checkbox">
                                            <label>
                                                <input type="checkbox">
                                            </label>
                                        </div></td>
                                    <td>{{ $odev->ad }}</td>
                                    <td>{{ $odev->soyad }}</td>
                                    <td>{{ $odev->ders }}</td>
                                    <td>{{ $odev->dosya_adi }}</td>
                                    <td>%{{ $odev->ortalama_akhkatma }}</td>
                                    <td>%{{ $odev->ortalama_akhkat }}</td>
                                    <td><a href="/admin/odev/{{$odev->id}}/benzerlik-karsilastir" class="btn btn-block btn-success btn-sm">Karşılaştır</a></td>
                                    <td><a href="/admin/odev/{{$odev->id}}/edit" class="btn btn-block btn-primary btn-sm">Düzenle</a></td>
                                    <td><a href="/admin/odev/{{$odev->id}}/destroy" class="btn btn-block btn-danger btn-sm"> Sil</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        {{--<div class="modal fade" id="modal-default">--}}
        {{--<div class="modal-dialog modal-lg">--}}
        {{--<div class="modal-content">--}}
        {{--<div class="modal-header">--}}
        {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
        {{--<span aria-hidden="true">&times;</span></button>--}}
        {{--<h4 class="modal-title">Default Modal</h4>--}}
        {{--</div>--}}
        {{--<div class="modal-body">--}}
        {{--<section class="content">--}}
        {{--<div class="row">--}}
        {{--<div class="col-md-12">--}}
        {{--<div class="box">--}}
        {{--<div class="box-header with-border">--}}
        {{--<h3 class="box-title">Benzerlik Tablosu</h3>--}}
        {{--</div>--}}
        {{--<!-- /.box-header -->--}}
        {{--<div class="box-body">--}}
        {{--<table class="table table-bordered">--}}
        {{--<tr>--}}
        {{--<th>Tüm Kelimlerin Sayısı</th>--}}
        {{--<th>Eşleşen Kelimlerin Sayısı</th>--}}
        {{--<th>Benzeliğin Yüzdesi</th>--}}
        {{--</tr>--}}
        {{--<tr>--}}
        {{--<td>100</td>--}}
        {{--<td>50</td>--}}
        {{--<td>50</td>--}}
        {{--</tr>--}}
        {{--<tr>--}}
        {{--<td>100</td>--}}
        {{--<td>50</td>--}}
        {{--<td>50</td>--}}
        {{--</tr>--}}
        {{--</table>--}}
        {{--</div>--}}
        {{--<!-- /.box-body -->--}}
        {{--</div>--}}
        {{--<!-- /.box -->--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</section>--}}
        {{--</div>--}}
        {{--<div class="modal-footer">--}}
        {{--<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<!-- /.modal-content -->--}}
        {{--</div>--}}
        {{--<!-- /.modal-dialog -->--}}
        {{--</div>--}}
    </section>
@endsection

@section('js')
    <script>
        $('#example1').DataTable();
    </script>
@endsection
