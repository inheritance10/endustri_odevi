@extends('backend.layout')
@section('content')
    <section class="content-header">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Ürünler</h3>
            </div>
            <div class="box-body">
                <p>Ürünler Sayfası</p>
                @if(session()->has('status'))
                    <div class="alert alert-success">
                        <p>
                            {{session('status')}}
                        </p>
                    </div>
                @endif
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Ürünler Listesi</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Marka Adı</th>
                                <th>Model Adı</th>
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
                            <tr>
                                <td>{{$product->name}}</td>
                                <td>{{$product->model_id}}</td>
                                <td>{{$product->description}}</td>
                                <td>{{$product->license}}</td>
                                <td>{{$product->license_plate}}</td>
                                <td>{{$product->examination_date}}</td>
                                <td>{{$product->credit_amount}}</td>
                                <td>{{$product->price}}</td>
                                <td>{{$product->using_status}}</td>
                                <td>{{$product->status}}</td>
                                <td><a href="{{route('product-update',['id' => $product->id])}}"><button class="btn btn-success">Düzenle</button></a></td>
                                <td><a href="{{route('product-delete',['id' => $product->id])}}"><button class="btn btn-success">Sil</button></a></td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                    <a href="{{route('product-add')}}"><button class="btn btn-success">Ürün Ekle</button></a>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('css')
@endsection

@section('js')
@endsection

