@extends('layouts.admin')

@section('title', 'Thêm Nhóm')

@section('css')
@endsection

@section('content')
    @include('admin.partials.content-header', ['name' => 'Nhóm người dùng', 'key' => 'Thêm Nhóm'])
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    @if(session('err'))
                        <div class="alert alert-danger">{{ session('err') }}</div>
                        <!-- /.alert -->
                    @endif

                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Thêm Nhóm</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
{{--                                <button type="button" class="btn btn-tool" data-card-widget="remove">--}}
{{--                                    <i class="fas fa-times"></i>--}}
{{--                                </button>--}}
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body" style="display: block;">

                            <form action="{{route('admin.roles.store')}}" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="name">Tên Nhóm</label>
                                    <input type="text" name="name" id="name" class="form-control" value="{{old('name')}}" placeholder="Tên Nhóm...">
                                    @error('name')
                                    <span style="color: red;">{{$message}}</span>
                                    @enderror
                                </div>
                                <!-- /.form-group -->

                                <div class="form-group">
                                    <label for="password">Tên Hiển Thị(Mô tả)</label>
                                    <input type="text" name="display_name" id="display_name" class="form-control" value="{{old('display_name')}}" placeholder="Tên hiển thị (mô tả)...">
                                    @error('display_name')
                                    <span style="color: red;">{{$message}}</span>
                                    @enderror
                                </div>
                                <!-- /.form-group -->

                            @foreach($permissionsParent as $permissionsItem)
                                <div class="module_parent card card-default mt-4">
                                    <div class="card-header">
                                        <label for=""> <input type="checkbox" class="checkbox_wrapper" value="{{$permissionsItem->id}}"></label>
                                        <h3 class="card-title">Module {{$permissionsItem->display_name}}</h3>

                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body" style="display: block;">
                                        <div class="row">
                                            @foreach($permissionsItem->permissionsChild as $permissionsChildItem)
                                                <div class="col-md-3">
                                                    <label>
                                                        <input type="checkbox" name="permission_id[]"
                                                               class="checkbox_childrent"
                                                               value="{{ $permissionsChildItem->id }}">
                                                    </label>
                                                    {{$permissionsChildItem->display_name}}
                                                </div>
                                                <!-- /.col-md-3 -->
                                            @endforeach
                                        </div>
                                        <!-- /.row -->
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card-body -->
                            @endforeach


                                @csrf
                                <button type="submit" class="btn btn-primary">Thêm</button>
                            </form>

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
    <script src="{{asset('template_admin/customs/roles/add/add.js')}}"></script>
@endsection
