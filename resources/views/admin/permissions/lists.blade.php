@extends('layouts.admin')

@section('title', 'Quản lý Modules')

@section('css')
<link rel="stylesheet" href="{{asset('template_admin/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
@endsection
@section('content')
    @include('admin.partials.content-header', ['name' => 'Module', 'key' => 'Quản lý Modules'])

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
                            <h3 class="card-title">Quản lý Modules</h3>

                            <div class="card-tools">
                                <a href="{{route('admin.permissions.create')}}" class="btn btn-block btn-primary btn-flat btn-sm">Thêm mới</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body" style="display: block;">

                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th width="10%">STT</th>
                                    <th>Tên</th>
                                    <th>Key</th>
                                    <th width="15%">Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @if($lists->count()>0)
                                    @foreach($lists as $key => $item)
                                        <tr>
                                            <td>{{$item->id}}</td>
                                            <td>{{$item->display_name}}</td>
                                            <td>{{$item->name}}</td>
                                            <td>
                                                <a href="{{route('admin.permissions.edit', $item)}}" class="btn btn-warning">Sửa</a>
                                                <a href="#" data-url="{{route('admin.permissions.delete', $item)}}" class="btn btn-danger action_delete">Xoá</a>
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
    <script src="{{asset('template_admin/customs/permissions/lists/lists.js')}}"></script>
@endsection
