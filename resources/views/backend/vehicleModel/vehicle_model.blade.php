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
                        <div class="form-group" style="width: 50%;">
                            <label>Model Adı</label>
                            <input type="text" class="form-control" id="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" style="width: 50%">
                            <label for="">Marka Adı</label>
                            <input type="text" class="form-control" id="">
                        </div>
                        <div class="form-group" style="width: 50%">
                            <label>Açıklama</label>
                            <textarea class="form-control" rows="3" placeholder="Enter ..."></textarea>
                        </div>
                        <div class="form-group" style="width: 50%">
                            <label for="">Marka Adı</label>
                            <input type="number" class="form-control" id="">
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

