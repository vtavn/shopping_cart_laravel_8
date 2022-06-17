@extends('layouts.admin')

@section('title', 'Thêm Module')

@section('css')

@endsection

@section('content')
    @include('admin.partials.content-header', ['name' => 'Modules', 'key' => 'Thêm Module'])
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-12">
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Thêm Module</h3>

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

                            <form action="{{route('admin.permissions.store')}}" method="post">
                                <div class="form-group">
                                    <label for="name">Tên Module</label>
                                    <input type="text" name="display_name" id="display_name" class="form-control" value="{{old('display_name')}}" placeholder="Nhập tên module...">
                                    @error('display_name')
                                    <span style="color: red;">{{$message}}</span>
                                    @enderror
                                </div>
                                <!-- /.form-group -->

                                <div class="form-group">
                                    <label for="name">Config Value</label>
                                    <input type="text" name="name" id="name" class="form-control" value="{{old('name')}}" placeholder="Nhập Key Module...">
                                    @error('name')
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

@endsection
