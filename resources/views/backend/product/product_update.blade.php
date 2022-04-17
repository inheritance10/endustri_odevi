@extends('backend.layout')
@section('content')
    <section class="content-header">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Araçlar</h3>
                <a href="{{route('product-index')}}" style="margin-left: 5px; float: right;"><button class="btn btn-success">Geri</button></a>
            </div>
            <div class="box-body">
                <p>Araç Güncelleme Formu</p>
                <form action="{{route('product-update-post',['id'=>$products->id])}}" method="post">
                    @csrf
                    <div class="col-md-3">
                        <div class="form-group">
                            <label >Marka Adı</label>
                            <select class="form-control select2" id="name" name="name" style=" ;">
                                <option selected="selected" disabled >Marka Seçiniz}</option>
                                @foreach($brands as $brand)
                                    <option @if($brand->name == $products->brand_name) selected @endif value="{{$brand->id}}">{{$brand->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Model Adı</label>
                            <input type="text" hidden id="hidden_model_id" value="{{$products->model_id}}">
                            <select class="form-control select2" id="model" name="model_id" style=" ;">
                                <option selected="selected" disabled >Model Seçiniz</option>
                            </select>
                        </div>
                        <div class="form-group" style=" ">
                            <label for="">Ruhsat</label>
                            <input type="text" class="form-control" id="" name="license" value="{{$products->license}}">
                        </div>
                        <div class="form-group">
                            <label>Muayene Tarihi</label>
                            <div class="input-group date" style=" ;">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input autocomplete="off" type="text" class="form-control pull-right" id="datepicker" name="examination_date" value="{{$products->examination_date}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Kullanım Durumu</label>
                            <select class="form-control select2" name="using_status" style=" ;">
                                <option @if($products->using_status == 1) selected @endif value="1">Yeni(0)</option>
                                <option @if($products->using_status == 2) selected @endif  value="2">2.El</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group" style=" ">
                            <label for="">Plaka</label>
                            <input type="text" class="form-control" id="license_plate" name="license_plate" value="{{$products->license_plate}}">
                        </div>
                        <div class="form-group" style=" ">
                            <label for="">Kredi Miktarı</label>
                            <input type="number" class="form-control" id="credit_amount" name="credit_amount" value="{{$products->credit_amount}}">
                        </div>
                        <div class="form-group" style=" ">
                            <label for="">Ücret</label>
                            <input type="number" class="form-control" id="price" name="price" value="{{$products->price}}">
                        </div>
                        <div class="form-group" style=" ">
                            <label>Açıklama</label>
                            <textarea class="form-control" rows="3" placeholder="Enter ..." name="description">{{$products->description}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Durum</label>
                            <select class="form-control select2" name="status" style=" ;">
                                <option @if($products->status == 1) selected @endif  value="1">Mevcut</option>
                                <option @if($products->status == 2) selected @endif value="2">Satıldı</option>
                                <option @if($products->status == 3) selected @endif value="3">Opsiyonlandı</option>
                            </select>
                        </div>
                    </div>
                    <div class="input-group-btn">
                        <button type="submit" class="btn btn-success">Güncelle</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@section('css')
    <!-- daterange picker -->
    <link rel="stylesheet" href="/backend/bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="/backend/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="/backend/bower_components/select2/dist/css/select2.min.css">


@endsection

@section('js')
    <!-- bootstrap datepicker -->
    <script src="/backend/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <!-- Select2 -->
    <script src="/backend/bower_components/select2/dist/js/select2.full.min.js"></script>

    <script>
        $('.select2').select2()

        $(document).ready(function () {
            var selected = $("#name :selected").val();
            $.get("/get-models/" + selected, function (data) {
                console.log(data)
                $('#model').html('').select2({
                    data: data
                }).val($('#hidden_model_id').val()).trigger('change')

            });
        });
        //Date picker
        $('#datepicker').datepicker({
            autoclose: true
        })
        $('#name').on('change', function () {
            var selected = $("#name :selected").val();
            $.get("/get-models/" + selected, function (data) {
                console.log(data)
                $('#model').html('').select2({
                    data: data
                })

            });
        })
    </script>
@endsection
