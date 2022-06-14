@extends('layouts.admin')

@section('title', 'Thêm Người dùng')

@section('css')
<link rel="stylesheet" href="{{asset('template_admin/plugins/select2/css/select2.min.css')}}" />
<link rel="stylesheet" href="{{asset('template_admin/customs/users/add/add.css')}}" />
@endsection

@section('content')
    @include('admin.partials.content-header', ['name' => 'Người dùng', 'key' => 'Thêm Người dùng'])
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
                            <h3 class="card-title">Thêm Người dùng</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body" style="display: block;">

                            <form action="{{route('admin.users.store')}}" method="post">
                                <div class="form-group">
                                    <label for="name">Họ tên</label>
                                    <input type="text" name="name" id="name" class="form-control" value="{{old('name')}}" placeholder="Họ tên...">
                                    @error('name')
                                    <span style="color: red;">{{$message}}</span>
                                    @enderror
                                </div>
                                <!-- /.form-group -->

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" class="form-control" value="{{old('email')}}" placeholder="Email...">
                                    @error('email')
                                    <span style="color: red;">{{$message}}</span>
                                    @enderror
                                </div>
                                <!-- /.form-group -->

                                <div class="form-group">
                                    <label for="password">Mật khẩu</label>
                                    <input type="text" name="password" id="password" class="form-control" value="{{old('password')}}" placeholder="Mật khẩu...">
                                    @error('password')
                                    <span style="color: red;">{{$message}}</span>
                                    @enderror
                                </div>
                                <!-- /.form-group -->

                                <div class="form-group">
                                    <label for="role">Chọn vai trò</label>
                                    <select name="role[]" id="role[]" class="form-control select2_init" multiple>
                                        <option value="">Chọn vai trò</option>
                                        @foreach($roles as $role)
                                            <option value="{{$role->id}}">{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                    <!-- /# -->
                                    @error('role')
                                    <span style="color: red;">{{$message}}</span>
                                    @enderror
                                </div>
                                <!-- /.form-group -->
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
    <script src="{{asset('template_admin/plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="{{asset('template_admin/customs/users/add/add.js')}}"></script>
@endsection
