@extends('admin/layouts/default')

{{-- Web site Title --}}
@section('title')
    Dashboar
    @parent
@stop
@section('header_styles')

    <link rel="stylesheet" type="text/css"
          href="{{ asset('assets/vendors/datatables/css/dataTables.bootstrap.css') }}"/>
    <link href="{{ asset('assets/css/pages/tables.css') }}" rel="stylesheet" type="text/css"/>

    <link href="{{ asset('assets/vendors/fullcalendar/css/fullcalendar.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/pages/calendar_custom.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" media="all"
          href="{{ asset('assets/vendors/bower-jvectormap/css/jquery-jvectormap-1.2.2.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/vendors/animate/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages/only_dashboard.css') }}"/>
    <meta name="_token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('assets/vendors/smalotDatepicker/css/bootstrap-datetimepicker.min.css') }}">

@stop

{{-- Montent --}}
@section('content')
    <section class="content-header">
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.dashboard') }}"> <i class="livicon" data-name="home" data-size="16"
                                                             data-color="#000"></i>
                    @lang('general.dashboard')
                </a>
            </li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 margin_10 animated fadeInLeftBig">
                <div class="lightbluebg no-radius">
                    <div class="panel-body squarebox square_boxs">
                        <div class="col-xs-12 pull-left nopadmar">
                            <div class="row">
                                <div class="square_box col-xs-7 text-right">
                                    <span>Đơn hàng mới</span>
                                    <div class="number">{{$donhang}}</div>
                                </div>
                                <i class="livicon" data-name="responsive" data-size="50" data-c="#fff" data-hc="#fff"
                                   data-loop="true"></i>
                            </div>
                            {{--<div class="row">--}}
                            {{--<a href="{{ route('donhang.index') }}" class="btn btn-sm btn-default"><span--}}
                            {{--></span> Quản lý đơn hàng</a>--}}
                            {{--</div>--}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 margin_10 animated fadeInLeftBig">
                <div class="redbg no-radius">
                    <div class="panel-body squarebox square_boxs">
                        <div class="col-xs-12 pull-left nopadmar">
                            <div class="row">
                                <div class="square_box col-xs-7 text-right">
                                    <span>New Comment</span>
                                    <div class="number">{{$comment}}</div>
                                </div>
                                <i class="livicon" data-name="responsive" data-size="50" data-c="#fff" data-hc="#fff"
                                   data-loop="true"></i>
                            </div>
                            {{--<div class="row">--}}
                            {{--<a href="{{ route('comment.index') }}" class="btn btn-sm btn-default"><span--}}
                            {{--></span> Quản lý Comment</a>--}}
                            {{--</div>--}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 margin_10 animated fadeInLeftBig">
                <div class="goldbg no-radius">
                    <div class="panel-body squarebox square_boxs">
                        <div class="col-xs-12 pull-left nopadmar">
                            <div class="row">
                                <div class="square_box col-xs-7 text-right">
                                    <span>Tổng số sản phẩm</span>
                                    <div class="number">{{$product}}</div>
                                </div>
                                {{--<i class="livicon" data-name="responsive" data-size="50" data-c="#fff" data-hc="#fff"--}}
                                {{--data-loop="true"></i>--}}
                                <i class="livicon" data-name="shopping-cart" data-size="50" data-c="#fff" data-hc="#fff"
                                   data-loop="true"></i>
                            </div>
                            {{--<div class="row">--}}
                            {{--<a href="{{ route('sanpham.index') }}" class="btn btn-sm btn-default"><span--}}
                            {{--></span> Quản lý Sản phẩm</a>--}}
                            {{--</div>--}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 margin_10 animated fadeInLeftBig">
                <div class="palebluecolorbg no-radius">
                    <div class="panel-body squarebox square_boxs">
                        <div class="col-xs-12 pull-left nopadmar">
                            <div class="row">
                                <div class="square_box col-xs-7 text-right">
                                    <span>Tổng số danh mục</span>
                                    <div class="number">{{$category}}</div>
                                </div>
                                <i class="livicon" data-name="responsive" data-size="50" data-c="#fff" data-hc="#fff"
                                   data-loop="true"></i>

                            </div>
                            {{--<div class="row">--}}
                            {{--<a href="{{ route('danhmuc.index') }}" class="btn btn-sm btn-default"><span--}}
                            {{--></span> Quản lý danh mục</a>--}}
                            {{--</div>--}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="panel panel-primary ">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title pull-left"><i class="livicon" data-name="users"
                                                             data-size="16"
                                                             data-loop="true" data-c="#fff"
                                                             data-hc="white"></i>
                            Thông tin cửa hàng
                        </h4>
                    </div>
                    <br/>
                    <div class="panel-body">
                        <div class="table-responsive">
                            @if (empty($store->store_image))
                                <td><img src="{{url('upload')}}/image.png" width="50px" height="50px"></td>
                            @else
                                <td>
                                    <img src="{{url('http://dagen.miennam24h.vn/public/product_image')}}/{{$store->store_image}}"
                                         width="50px" height="50px"></td>
                            @endif
                            <br>
                            <span>Tên cửa hàng: {{$store->title}}</span>
                            <br>
                            <span>Mô tả: {{$store->desctiption}}</span>
                            <br>
                            <span>Địa chỉ cửa hàng: {{$store->store_address}}</span>
                            <br>

                            <span>Số điện thoại cửa hàng: {{$store->store_phone}}</span>
                            <br>
                            <span>Email cửa hàng: {{$store->store_email}}</span>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="panel panel-primary ">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title pull-left"><i class="livicon" data-name="users"
                                                             data-size="16"
                                                             data-loop="true" data-c="#fff"
                                                             data-hc="white"></i>
                            Thông tin Nhân viên
                        </h4>
                    </div>
                    <br/>
                    <div class="panel-body">
                        <div class="table-responsive">
                            @if (empty($user->store_login_avatar))
                                <img src="{{url('upload')}}/image.png" width="50px" height="50px">
                            @else
                                <img src="{{url('http://dagen.miennam24h.vn/public/user')}}/{{$user->store_login_avatar}}"
                                         width="50px" height="50px">
                            @endif
                            <br>
                            <span>Tên nhân viên: {{$user->store_login_name}}</span>
                            <br>
                            <span>Số điện thoại: {{$user->store_login_phone}}</span>
                            <br>
                            <span>Email: {{$user->store_login_email}}</span>
                            <br>
                            <span>Địa chỉ: {{$user->store_login_address}}</span>
                            <br>
                                <span>Chứng minh thư: {{$user->store_login_cmnd}}</span>
                            <br>

                            @if($user->store_login_sex == 1)
                                <span>Giới tính: Nam</span>
                            @elseif($user->store_login_sex == 0)
                                <span>Giới tính: Nữ</span>

                                <br>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@stop
Body Bottom confirm modal
@section('footer_scripts')
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/jquery.dataTables.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/dataTables.bootstrap.js') }}"></script>

    <script>
        $(document).ready(function () {
            $('#table').DataTable();
        });
    </script>
    <div class="modal fade" id="delete_confirm" tabindex="-1" role="dialog"
         aria-labelledby="blogcategory_delete_confirm_title" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            </div>
        </div>
    </div>
    <div class="modal fade" id="blogcategory_exists" tabindex="-2" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                </div>
                <div class="modal-body">
                    @lang('blogcategory/message.blogcategory_have_blog')
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function () {
            $('body').on('hidden.bs.modal', '.modal', function () {
                $(this).removeData('bs.modal');
            });
        });
        $(document).on("click", ".blogcategory_exists", function () {

            var group_name = $(this).data('name');
            $(".modal-header h4").text(group_name + " blog category");
        });</script>
    <script type="text/javascript" src="{{ asset('assets/vendors/moment/js/moment.min.js') }}"></script>
    <script type="text/javascript"
            src="{{ asset('assets/vendors/smalotDatepicker/js/bootstrap-datetimepicker.min.js') }}"></script>

    {{--<!-- EASY PIE CHART JS -->--}}
    {{--<script src="{{ asset('assets/vendors/bower-jquery-easyPieChart/js/easypiechart.min.js') }}"></script>--}}
    {{--<script src="{{ asset('assets/vendors/bower-jquery-easyPieChart/js/jquery.easypiechart.min.js') }}"></script>--}}
    {{--<script src="{{ asset('assets/vendors/bower-jquery-easyPieChart/js/jquery.easingpie.js') }}"></script>--}}
    {{--<!--for calendar-->--}}
    {{--<script src="{{ asset('assets/vendors/moment/js/moment.min.js') }}" type="text/javascript"></script>--}}
    {{--<script src="{{ asset('assets/vendors/fullcalendar/js/fullcalendar.min.js') }}" type="text/javascript"></script>--}}
    {{--<!--   Realtime Server Load  -->--}}
    {{--<script src="{{ asset('assets/vendors/flotchart/js/jquery.flot.js') }}" type="text/javascript"></script>--}}
    {{--<script src="{{ asset('assets/vendors/flotchart/js/jquery.flot.resize.js') }}" type="text/javascript"></script>--}}
    {{--<!--Sparkline Chart-->--}}
    {{--<script src="{{ asset('assets/vendors/sparklinecharts/jquery.sparkline.js') }}"></script>--}}
    {{--<!-- Back to Top-->--}}
    {{--<script type="text/javascript" src="{{ asset('assets/vendors/countUp_js/js/countUp.js') }}"></script>--}}
    {{--<!--   maps -->--}}
    {{--<script src="{{ asset('assets/vendors/bower-jvectormap/js/jquery-jvectormap-1.2.2.min.js') }}"></script>--}}
    {{--<script src="{{ asset('assets/vendors/bower-jvectormap/js/jquery-jvectormap-world-mill-en.js') }}"></script>--}}
    {{--<!--  todolist-->--}}
    {{--<script src="{{ asset('assets/js/pages/todolist.js') }}"></script>--}}
    {{--<script src="{{ asset('assets/js/pages/dashboard.js') }}" type="text/javascript"></script>--}}
@stop
{{--@section('footer_scripts')--}}


{{--<script type="text/javascript" src="{{ asset('assets/vendors/moment/js/moment.min.js') }}"></script>--}}
{{--<script type="text/javascript" src="{{ asset('assets/vendors/smalotDatepicker/js/bootstrap-datetimepicker.min.js') }}"></script>--}}

{{--<!-- EASY PIE CHART JS -->--}}
{{--<script src="{{ asset('assets/vendors/bower-jquery-easyPieChart/js/easypiechart.min.js') }}"></script>--}}
{{--<script src="{{ asset('assets/vendors/bower-jquery-easyPieChart/js/jquery.easypiechart.min.js') }}"></script>--}}
{{--<script src="{{ asset('assets/vendors/bower-jquery-easyPieChart/js/jquery.easingpie.js') }}"></script>--}}
{{--<!--for calendar-->--}}
{{--<script src="{{ asset('assets/vendors/moment/js/moment.min.js') }}" type="text/javascript"></script>--}}
{{--<script src="{{ asset('assets/vendors/fullcalendar/js/fullcalendar.min.js') }}" type="text/javascript"></script>--}}
{{--<!--   Realtime Server Load  -->--}}
{{--<script src="{{ asset('assets/vendors/flotchart/js/jquery.flot.js') }}" type="text/javascript"></script>--}}
{{--<script src="{{ asset('assets/vendors/flotchart/js/jquery.flot.resize.js') }}" type="text/javascript"></script>--}}
{{--<!--Sparkline Chart-->--}}
{{--<script src="{{ asset('assets/vendors/sparklinecharts/jquery.sparkline.js') }}"></script>--}}
{{--<!-- Back to Top-->--}}
{{--<script type="text/javascript" src="{{ asset('assets/vendors/countUp_js/js/countUp.js') }}"></script>--}}
{{--<!--   maps -->--}}
{{--<script src="{{ asset('assets/vendors/bower-jvectormap/js/jquery-jvectormap-1.2.2.min.js') }}"></script>--}}
{{--<script src="{{ asset('assets/vendors/bower-jvectormap/js/jquery-jvectormap-world-mill-en.js') }}"></script>--}}
{{--<!--  todolist-->--}}
{{--<script src="{{ asset('assets/js/pages/todolist.js') }}"></script>--}}
{{--<script src="{{ asset('assets/js/pages/dashboard.js') }}" type="text/javascript"></script>--}}

{{--@stop--}}