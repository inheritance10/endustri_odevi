@extends('backend.layout')
@section('content')
    <section class="content-header">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Kayıtlar</h3>
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
{{--                    <div class="box-header">
                        <h3 class="box-title">Kayıt Listesi</h3>
                    </div>--}}
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Kullanıcı</th>
                                <th>İşlem</th>
                                <th>Tarih</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($logs as $log)
                                <tr>
                                    <td>{{$log->IslemYapan}}</td>
                                    <td>{{$log->YapilanIslem}}</td>
                                    <td>{{$log->created_at}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

            </div>
        </div>
    </section>
@endsection

@section('css')
@endsection

@section('js')
@endsection

