@extends('layouts.admin')

@section('title', 'Danh sách Sản phẩm')

@section('content')
    @include('admin.partials.content-header', ['name' => 'Sản Phẩm', 'key' => 'Danh Sách Sản Phẩm'])

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
                            <h3 class="card-title">Danh sách Sản Phẩm</h3>

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

                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th width="10%">STT</th>
                                    <th>Tên Sản Phẩm</th>
                                    <th>Giá</th>
                                    <th>Hình Ảnh</th>
                                    <th>Danh Mục</th>
                                    <th width="15%">Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @if($lists->count()>0)
                                    @foreach($lists as $key => $item)
                                        <tr>
                                            <td>{{$item->id}}</td>
                                            <td>{{$item->name}}</td>
                                            <td>{{$item->price}}</td>
                                            <td>
                                                <img src="" alt="">
                                            </td>
                                            <td>
                                                danh mục
                                            </td>
                                            <td>
                                                <a href="{{route('admin.menus.edit', ['id' => $item->id])}}" class="btn btn-warning">Sửa</a>
                                                <a onclick="return confirm('Bạn có chắc chắn muốn xoá?');" href="{{route('admin.menus.delete', ['id' => $item->id])}}" class="btn btn-danger">Xoá</a>
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
