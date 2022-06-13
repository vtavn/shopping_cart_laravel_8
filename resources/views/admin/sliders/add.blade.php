@extends('layouts.admin')

@section('title', 'Thêm Slider')

@section('css')
    <link rel="stylesheet" href="{{asset('template_admin/plugins/summernote/summernote-bs4.min.css')}}">
@endsection

@section('content')
    @include('admin.partials.content-header', ['name' => 'Slider', 'key' => 'Thêm Slider'])
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-12">
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Thêm Slider</h3>

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

                            <form action="{{route('admin.sliders.store')}}" enctype="multipart/form-data" method="post">
                                <div class="form-group">
                                    <label for="name">Tên Slider</label>
                                    <input type="text" name="name" id="name" class="form-control" value="{{old('name')}}" placeholder="Nhập tên menu...">
                                    @error('name')
                                    <span style="color: red;">{{$message}}</span>
                                    @enderror
                                </div>
                                <!-- /.form-group -->

                                <div class="form-group">
                                    <label for="contents">Mô tả</label>
                                    @error('description')
                                    <span style="color: red;">{{$message}}</span>
                                    @enderror
                                    <textarea class="form-control" name="description" id="description" cols="10" rows="10" placeholder="Nhập mô tả...">{{old('description')}}</textarea>
                                    <!-- /#content -->
                                </div>
                                <!-- /.form-group -->

                                <div class="form-group">
                                    <label for="name">Hình ảnh</label>
                                    <input type="file" name="image_path" id="image_path" class="form-control-file" value="{{old('image_path')}}">
                                    @error('image_path')
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
    <script src="{{asset('template_admin/plugins/summernote/summernote-bs4.min.js')}}"></script>
    <script src="{{asset('template_admin/customs/sliders/add/add.js')}}"></script>
@endsection
