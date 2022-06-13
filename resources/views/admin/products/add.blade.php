@extends('layouts.admin')

@section('title', 'Thêm Sản Phẩm')

@section('css')
<link rel="stylesheet" href="{{asset('template_admin/plugins/select2/css/select2.min.css')}}" />
    <link rel="stylesheet" href="{{asset('template_admin/customs/product/add/add.css')}}" />
@endsection

@section('content')
    @include('admin.partials.content-header', ['name' => 'Sản Phẩm', 'key' => 'Thêm Sản Phẩm'])
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-12">
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Thêm Sản Phẩm</h3>

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

                            <form action="{{route('admin.menus.store')}}" method="post">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="name">Tên Menu</label>
                                            <input type="text" name="name" id="name" class="form-control" value="{{old('name')}}" placeholder="Nhập tên menu...">
                                            @error('name')
                                            <span style="color: red;">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col-md-6 -->

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="price">Giá Sản Phẩm</label>
                                            <input type="number" name="price" id="price" class="form-control" value="{{old('price')}}" placeholder="Nhập giá...">
                                            @error('price')
                                            <span style="color: red;">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col-md-4 -->

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="feature_image_path">Ảnh Đại Diện</label>
                                            <input type="file" name="feature_image_path" id="feature_image_path" class="form-control-file" value="{{old('price')}}" placeholder="Nhập giá...">
                                            @error('feature_image_path')
                                            <span style="color: red;">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col-md-4 -->

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="parent_id">Chọn Danh Mục</label>
                                            <select name="parent_id" id="parent_id" class="form-control select2_parent_id" style="width: 100%;">
                                                <option value="">Chọn Danh Mục</option>
                                                {!! $htmlOption !!}
                                            </select>
                                            <!-- /# -->
                                            @error('parent_id')
                                            <span style="color: red;">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col-md-4 -->

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="image_path[]">Ảnh Chi Tiết</label>
                                            <input type="file" multiple name="image_path[]" id="image_path[]" class="form-control-file" value="{{old('price')}}" placeholder="Nhập giá...">
                                            @error('image_path[]')
                                            <span style="color: red;">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col-md-4 -->

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tags[]">Nhập Tags cho sản phẩm</label>
                                            <select name="tags[]" class="form-control tags_select_choose" multiple="multiple">

                                            </select>
                                            @error('image_path[]')
                                            <span style="color: red;">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col-md-4 -->

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="content">Mô tả sản phẩm</label>
                                            <textarea class="form-control" name="content" id="content" cols="10" rows="5"></textarea>
                                            <!-- /#content -->
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col-md-12 -->

                                </div>
                                <!-- /.row -->


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
    <script src="{{asset('template_admin/customs/product/add/add.js')}}"></script>
@endsection
