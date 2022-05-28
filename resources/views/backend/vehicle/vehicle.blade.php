@extends('backend.layout')
@section('content')
    <section class="content-header">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Araç</h3>
            </div>
            <div class="box-body">
                @if(session()->has('status'))
                    <div class="alert alert-warning">
                        <p>
                            {{session('status')}}
                        </p>
                    </div>
                @endif

                <p>Araç Marka-Model Sayfası</p>
                <div class="col-md-6">
                    <div class="form-group">
                        <form action="{{route('brand-add-post')}}" method="post">
                            @csrf
                            <div class="col-md-6">
                                <div class="form-group" style="">
                                    <label for="">Marka Adı</label>
                                    <input type="text" class="form-control" id="" name="name">
                                </div>
                            </div>
                            <div class="col-md-3" style="margin-top: 25px">
                                <div class="input-group-btn" >
                                    <button type="submit" class="btn btn-success">Marka Ekle</button>
                                </div>
                            </div>
                        </form>
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Marka Adı</th>
                                <th>İşlem</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($vehicle_brand as $brand)
                            <tr>
                                <td>{{$brand->name}}</td>
                                <td><a href="{{route('brand-delete',['id' => $brand->id])}}"><button class="btn btn-danger">Sil</button></a></td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <form action="{{route('model-add-post')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label >Marka Adı</label>
                                <select class="form-control select2" id="brand_id" name="brand_id" style=" ;">
                                    <option selected="selected" disabled >Marka Seçiniz</option>
                                    @foreach($vehicle_brand as $brand)
                                        <option value="{{$brand->id}}">{{$brand->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Model Adı</label>
                                    <input type="text" class="form-control" id="" name="name">
                                </div>
                                <div class="form-group">
                                    <label for="">Yıl</label>
                                    <input type="number" class="form-control" id="" name="year">
                                </div>
                            </div>
                            <div class="col-md-3" style="margin-top: 105px">
                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-success">Model Ekle</button>
                                </div>
                            </div>
                        </form>
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Model Adı</th>
                                <th>İşlem</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($vehicle_model as $model)
                                <tr>
                                    <td>{{$model->name}}</td>
                                    <td><a href="{{route('model-delete',['id'=>$model->id])}}"><button class="btn btn-danger">Sil</button></a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('css')
    <!-- Select2 -->
    <link rel="stylesheet" href="backend/bower_components/select2/dist/css/select2.min.css">
@endsection

@section('js')
    <script src="backend/bower_components/select2/dist/js/select2.full.min.js"></script>
    <script>
        $('.select2').select2()
    </script>
@endsection


