@extends('layouts.admin')

@section('title', 'Chỉnh sửa chuyên mục')

@section('content')
    @include('admin.partials.content-header', ['name' => 'Chuyên Mục', 'key' => 'Chỉnh sửa Chuyên Mục'])
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-12">
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Chỉnh sửa Chuyên Mục</h3>

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
                            @if(session('msg'))
                                <div class="alert alert-success">{{ session('msg') }}</div>
                                <!-- /.alert -->
                            @endif
                                <!-- /.alert -->
                            <form action="{{route('admin.categories.update', ['id' => $category->id])}}" method="post">
                                <div class="form-group">
                                    <label for="name">Tên chuyên mục</label>
                                    <input type="text" name="name" id="name" class="form-control" value="{{old('name') ?? $category->name}}" placeholder="Nhập tên chuyên mục...">
                                    @error('name')
                                    <span style="color: red;">{{$message}}</span>
                                    @enderror
                                </div>
                                <!-- /.form-group -->
                                <div class="form-group">
                                    <label for="parent_id">Chọn danh mục cha</label>
                                    <select name="parent_id" id="parent_id" class="form-control">
                                        <option value="0">Chọn danh mục cha</option>
                                        {!! $htmlOption !!}
                                    </select>
                                    <!-- /# -->
                                    @error('parent_id')
                                    <span style="color: red;">{{$message}}</span>
                                    @enderror
                                </div>
                                <!-- /.form-group -->
                                @csrf
                                <button type="submit" class="btn btn-primary">Cập nhật</button>
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
