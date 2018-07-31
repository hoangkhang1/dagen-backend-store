@extends('admin/layouts/default')

{{-- Web site Title --}}
@section('title')
    Danh sách danh mục
    @parent
@stop
@section('header_styles')
    <link rel="stylesheet" type="text/css"
          href="{{ asset('assets/vendors/datatables/css/dataTables.bootstrap.css') }}"/>
    <link href="{{ asset('assets/css/pages/tables.css') }}" rel="stylesheet" type="text/css"/>
    {{--<link href="{{ asset('assets/css/khang.css') }}" rel="stylesheet" type="text/css"/>   --}}
    <link href="{{ asset('assets/css/khang.css') }}" rel="stylesheet">

@stop

{{-- Montent --}}
@section('content')
    <section class="content-header">
        <h1>Danh sách comment</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.dashboard') }}"> <i class="livicon" data-name="home" data-size="16"
                                                             data-color="#000"></i>
                    @lang('general.dashboard')
                </a>
            </li>
            <li><a href="#">Bình luận</a></li>
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
                            Danh sách comment
                        </h4>
                    </div>
                    <br/>
                    <div class="panel-body">
                        <form action="{{route('comment.index')}}" method="GET">
                            <label>Chọn ngày: </label>
                            <input style="border: 3px solid #555" name="ngay" type="date">
                            <button type="submit" class="btn btn-success">Tìm kiếm</button>
                            <a href="{{ route('comment.index') }}" class="btn btn-warning"><i
                                        aria-hidden="true"></i> Quay lại</a>
                        </form>
                        <div class="col-lg-12">
                            @foreach($comment as $val)
                                <div class="col-lg-12">
                                    <hr>

                                    <div class="col-lg-10">
                                        @if (empty($val->avatar))
                                            <img class="avatar-cmt" src="{{url('upload')}}/image.png" width="50px"
                                                 height="50px">
                                        @else
                                            <img class="avatar-cmt"
                                                 src="{{url('http://dagen.miennam24h.vn/public/user')}}/{{$val->avatar}}"
                                                 width="50px" height="50px">
                                        @endif
                                        {{--</div>--}}
                                        {{--<div class="col-lg-">--}}
                                        <strong style="color: #5bc0de">{{$val->name}} - </strong>
                                        <strong style="color: #9d9d9d;">{{$val->name_product}}</strong>
                                        {{--<br>--}}
                                        <p>{{$val->comments}}</p>
                                    </div>
                                    <div class="col-lg-2">
                                        <p style="color: #9d9d9d;">{{$val->created_at}}</p>
                                    </div>

                                </div>
                            @endforeach
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
