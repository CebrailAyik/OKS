@extends('admin.master')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Ödev Ekleme Sayfası</h3>
                    </div>
                    <form role="form" method="post" action="/admin/odev/store" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Adı</label>
                                <input type="text" name="adi" class="form-control" id="exampleInputEmail1"
                                       placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Soyadı</label>
                                <input type="text" name="soyadi" class="form-control" id="exampleInputPassword1"
                                       placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Ders</label>
                                <input type="text" name="ders" class="form-control" id="exampleInputEmail1"
                                       placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Dosya</label>
                                <input type="file" name="dosya_adi" id="exampleInputFile" required>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"> Check me out
                                </label>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Kaydet</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('css')
@endsection
@section('js')
@endsection