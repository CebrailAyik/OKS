@extends('admin.master')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Ödev Düzenleme Sayfası</h3>
                    </div>
                    <form role="form" method="post" action="/admin/odev/{{$odev->id}}/update"
                          enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputAdi">Adı</label>
                                <input type="text" name="adi" class="form-control" id="exampleInputAdi" placeholder=""
                                       value=" {{$odev->ad ? $odev->ad : ''}} ">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputSoyadi">Soyadı</label>
                                <input type="text" name="soyadi" class="form-control" id="exampleInputSoyadi"
                                       placeholder=""
                                       value=" {{$odev->soyad ? $odev->soyad : ''}} ">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputDers">Ders</label>
                                <input type="text" name="ders" class="form-control" id="exampleInputDers" placeholder=""
                                       value=" {{$odev->ders ? $odev->ders : ''}} ">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Dosya</label>
                                <input type="file" name="dosya_adi" id="exampleInputFile"
                                       value="{{$odev->dosya_adi ? $odev->dosya_adi : ''}}" required>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Güncelle</button>
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