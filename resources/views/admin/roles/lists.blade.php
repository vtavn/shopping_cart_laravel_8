@extends('layouts.admin')

@section('title', 'Danh sách Nhóm')

@section('css')
<link rel="stylesheet" href="{{asset('template_admin/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
@endsection
@section('content')
    @include('admin.partials.content-header', ['name' => 'Nhóm người dùng', 'key' => 'Danh Sách Nhóm'])

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
                            <h3 class="card-title">Danh sách Nhóm</h3>

                            <div class="card-tools">
                                <a href="{{route('admin.roles.create')}}" class="btn btn-block btn-primary btn-flat btn-sm">Thêm mới</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body" style="display: block;">

                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th width="10%">STT</th>
                                    <th>Tên</th>
                                    <th>Mô tả</th>
                                    <th width="15%">Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @if($lists->count()>0)
                                    @foreach($lists as $key => $role)
                                        <tr>
                                            <td>{{$role->id}}</td>
                                            <td>{{$role->name}}</td>
                                            <td>{{$role->display_name}}</td>
                                            <td>
                                                <a href="{{route('admin.roles.edit', ['id' => $role->id])}}" class="btn btn-warning">Sửa</a>
                                                <a href="#" data-url="{{route('admin.roles.delete', ['id' => $role->id])}}" class="btn btn-danger action_delete">Xoá</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>

                            <div class="d-flex mt-3 justify-content-center">
                                {{ $lists->links() }}
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
    <script src="{{asset('template_admin/customs/roles/lists/lists.js')}}"></script>
@endsection
