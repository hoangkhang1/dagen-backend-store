@extends('admin/layouts/default')

{{-- Web site Title --}}

@section('title')
    Tạo mới danh mục
@stop

{{-- Content --}}

@section('content')
    <section class="content-header">
        <h1>
            Tạo mới danh mục
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.dashboard') }}"> <i class="livicon" data-name="home" data-size="16"
                                                             data-color="#000"></i> Dashboard
                </a>
            </li>
            <li>Tạo mới danh mục</li>
            <li class="active">
                Tạo mới danh mục
            </li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-primary ">
                    <div class="panel-heading">
                        <h4 class="panel-title"><i class="livicon" data-name="users-add" data-size="16" data-loop="true"
                                                   data-c="#fff" data-hc="white"></i>
                            Tạo mới danh mục
                        </h4>
                    </div>
                    <div class="panel-body">
                        {!! Form::open(array('url' => route('danhmuc.created'), 'method' => 'post', 'class' => 'form-horizontal', 'files'=> true)) !!}
                        <div class="form-group">
                            <div class="col-sm-12">
                                <div class="col-sm-2">
                                    <h5 class="text-right">Chọn cửa hàng:</h5>
                                </div>
                                <div class="col-sm-10">
                                    {{--<h5 class="text-right">Mô tả danh mục (*)</h5>--}}
                                    <select class="form-control" name="store">
                                        {{--<option>---</option>--}}
                                        @foreach ($store as $key => $value)
                                            <option value="{{ $value->store_id }}">{{ $value->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12">

                                <div class="col-sm-2">
                                    <h5 class="text-right">Tên danh mục (*)</h5>
                                </div>
                                <div class="col-sm-10">
                                    <input name="name_cat" class="form-control required" type="text"
                                           placeholder="Nhập tên danh mục">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="col-sm-2">
                                    <h5 class="text-right">Mô tả danh mục (*)</h5>
                                </div>
                                <div class="col-sm-10">
                                    <input name="description" class="form-control required" type="text"
                                           placeholder="Nhập mô tả danh mục">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-4">
                                <a class="btn btn-danger" href="{{ route('danhmuc.index') }}">
                                    Hủy
                                </a>
                                <button type="submit" class="btn btn-success">
                                    Tạo mới
                                </button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
        <!-- row-->
    </section>
@stop
