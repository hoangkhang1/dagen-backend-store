@extends('admin/layouts/default')

{{-- Web site Title --}}
@section('title')
    Danh sách đơn hàng
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
        <h1>Danh sách đơn hàng</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.dashboard') }}"> <i class="livicon" data-name="home" data-size="16"
                                                             data-color="#000"></i>
                    @lang('general.dashboard')
                </a>
            </li>
            <li><a href="#">Danh mục</a></li>
            <li class="active">Danh sách</li>
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
                            Danh sách đơn hàng
                        </h4>
                    </div>
                    <br/>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table" id="table">
                                <thead>
                                <tr class="odd gradeX" align="center">
                                    <th>ID</th>
                                    <th>Trạng thái</th>
                                    <th>Ngày</th>
                                    <th>Tên Khách Hàng</th>
                                    <th>SĐT</th>
                                    <th>Tổng tiền</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($data as $key => $val): ?>
                                <tr class="odd gradeX" align="center">
                                    <td style="color: #00A9D5">{{ $val->order_code }}</td>
                                    @if($val->processed_status == 0)
                                        <td style="color: #00cc66">Chưa xữ lý</td>
                                    @elseif($val->processed_status == 1)
                                        <td style="color: #00A1CB">ĐH đã duyệt</td>
                                    @else($val->processed_status == 2)
                                        <td style="color: #AE0E0E;">ĐH hủy</td>
                                    @endif
                                    <td>{{ $val->created_at }}</td>
                                    <td style="color: blue">{{ $val->name }}</td>
                                    <td>{{ $val->phone }}</td>
                                    <td style="color: red">{{ number_format($val->total,0) }}</td>
                                    <td class="center">
                                        @if($val->processed_status > 0)
                                            <a href="{{ route('donhang.xemchitietdh', [$val->id_invoice]) }}">
                                                <button class="btn btn-primary"><i class="fa fa-info"></i>
                                                </button>
                                            </a>
                                        @else
                                            <a href="{{ route('donhang.xemchitietdh', [$val->invoice_id]) }}">
                                                <button class="btn btn-primary"><i class="fa fa-info"></i>
                                                </button>
                                            </a>
                                            <a href="{{ route('donhang.duyetdh', [$val->invoice_id]) }}">
                                                <button class="btn btn-success"><i class="fa fa-pencil"></i>
                                                </button>
                                            </a>
                                            <a href="{{ route('donhang.huydh', [$val->invoice_id]) }}">
                                                <button class="btn btn-danger"><i class="fa fa-trash-o"></i>
                                                </button>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <?php endforeach ?>
                                </tbody>
                            </table>
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
