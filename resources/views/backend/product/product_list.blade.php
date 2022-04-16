@extends('backend.layout')
@section('content')
    <section class="content-header">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Araçlar</h3>
                @if($user->user_type <= 0)
                <a href="{{route('product-add')}}"><button class="btn btn-success">Araç Ekle</button></a>
                @endif
            </div>
            <div class="box-body">
                @if(session()->has('status'))
                    <div class="alert alert-success">
                        <p>
                            {{session('status')}}
                        </p>
                    </div>
                @endif

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
                                <td>{{$product->description}}</td>
                                <td>{{$product->license}}</td>
                                <td>{{$product->license_plate}}</td>
                                <td>{{$product->examination_date}}</td>
                                <td>@if($product->credit_amount == null) Belirtilmedi @else {{$product->credit_amount}}@endif</td>
                                <td>{{$product->price}}</td>
                                <td>@if($product->using_status == 1)Yeni @else 2. El @endif</td>
                                <td>@if($product->status == 1) Mevcut @elseif($product->status == 2) Satıldı @else Opsiyonlandı @endif</td>
                                @if($user->user_type <= 0)<td><a href="{{route('product-update',['id' => $product->id])}}"><button class="btn btn-success">Düzenle</button></a></td>@endif
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
@endsection

@section('js')
@endsection

