@extends('layouts.admin')

@section('title', 'Danh sách Người dùng')

@section('css')
<link rel="stylesheet" href="{{asset('template_admin/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
@endsection
@section('content')
    @include('admin.partials.content-header', ['name' => 'Người dùng', 'key' => 'Danh Sách Người dùng'])

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-12">
                    @if(session('msg'))
                        <div class="alert alert-success">{{ session('msg') }}</div>
                        <!-- /.alert -->
                    @endif

                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Danh sách Người dùng</h3>

                            <div class="card-tools">
                                <a href="{{route('admin.users.create')}}" class="btn btn-block btn-primary btn-flat btn-sm">Thêm mới</a>
                                {{--                                <button type="button" class="btn btn-tool" data-card-widget="collapse">--}}
{{--                                    <i class="fas fa-minus"></i>--}}
{{--                                </button>--}}
{{--                                <button type="button" class="btn btn-tool" data-card-widget="remove">--}}
{{--                                    <i class="fas fa-times"></i>--}}
{{--                                </button>--}}
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body" style="display: block;">

                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th width="10%">STT</th>
                                    <th>Tên</th>
                                    <th>Email</th>
                                    <th width="15%">Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @if($users->count()>0)
                                    @foreach($users as $key => $user)
                                        <tr>
                                            <td>{{$user->id}}</td>
                                            <td>{{$user->name}}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                <a href="{{route('admin.users.edit', ['id' => $user->id])}}" class="btn btn-warning">Sửa</a>
                                                <a href="#" data-url="{{route('admin.users.delete', ['id' => $user->id])}}" class="btn btn-danger action_delete">Xoá</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>

                            <div class="d-flex mt-3 justify-content-center">
                                {{ $users->links() }}
                            </div>
                            <!-- /.col-md-12 -->
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer" style="display: block;">
                            @cuacua
                        </div>
                    </div>

                </div>
                <!-- /.col-12 -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
    </div>
@endsection

@section('js')
    <script src="{{asset('template_admin/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
    <script src="{{asset('template_admin/customs/users/lists/lists.js')}}"></script>
@endsection
