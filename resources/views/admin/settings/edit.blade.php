@extends('layouts.admin')

@section('title', 'Sửa Cài Đặt')

@section('css')

@endsection

@section('content')
    @include('admin.partials.content-header', ['name' => 'Cài đặt', 'key' => 'Sửa Cài Đặt'])
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-12">
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Sửa Cài Đặt</h3>

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

                            <form action="{{route('admin.settings.update', ['id' => $data->id])}}" method="post">
                                <div class="form-group">
                                    <label for="name">Config Key</label>
                                    <input type="text" name="config_key" id="config_key" class="form-control" value="{{old('config_key') ?? $data->config_key}}" placeholder="Nhập config_key...">
                                    @error('config_key')
                                    <span style="color: red;">{{$message}}</span>
                                    @enderror
                                </div>
                                <!-- /.form-group -->

                                <div class="form-group">
                                    <label for="contents">Config Value</label>
                                    @error('config_value')
                                    <span style="color: red;">{{$message}}</span>
                                    @enderror
                                    <textarea class="form-control" name="config_value" id="config_value" cols="10" rows="10" placeholder="Nhập config value...">{{old('config_value') ?? $data->config_value}}</textarea>
                                    <!-- /#config_value -->
                                </div>
                                <!-- /.form-group -->
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

@endsection
