@extends('layouts.admin')

@section('title', 'Không được phép truy cập')

@section('css')
    <link rel="stylesheet" href="{{asset('template_admin/plugins/select2/css/select2.min.css')}}" />
    <link rel="stylesheet" href="{{asset('template_admin/customs/users/add/add.css')}}" />
@endsection

@section('content')
    @include('admin.partials.content-header', ['name' => 'Home', 'key' => '403 Errors'])

    <section class="content">
        <div class="error-page">
            <h2 class="headline text-danger">403</h2>

            <div class="error-content">
                <h3><i class="fas fa-exclamation-triangle text-danger"></i> Oops! Something went wrong.</h3>

                <p>
                    Bạn không có quyền truy cập vào trang này.<br>
                    Vui lòng <a href="{{route('admin.index')}}">Trở lại trang chủ.</a>
                </p>

            </div>
        </div>
        <!-- /.error-page -->

    </section>
    <!-- /.content -->
    </div>
@endsection

@section('js')
    <script src="{{asset('template_admin/plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="{{asset('template_admin/customs/users/add/add.js')}}"></script>
@endsection
