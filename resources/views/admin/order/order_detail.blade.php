@extends('admin/layouts/default')

{{-- Web site Title --}}
@section('title')
    Chi tiết đơn hàng
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
        <h1>Chi tiết đơn hàng</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.dashboard') }}"> <i class="livicon" data-name="home" data-size="16"
                                                             data-color="#000"></i>
                    @lang('general.dashboard')
                </a>
            </li>
            <li><a href="#">Đơn hàng</a></li>
            <li class="active">Chi tiết đơn hàng</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-lg-12">

                <div class="col-sm-3">
                    <div class="well">
                    <strong style="font-size: medium">Thông tin đơn hàng:</strong>
                    <br>

                    @if($data->processed_status == 0)
                            <p style="font-size: small">Đơn hàng mới</p>

                            <a href="{{ route('donhang.duyetdh', [$data->invoice_id]) }}">
                                <button class="btn btn-primary"> Duyệt
                                </button>
                            </a>
                            <a href="{{ route('donhang.huydh', [$data->invoice_id]) }}">
                                <button class="btn btn-danger">Hủy
                                </button>
                            </a>
                    @elseif($data->processed_status == 1)
                            <p style="font-size: small">Đơn đã duyệt</p>

                        @elseif($data->processed_status == 2)
                            <p style="font-size: small">Trạng thái: Đã hủy</p>
                        @endif
                </div>
                    <div class="well">
                        <strong style="font-size: medium">Thông tin khách:</strong>
                        <br>
                        <p style="font-size: small">{{ $data->name }}</p>
                        <p style="font-size: small">{{ $data->address }}</p>
                        <p style="font-size: small">{{ $data->phone }}</p>
                        <p style="font-size: small">{{ $data->email }}</p>
                        {{--</div>--}}
                    </div>
                </div>

                <div class="col-sm-9 well">

                    <table class="table" id="table">
                        <thead>
                        <tr class="odd gradeX" align="center">
                            <th>Tên Sản Phẩm</th>
                            <th>Số Lượng</th>
                            <th>Giá Sản Phẩm</th>
                            <th>Tổng Tiền</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($product as $key =>$val): ?>
                        <tr>
                            <td>{{ $val->product_name }}</td>
                            <td>{{ $val->quantity }}</td>
                            <td>{{ number_format($val->order_price,0) }}</td>
                            <td>{{ number_format($val->order_total,0) }}</td>
                        </tr>
                        <?php endforeach ?>
                        </tbody>
                    </table>
                    <strong style="float: right; font-size: medium">Tổng cộng: {{number_format($sum,0)}}</strong>
                    <div class="col-sm-6">
                        <strong style="float: left; font-size: medium">Ghi chú:</strong>
                        <div class="well">
                            {{$data->note}}
                        </div>
                    </div>
                    </div>
                <hr>
            </div>
        </div>
    </section>

@stop
{{-- Body Bottom confirm modal --}}
@section('footer_scripts')
{{--    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/jquery.dataTables.js') }}"></script>--}}
{{--    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/dataTables.bootstrap.js') }}"></script>--}}

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
