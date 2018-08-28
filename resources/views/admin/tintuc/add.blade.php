@extends('admin.layout.index')
@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Tin tức
                        <small>Add</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-7" style="padding-bottom:120px">
                    <form action="/admin/tintuc/add" method="POST" enctype="multipart/form-data">
                        @if(count($errors) > 0)
                            <div class="alert alert-danger text-center">
                                @foreach($errors->all() as $err)
                                    {{$err}}<br>
                                @endforeach
                            </div>
                        @endif
                        @if(session('status'))
                            <div class="alert alert-success text-center">
                                {{session('status')}}
                            </div>
                        @endif
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="form-group">
                            <label>Thể loại</label>
                            <select class="form-control" name="TheLoai" id="TheLoai">
                                @foreach($theloai as $tl)
                                    <option value="{{$tl->id}}">{{$tl->Ten}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Loại tin</label>
                            <select class="form-control" name="LoaiTin" id="LoaiTin">
                                {{--@foreach($loaitin as $lt)--}}
                                    {{--<option value="{{$lt->id}}">{{$lt->Ten}}</option>--}}
                                {{--@endforeach--}}
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tiêu đề</label>
                            <input class="form-control" name="TieuDe" placeholder="Nhập tiêu đề"/>
                        </div>
                        <div class="form-group">
                            <label>Tóm tắt</label>
                            <input class="form-control" name="TomTat" placeholder="Nhập tóm tắt"/>
                        </div>
                        <div class="form-group">
                            <label>Nội dung</label>
                            <input class="form-control" name="NoiDung" placeholder="Nhập nội dung"/>
                        </div>
                        <div class="form-group">
                            <label>Hình ảnh</label>
                            <input type="file" name="Hinh" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Nổi bật</label>
                            <label class="radio-inline">
                                <input name="NoiBat" value="0" checked="" type="radio">Không
                            </label>
                            <label class="radio-inline">
                                <input name="NoiBat" value="1" type="radio">Có
                            </label>
                        </div>
                        <button type="submit" class="btn btn-default">Add</button>
                        <button type="reset" class="btn btn-default">Reset</button>
                    </form>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            var idTheLoai = $('#TheLoai').val();
            $.get('/admin/ajax/loaitin/' + idTheLoai, function (data) {
                var opLoaiTin = "";
                for (var i = 0; i < data.length; i++) {
                    opLoaiTin += "<option value='" + data[i].id + "'>" + data[i].Ten + "</option>";
                }
                $('#LoaiTin').html(opLoaiTin);
            });
            $('#TheLoai').change(function () {
                var idTheLoai = $(this).val();
                $.get('/admin/ajax/loaitin/' + idTheLoai, function (data) {
                    var opLoaiTin = "";
                    for (var i = 0; i < data.length; i++) {
                        opLoaiTin += "<option value='" + data[i].id + "'>" + data[i].Ten + "</option>";
                    }
                    $('#LoaiTin').html(opLoaiTin);
                });
            });
        });
    </script>
@endsection