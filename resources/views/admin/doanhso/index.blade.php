@extends('admin/layouts/default')
@section('head')
    <link href="{{ asset('css/khang.css') }}" rel="stylesheet">

@endsection

{{-- Web site Title --}}
@section('title')
    Doanh số cửa hàng
    @parent
@stop
@section('header_styles')
    <link rel="stylesheet" type="text/css"
          href="{{ asset('assets/vendors/datatables/css/dataTables.bootstrap.css') }}"/>
    <link href="{{ asset('assets/css/pages/tables.css') }}" rel="stylesheet" type="text/css"/>
@stop

{{-- Montent --}}
@section('content')
    <section class="content-header">
        <h1>Doanh số cửa hàng</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.dashboard') }}"> <i class="livicon" data-name="home" data-size="16"
                                                             data-color="#000"></i>
                    @lang('general.dashboard')
                </a>
            </li>
            <li><a href="#">Doanh số</a></li>
            {{--<li class="active">Danh sách</li>--}}
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-12">

                <div class="panel panel-primary ">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title pull-left"><i class="livicon" data-name="users" data-size="16"
                                                             data-loop="true" data-c="#fff" data-hc="white"></i>
                            Doanh số cửa hàng
                        </h4>
                        <div class="pull-right">
                            <a href="{{ route('danhmuc.create') }}" class="btn btn-sm btn-default"><span
                                        class="glyphicon glyphicon-plus"></span> Tạo danh mục</a>
                        </div>
                    </div>
                    <br/>
                    <div class="panel-body">
                        <div class="col-lg-12" style="padding-bottom:120px">
                            <div class="col-lg-4 well">
                                <p style="font-size: medium">Cửa hàng:</p>
                                <p style="font-size: medium">{{$store->nameStore}}</p>
                                <p style=" font-size: medium">{{$store->store_address}}</p>
                            </div>
                            <div class="col-lg-8">

                            <form action="{{route('doanhso.index')}}" method="GET" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Từ ngày</label>
                                    <input name="tungay" type="date">
                                    <label>Đến ngày</label>
                                    <input name="denngay" type="date">
                                    <button type="submit">Tính</button>
                                </div>
                            </form>
                            </div>
                            @if(!empty($data))
                                <table class="table table-striped table-bordered table-hover" id="customers">
                                    <thead class="odd gradeX" align="center">
                                    <tr class="odd gradeX" align="center">
                                        <th>STT</th>
                                        <th>Tên cửa hàng</th>
                                        <th>Chủ cửa hàng</th>
                                        <th>Địa chỉ cửa hàng</th>
                                        <th>Người mua</th>
                                        <th>Số điện thoại</th>
                                        <th>Ngày mua</th>
                                        <th>Tổng tiền</th>
                                        <th>Trạng thái đơn hàng</th>
                                    </tr>
                                    </thead>
                                    <tbody><?php $x = 1;?>
                                    {{--                            @foreach($data as $val)--}}
                                    <tr class="odd gradeX" align="center">
                                        <td>
                                            {{$x}}
                                        </td>
                                        <td>{{$thongtin->nameStore}}</td>
                                        <td>{{$thongtin->chucuahang}}</td>
                                        <td>{{$thongtin->store_address}}</td>
                                        <td>{{$thongtin->tennguoimua}}</td>
                                        <td>{{$thongtin->sdtnguoimua}}</td>
                                        <td>{{$thongtin->ngaymua}}</td>
                                        <td>{{number_format($data)}}</td>
                                        <td>{{$thongtin->trangthaidonhang}}</td>
                                    </tr>
                                    <?php
                                    $x++;
                                    ?>
                                    {{--@endforeach--}}
                                    </tbody>
                                </table>
                            @else
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>    <!-- row-->
    </section>

@stop
{{-- Body Bottom confirm modal --}}
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
@stop
