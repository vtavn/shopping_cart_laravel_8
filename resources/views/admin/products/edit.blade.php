@extends('layouts.admin')

@section('title', 'Sửa Sản Phẩm')

@section('css')
    <link rel="stylesheet" href="{{asset('template_admin/plugins/select2/css/select2.min.css')}}" />
    <link rel="stylesheet" href="{{asset('template_admin/plugins/summernote/summernote-bs4.min.css')}}">
    <link rel="stylesheet" href="{{asset('template_admin/customs/product/add/add.css')}}" />
@endsection

@section('content')
    @include('admin.partials.content-header', ['name' => 'Sản Phẩm', 'key' => 'Sửa Sản Phẩm'])
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-12">
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Sửa Sản Phẩm</h3>

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

                            <form action="{{route('admin.products.update', ['id' => $data->id])}}" enctype="multipart/form-data" method="post">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="name">Tên Sản Phẩm</label>
                                            <input type="text" name="name" id="name" class="form-control" value="{{old('name') ?? $data->name}}" placeholder="Nhập tên sản phẩm...">
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
                                            <input type="number" name="price" id="price" class="form-control" value="{{old('price') ?? $data->price}}" placeholder="Nhập giá...">
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
                                            <div class="col-md-12 mt-2">
                                                <div class="row">
                                                    <img class="product-image" src="{{$data->feature_image_path}}" alt="{{$data->name}}">
                                                </div>
                                                <!-- /.row -->
                                            </div>
                                            <!-- /.col-md-12 -->
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col-md-4 -->

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="category_id">Chọn Danh Mục</label>
                                            <select name="category_id" id="category_id" class="form-control select2_parent_id" style="width: 100%;">
                                                <option value="">Chọn Danh Mục</option>
                                                {!! $htmlOption !!}
                                            </select>
                                            <!-- /# -->
                                            @error('category_id')
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

                                            <div class="col-md-12">
                                                <div class="row">
                                                    @foreach($data->images as $imgItem)
                                                       <div class="col-md-3">
                                                           <img class="product-image-thumb" src="{{$imgItem->image_path}}" alt="">
                                                       </div>
                                                       <!-- /.col-md-3 -->
                                                    @endforeach
                                                </div>
                                                <!-- /.row -->
                                            </div>
                                            <!-- /.col-md-12 -->
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col-md-4 -->

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tags[]">Nhập Tags cho sản phẩm</label>
                                            <select name="tags[]" class="form-control tags_select_choose" multiple="multiple">
                                                @foreach($data->tags as $itemTag)
                                                    <option value="{{$itemTag->name}}" selected>{{$itemTag->name}}</option>
                                                @endforeach
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
                                            <label for="contents">Mô tả sản phẩm</label>
                                            @error('contents')
                                            <span style="color: red;">{{$message}}</span>
                                            @enderror
                                            <textarea class="form-control" name="contents" id="contents" cols="10" rows="10">{{old('contents') ?? $data->content}}</textarea>
                                            <!-- /#content -->
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col-md-12 -->

                                </div>
                                <!-- /.row -->


                                @csrf
                                <button type="submit" class="btn btn-primary">Sửa</button>
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
    {{--    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>--}}
    <script src="{{asset('template_admin/plugins/summernote/summernote-bs4.min.js')}}"></script>

    <script src="{{asset('template_admin/customs/product/add/add.js')}}"></script>
@endsection
