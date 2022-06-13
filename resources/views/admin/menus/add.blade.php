@extends('layouts.admin')

@section('title', 'Thêm Menu')

@section('content')
    @include('admin.partials.content-header', ['name' => 'Menu', 'key' => 'Thêm Menu'])
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-12">
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Thêm Menu</h3>

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
                                <div class="form-group">
                                    <label for="name">Tên Menu</label>
                                    <input type="text" name="name" id="name" class="form-control" value="{{old('name')}}" placeholder="Nhập tên menu...">
                                    @error('name')
                                    <span style="color: red;">{{$message}}</span>
                                    @enderror
                                </div>
                                <!-- /.form-group -->
                                <div class="form-group">
                                    <label for="parent_id">Chọn menu cha</label>
                                    <select name="parent_id" id="parent_id" class="form-control">
                                        <option value="0">Chọn menu cha</option>
                                        {!! $htmlOption !!}
                                    </select>
                                    <!-- /# -->
                                    @error('parent_id')
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
