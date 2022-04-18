@extends('backend.layout')
@section('content')
    <section class="content-header">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Kullanıcı</h3>
                <a href="{{route('user')}}" style="margin-left: 5px; float: right;"><button class="btn btn-warning">Geri</button></a>
            </div>
            <div class="box-body">
                <p>Kullanıcı Kayıt Formu</p>
                <form action="{{route('user-add-post')}}" method="post">
                    @csrf
                    <div class="col-md-3">
                        <div class="form-group" style=" ">
                            <label for="">İsim Soyisim</label>
                            <input type="text" class="form-control" id="" name="name">
                        </div>
                        <div class="form-group" style=" ">
                            <label for="">E-mail</label>
                            <input type="email" class="form-control" id="" name="email">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group" style=" ">
                            <label for="">Şifre</label>
                            <input type="password" class="form-control" id="license_plate" name="password">
                        </div>
                        <div class="form-group">
                            <label>Kullanıcı Tipi</label>
                            <select class="form-control select2" name="user_type" style="">
                                <option value="0">Yetkili</option>
                                <option value="1">Kullanıcı</option>
                            </select>
                        </div>
                    </div>
                    <div class="input-group-btn" style="position: relative; top:100px;">
                        <button type="submit" class="btn btn-success">Kaydet</button>
                    </div>
                </form>
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
    </script>
@endsection

