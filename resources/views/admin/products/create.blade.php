@extends('admin/layouts/default')

{{-- Web site Title --}}

@section('title')
    Tạo sản phẩm :: @parent
@stop

@section('header_styles')

    <link type="text/css" href="{{ asset('assets/vendors/bootstrap-multiselect/css/bootstrap-multiselect.css') }}"
          rel="stylesheet"/>
    <link href="{{ asset('assets/vendors/select2/css/select2.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/vendors/select2/css/select2-bootstrap.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/vendors/selectize/css/selectize.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/vendors/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/vendors/iCheck/css/all.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/vendors/iCheck/css/line/line.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/vendors/bootstrap-switch/css/bootstrap-switch.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/vendors/switchery/css/switchery.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/css/pages/formelements.css') }}" rel="stylesheet"/>

@stop

{{-- Content --}}

@section('content')
    <section class="content-header">
        <h1>
            Tạo sản phẩm
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.dashboard') }}"> <i class="livicon" data-name="home" data-size="16"
                                                             data-color="#000"></i> Dashboard
                </a>
            </li>
            <li>Sản phẩm</li>
            <li class="active">
                Tạo sản phẩm
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
                            Tạo sản phẩm
                        </h4>
                    </div>
                    <div class="panel-body">
                        {!! Form::open(array('url' => route('sanpham.created'), 'method' => 'post', 'class' => 'form-horizontal', 'files'=> true)) !!}
                        <div class="form-group">
                            <div class="form-group">

                                <label class="col-md-2 control-label">Tên Cửa Hàng</label>
                                <select class="col-md-9" name="storeid">
                                    <option>---</option>
                                    @foreach ($store as $key => $value)
                                        <option value="{{ $value->store_id }}">{{ $value->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">

                                <label class="col-md-2 control-label">Danh Mục</label>
                                <select class="col-md-9" name="catid">
                                    <option value="">---</option>
                                    @foreach ($cate as $key => $value)
                                        <option value="{{ $value->cat_id }}">{{ $value->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Tên Sản Phẩm</label>
                                <input class="col-md-9" name="name"/>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Mô tả sản phẩm (*)</label>
                                <input class="col-md-9" name="description"/>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Giá</label>
                                <input class="col-md-9" name="price"/>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Giá Tham khảo</label>
                                <input class="col-md-9" name="price_reference"/>
                            </div>
                            <div class="col-md-12">
                                <label class="col-md-2">Ảnh minh họa</label>
                                <div class="col-md-6 control-label" data-provides="fileinput">
                                    <div class=" col-md-6 fileinput-preview thumbnail" data-trigger="fileinput"
                                         style="width: 200px;height: 200px;line-height: 150px;"></div>
                                    <div class="col-md-6">
                                            <span class="btn btn-default btn-file">
                                                <input type="file" name="file"></span>
                                        <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                    </div>
                                </div>
                            </div>

                            <label class="col-md-12">Ảnh mô tả</label>
                            <div class="multi" data-provides="fileinput">
                                <div class="fileinput-preview thumbnail" data-trigger="fileinput"
                                     style="width: 200px;height: 200px;line-height: 150px;"></div>
                                <div class="col-md-6">
                                            <span class="btn btn-default btn-file">
                                                <input type="file" name="file1"></span>
                                    <a href="#" class="btn btn-default fileinput-exists"
                                       data-dismiss="fileinput">Remove</a>
                                </div>
                            </div>
                            <div class="multi" data-provides="fileinput">
                                <div class="fileinput-preview thumbnail" data-trigger="fileinput"
                                     style="width: 200px;height: 200px;line-height: 150px;"></div>
                                <div class="col-md-6">
                                            <span class="btn btn-default btn-file">
                                                <input type="file" name="file2"></span>
                                    <a href="#" class="btn btn-default fileinput-exists"
                                       data-dismiss="fileinput">Remove</a>
                                </div>
                            </div>
                            <div class="multi" data-provides="fileinput">
                                <div class="fileinput-preview thumbnail" data-trigger="fileinput"
                                     style="width: 200px;height: 200px;line-height: 150px;"></div>
                                <div class="col-md-6">
                                            <span class="btn btn-default btn-file">
                                                <input type="file" name="file3"></span>
                                    <a href="#" class="btn btn-default fileinput-exists"
                                       data-dismiss="fileinput">Remove</a>
                                </div>
                            </div>
                            <div class="multi" data-provides="fileinput">
                                <div class="fileinput-preview thumbnail" data-trigger="fileinput"
                                     style="width: 200px;height: 200px;line-height: 150px;"></div>
                                <div class="col-md-6">
                                            <span class="btn btn-default btn-file">
                                                <input type="file" name="file4"></span>
                                    <a href="#" class="btn btn-default fileinput-exists"
                                       data-dismiss="fileinput">Remove</a>
                                </div>
                            </div>
                            <div class="multi" data-provides="fileinput">
                                <div class="fileinput-preview thumbnail" data-trigger="fileinput"
                                     style="width: 200px;height: 200px;line-height: 150px;"></div>
                                <div class="col-md-6">
                                            <span class="btn btn-default btn-file">
                                                <input type="file" name="file5"></span>
                                    <a href="#" class="btn btn-default fileinput-exists"
                                       data-dismiss="fileinput">Remove</a>
                                </div>
                            </div>
                            <hr>
                            <br>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Thêm hashtag</label>
                                {{--<input class="col-md-9" name="hashtag" type="text" id="selectize-tags2" >--}}
                                <input class="col-md-9" name="hashtag" type="text">
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
            </div>
            <!-- row-->
    </section>
@stop
@section('footer_scripts')

    <script src="{{ asset('assets/vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendors/iCheck/js/icheck.js') }}"></script>
    <script src="{{ asset('assets/js/pages/form_examples.js') }}"></script>


    <script language="javascript" type="text/javascript"
            src="{{ asset('assets/vendors/bootstrap-multiselect/js/bootstrap-multiselect.js') }}"></script>
    <script language="javascript" type="text/javascript"
            src="{{ asset('assets/vendors/select2/js/select2.js') }}"></script>
    <script language="javascript" type="text/javascript" src="{{ asset('assets/vendors/sifter/sifter.js') }}"></script>
    <script language="javascript" type="text/javascript"
            src="{{ asset('assets/vendors/microplugin/microplugin.js') }}"></script>
    <script language="javascript" type="text/javascript"
            src="{{ asset('assets/vendors/selectize/js/selectize.min.js') }}"></script>
    <script language="javascript" type="text/javascript"
            src="{{ asset('assets/vendors/iCheck/js/icheck.js') }}"></script>
    <script language="javascript" type="text/javascript"
            src="{{ asset('assets/vendors/bootstrap-switch/js/bootstrap-switch.js') }}"></script>
    <script language="javascript" type="text/javascript"
            src="{{ asset('assets/vendors/switchery/js/switchery.js') }}"></script>
    <script language="javascript" type="text/javascript"
            src="{{ asset('assets/vendors/bootstrap-maxlength/js/bootstrap-maxlength.js') }}"></script>
    <script language="javascript" type="text/javascript"
            src="{{ asset('assets/vendors/card/lib/js/jquery.card.js') }}"></script>
    <script language="javascript" type="text/javascript"
            src="{{ asset('assets/js/pages/custom_elements.js') }}"></script>

@stop
