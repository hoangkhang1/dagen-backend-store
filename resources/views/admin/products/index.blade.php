@extends('admin/layouts/default')

{{-- Web site Title --}}
@section('title')
    Danh sách sản phẩm
    @parent
@stop
@section('header_styles')
    <link rel="stylesheet" type="text/css"
          href="{{ asset('assets/vendors/datatables/css/dataTables.bootstrap.css') }}"/>
    <link href="{{ asset('assets/css/pages/tables.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('css/khang.css') }}" rel="stylesheet">

@stop

{{-- Montent --}}
@section('content')
    <section class="content-header">
        <h1>Danh sách sản phẩm</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.dashboard') }}"> <i class="livicon" data-name="home" data-size="16"
                                                             data-color="#000"></i>
                    @lang('general.dashboard')
                </a>
            </li>
            <li><a href="#">Sản phẩm</a></li>
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
                            Danh sách sản phẩm
                        </h4>
                        <div class="pull-right">
                            <a href="{{ route('sanpham.create') }}" class="btn btn-sm btn-default"><span
                                        class="glyphicon glyphicon-plus"></span> Thêm sản phẩm</a>
                        </div>
                    </div>
                    <br/>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table" id="table">
                                <thead>
                                <tr>
                                    <th>Hình ảnh</th>
                                    <th>Tên</th>
                                    <th>Mã SP</th>
                                    <th>Giá</th>
                                    <th>Danh Mục</th>
                                    <th>Hashtag</th>
                                    <th>Tùy Chọn</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(!empty($data))
                                    @foreach ($data as $value)
                                        {{--{{dd($value)}}--}}
                                        <tr>
                                            @if (empty($value->image_front))
                                                <td><img src="{{url('upload')}}/image.png" width="50px" height="50px">
                                                </td>
                                            @else
                                                <td>
                                                    <img src="{{url('http://dagen.miennam24h.vn/public/product_image')}}/{{$value->image_front}}"
                                                         width="50px" height="50px"></td>
                                            @endif
                                            <td>{{ $value->sanpham }}</td>
                                            <td style="color: #00A1CB">{{ $value->sku }}</td>
                                            <td style="color: red">{{ number_format($value->price,0) }}</td>
                                                <td>{{ $value->description }}</td>

                                            <td>{{ $value->hashtag }}</td>

                                            <td class="center">
                                                <a href="{{ route('sanpham.edit',[$value->id]) }}">
                                                    <button class="btn btn-success"><i class="fa fa-pencil"></i>
                                                    </button>
                                                </a>
                                                {{--<a href="{{ route('sanpham.comment',[$value->product_id]) }}">--}}
                                                {{--<button class="btn btn-warning"><i class="fa fa-comments"></i></button>--}}
                                                {{--</a>--}}
                                                <a href="{{ route('sanpham.destroy',[$value->id]) }}">
                                                    <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                                </a>&nbsp;

                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
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
