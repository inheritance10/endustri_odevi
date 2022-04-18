@extends('backend.layout')
@section('content')
    <section class="content-header">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Kullanıcılar</h3>
                    <a href="{{route('user-add')}}"><button class="btn btn-success">Kullanıcı Ekle</button></a>
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
                        <h3 class="box-title">Kullanıcı Listesi</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>İsim Soyisim</th>
                                <th>Kullanıcı Tipi</th>
                                <th>E-mail</th>
                                <th>Password</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr style="">
                                    <td>{{$user->name}}</td>
                                    <td>
                                        @if($user->user_type == 0)
                                            Yetkili
                                        @elseif($user->user_type == 1)
                                            Kullanıcı
                                    @endif
                                    </td>
                                    <td>{{$user->email}}</td>
                                    <td><a href="{{route('user-update',['id' => $user->id])}}"><button class="btn btn-success">Düzenle</button></a></td>
                                    <td><a href="{{route('user-delete',['id' => $user->id])}}"><button class="btn btn-danger">Sil</button></a></td>
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

