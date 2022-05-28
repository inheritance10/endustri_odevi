@extends('backend.layout')
@section('content')
    <section class="content-header">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Satışlar</h3>
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
                        <h3 class="box-title">Araçlar</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Marka Adı</th>
                                <th>Model Adı</th>
                                <th>Satış tarihi</th>
                                <th>Kredi Miktarı</th>
                                <th>Müşteri Adı</th>
                                <th>Ücret</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td>{{$order->brand_name}}</td>
                                    <td>{{$order->model_name}}</td>
                                    <td>{{$order->sold_date}}</td>
                                    <td>{{$order->credit_amount}}</td>
                                    <td><a href="{{route('customer-data', $order->customer_data_id ?? 0)}}">{{$order->full_name}}</a></td>
                                    <td>{{$order->price}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <h3>Toplam Satış Geliri: {{$orders->sum('price')}} ₺</h3>
                        <h3>Bu Ay Toplam Satış Geliri: {{$ordersThisMonth->sum('price')}} ₺</h3>
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

