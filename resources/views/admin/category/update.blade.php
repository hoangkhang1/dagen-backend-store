@extends('admin/layouts/default')

{{-- Web site Title --}}

@section('title')
    @lang('blogcategory/title.create') :: @parent
@stop

{{-- Content --}}

@section('content')
    <section class="content-header">
        <h1>
            @lang('blogcategory/title.create')
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.dashboard') }}"> <i class="livicon" data-name="home" data-size="16"
                                                             data-color="#000"></i> Dashboard
                </a>
            </li>
            <li>@lang('blogcategory/title.blogcategories')</li>
            <li class="active">
                @lang('blogcategory/title.create')
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
                            @lang('blogcategory/title.create')
                        </h4>
                    </div>
                    <div class="panel-body">
                        {!! Form::open(array('url' => url('danh-muc/update',$data->cat_id), 'method' => 'post', 'class' => 'form-horizontal', 'files'=> true)) !!}
                        <div class="form-group">
                            <label>Tên Cửa Hàng</label>
                            <select class="form-control" name="store">
                                {{--<option>---</option>--}}
                                @foreach ($store as $key => $value)
                                    <option value="{{ $value->store_id }}">{{ $value->title }}</option>
                                @endforeach
                            </select>
                            <div class="col-sm-2">
                                <h5 class="text-right">Tên danh mục (*)</h5>
                            </div>
                            <div class="col-sm-10">
                                <input name="name_cat" class="form-control required" type="text"
                                       placeholder="Nhập tên danh mục"
                                       value="{!! old('total', $data->name) !!}">
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <h5 class="text-right">Mô tả danh mục (*)</h5>
                        </div>
                        <div class="col-sm-10">
                            <input name="description" class="form-control required" type="text"
                                   placeholder="Nhập mô tả danh mục"
                                   value="{!! old('total', $data->description) !!}">
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-4">
                                <a class="btn btn-danger" href="{{ route('danhmuc.index') }}">
                                    Hủy
                                </a>
                                <button type="submit" class="btn btn-success">
                                    Hoàn tất
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
