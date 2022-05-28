@extends('backend.layout')
@section('content')
    <section class="content-header">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Satış Kaydı</h3>
            </div>
            <div class="box-body">
                <p>Satış Kayıt Bilgileri</p>
                <a href="{{route('order')}}" style="margin-left: 5px; float: right;"><button class="btn btn-warning">Geri</button></a>
                    @csrf
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Satış Tarihi</label>
                                <input autocomplete="off" type="text" class="form-control" name="sold_date" value="{{$customer_data->sold_date}}" disabled>
                        </div>
                        <div class="form-group" style="">
                            <label for="">İsim Soyisim</label>
                            <input type="text" class="form-control" id="price" name="full_name" value="{{$customer_data->full_name}}" disabled>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Araç Plakası -- Fiyatı</label>
                            <input class="form-control" id="model" name="product_id" value="{{$customer_data->license_plate}} -- {{$customer_data->price}}₺" disabled style="">
                        </div>
                        <div class="form-group">
                            <label>Açıklama</label>
                            <input class="form-control" value="{{$desc}}"  name="description" disabled>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Telefon</label>
                            <input name="phone" id="phone" class="form-control" type="text" value="{{$customer_data->phone}}" disabled>
                        </div>
                        <div class="form-group">
                            <label>Adres</label>
                            <input name="address" id="address" class="form-control" value="{{$customer_data->address}}"  disabled>
                        </div>
                    </div>

            </div>
        </div>
    </section>
@endsection

@section('css')
    <!-- daterange picker -->
    <link rel="stylesheet" href="backend/bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="backend/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="backend/bower_components/select2/dist/css/select2.min.css">


@endsection

@section('js')
    <!-- bootstrap datepicker -->
    <script src="backend/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <!-- Select2 -->
    <script src="backend/bower_components/select2/dist/js/select2.full.min.js"></script>
    <script src="js/jquery.inputmask.bundle.min.js"></script>

    <script>
        $('.select2').select2()

        //Date picker
        $('#datepicker').datepicker({
            autoclose: true
        })
        $('#name').on('change', function () {
            var selected = $("#name :selected").val();
            $.get("get-models/" + selected, function (data) {
                console.log(data)
                $('#model').html('').select2({
                    data: data
                })

            });
        })
        $('.phone').inputmask('(999)-999-9999');
    </script>
@endsection
