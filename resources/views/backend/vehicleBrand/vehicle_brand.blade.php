@extends('backend.layout')
@section('content')
    <section class="content-header">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Ürünler</h3>
            </div>
            <div class="box-body">
                <p>Ürün Kayıt Formu</p>
                <form action="">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Marka Adı</label>
                            <select class="form-control select2" style="width: 50%;">
                                <option selected="selected">Alabama</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Model Adı</label>
                            <select class="form-control select2" style="width: 50%;">
                                <option selected="selected">Alabama</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Muayene Tarihi</label>
                            <div class="input-group date" style="width: 50%;">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control pull-right" id="datepicker">
                            </div>
                        </div>
                        <div class="form-group" style="width: 50%">
                            <label for="">Ruhsat</label>
                            <input type="password" class="form-control" id="">
                        </div>
                        <div class="form-group">
                            <label>Kullanım Durumu</label>
                            <select class="form-control select2" style="width: 50%;">
                                <option selected="selected">Alabama</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" style="width: 50%">
                            <label for="">Plaka</label>
                            <input type="password" class="form-control" id="">
                        </div>
                        <div class="form-group" style="width: 50%">
                            <label for="">Kredi Miktarı</label>
                            <input type="number" class="form-control" id="">
                        </div>
                        <div class="form-group" style="width: 50%">
                            <label for="">Ücret</label>
                            <input type="number" class="form-control" id="">
                        </div>
                        <div class="form-group" style="width: 50%">
                            <label>Açıklama</label>
                            <textarea class="form-control" rows="3" placeholder="Enter ..."></textarea>
                        </div>
                        <div class="form-group">
                            <label>Durum</label>
                            <select class="form-control select2" style="width: 50%;">
                                <option selected="selected">Alabama</option>
                            </select>
                        </div>
                    </div>
                    <div class="input-group-btn">
                        <button type="button" class="btn btn-success">Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@section('css')
@endsection

@section('js')
@endsection

