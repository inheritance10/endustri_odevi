@extends('backend.layout')
@section('content')
    <section class="content-header">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Araçlar</h3>
                @if($user->user_type <= 0)
                <a href="{{route('product-add')}}"><button class="btn btn-info">Araç Ekle</button></a>
                @endif
                <a href="{{route('order-add')}}" class="btn btn-success">Satış Ekle</a>
            </div>
            <div class="box-body">
                @if(session()->has('status'))
                    <div class="alert alert-success">
                        <p>
                            {{session('status')}}
                        </p>
                    </div>
                @endif
                    <form  action="{{route('product-index')}}">
                <div class="row">
                    <div class="col-md-2">
                    <div class="form-group">
                        <label>Kullanım Durumu</label>
                        <select class="form-control select2" name="using_status" style=" ;">
                            <option value="0">Hepsi</option>
                            <option value="1">Yeni</option>
                            <option value="2">2.El</option>
                        </select>
                    </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label >Marka Adı</label>
                            <select class="form-control select2" id="name" name="name" style=" ;">
                                <option selected="selected" value="0" >Hepsi</option>
                                @foreach($brands as $brand)
                                    <option value="{{$brand->id}}">{{$brand->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group">
                            <label>Durum</label>
                            <select class="form-control select2" name="status" style=" ;">
                                <option value="0">Hepsi</option>
                                <option value="1">Mevcut</option>
                                <option value="2">Satıldı</option>
                                <option value="3">Opsiyonlandı</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group">
                            <button type="submit" class="btn btn-info" style="margin-top: 1rem">Filtrele</button>
                        </div>
                    </div>
                </div>
                    </form>
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Araçlar Listesi</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Marka Adı</th>
                                <th>Model Adı</th>
                                <th>Yıl</th>
                                <th>Çekiş Gücü</th>
                                <th>Saat</th>
                                <th>Açıklama</th>
                                <th>Ruhsat</th>
                                <th>Plaka</th>
                                <th>Muayene Tarihi</th>
                                <th>Kredi Miktarı</th>
                                <th>Ücret</th>
                                <th>Kullanım Durumu</th>
                                <th>Durumu</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                            <tr style="@if($product->status == 2) background-color: #F55353 @elseif($product->status == 3) background-color: #BAFFB4 @endif">
                                <td>{{$product->brand_name}}</td>
                                <td>{{$product->model_name}}</td>
                                <td>{{$product->year}}</td>
                                <td>{{$product->capacity}}</td>
                                <td>{{$product->hour}}</td>
                                <td>{{$product->description}}</td>
                                <td>{{$product->license}}</td>
                                <td>{{$product->license_plate}}</td>
                                <td>{{$product->examination_date}}</td>
                                <td>@if($product->credit_amount == null) Belirtilmedi @else {{$product->credit_amount}}@endif</td>
                                <td>{{$product->price}}</td>
                                <td>@if($product->using_status == 1)Yeni @else 2. El @endif</td>
                                <td>@if($product->status == 1) Mevcut @elseif($product->status == 2) Satıldı @else Opsiyonlandı @endif</td>
                                @if(($user->user_type == 1 && $product->status != 2) || $user->user_type == 0)<td><a href="{{route('product-update',['id' => $product->id])}}"><button class="btn btn-success">Düzenle</button></a></td>@endif
                                @if($user->user_type <= 0)<td>@if(!$product->trashed())<a href="{{route('product-delete',['id' => $product->id])}}"><button class="btn btn-danger">Sil</button></a>@else <a href="{{route('product-restore',['id' => $product->id])}}"><button class="btn btn-info">Geri Yükle</button></a> @endif</td>@endif
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
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
    <!-- Select2 -->
    <script src="backend/bower_components/select2/dist/js/select2.full.min.js"></script>

    <script>
        $('.select2').select2()

    </script>
@endsection

