@extends('admin/layouts/default')

{{-- Web site Title --}}
@section('title')
    Danh sách danh mục
    @parent
@stop
@section('header_styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datatables/css/dataTables.bootstrap.css') }}" />
    <link href="{{ asset('assets/css/pages/tables.css') }}" rel="stylesheet" type="text/css" />
@stop

{{-- Montent --}}
@section('content')
    <section class="content-header">
        <h1>Danh sách comment</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
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
                        <h4 class="panel-title pull-left"> <i class="livicon" data-name="users" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                            Danh sách comment
                        </h4>
                        <div class="pull-right">
                            <a href="{{ route('danhmuc.create') }}" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-plus"></span> Tạo danh mục</a>
                        </div>
                    </div>
                    <br />
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="table">
                                <thead>
                                <tr class="odd gradeX" align="center">
                                    <th>STT</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Tên khách hàng</th>
                                    <th>Ảnh đại diện</th>
                                    <th>Tiêu đề</th>
                                    <th>Comment</th>
                                    <th>Ngày comment</th>
                                </tr>
                                </thead>
                                <tbody><?php $x =1;?>
                                {{--@foreach($comment as $val)--}}
                                <tr class="odd gradeX" align="center">
                                    <td>
                                        {{$x}}
                                    </td>
                                    <td>{{$comment->name_product}}</td>
                                    <td>{{$comment->name}}</td>
                                    {{--<td>{{$val->avatar}}</td>--}}
                                    @if (empty($comment->avatar))
                                        <td><img src="{{url('upload')}}/image.png" width="50px" height="50px"></td>
                                    @else
                                        <td><img src="{{$comment->avatar}}" width="50px" height="50px"></td>
                                    @endif
                                    <td>{{$comment->title}}</td>
                                    <td>{{$comment->comments}}</td>
                                    <td>{{$comment->created_at}}</td>
                                </tr>
                                <?php
                                $x++;
                                ?>
                                {{--@endforeach--}}
                                </tbody>
                            </table>
                            <form action="{{url('comment/reply',$comment->comment_id)}}" method="GET" enctype="multipart/form-data">

                                <div class="row">
                                    <div class="col-sm-2">
                                        <h5 class="text-right">Nhập Reply</h5>
                                    </div>
                                    <div class="col-sm-10">
                                        <input name="comment_reply" class="form-control required" type="text"
                                               placeholder="Trả lời comment">
                                    </div>
                                </div>
                                <div class="col-sm-4 col-sm-offset-5">
                                    <button class="btn btn-primary" type="submit">Reply</button>
                                </div>
                            </form>
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
        $(document).ready(function() {
            $('#table').DataTable();
        });
    </script>
    <div class="modal fade" id="delete_confirm" tabindex="-1" role="dialog" aria-labelledby="blogcategory_delete_confirm_title" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            </div>
        </div>
    </div>
    <div class="modal fade" id="blogcategory_exists" tabindex="-2" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                </div>
                <div class="modal-body">
                    @lang('blogcategory/message.blogcategory_have_blog')
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function () {$('body').on('hidden.bs.modal', '.modal', function () {$(this).removeData('bs.modal');});});
        $(document).on("click", ".blogcategory_exists", function () {

            var group_name = $(this).data('name');
            $(".modal-header h4").text( group_name+" blog category" );
        });</script>
@stop
