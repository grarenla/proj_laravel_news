@extends('admin.layout.index')
@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Tin tức
                        <small>{{$tintuc->TieuDe}}</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-7" style="padding-bottom:120px">
                    <form action="/admin/tintuc/edit/{{$tintuc->id}}" method="POST" enctype="multipart/form-data">
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
                                    <option value="{{$tl->id}}"
                                    @if($tl->id == $tintuc->loaitin->idTheLoai)
                                        {{"selected"}}
                                            @endif
                                    >{{$tl->Ten}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Loại tin</label>
                            <select class="form-control" name="LoaiTin" id="LoaiTin">
                                @foreach($loaitin as $lt)
                                    <option value="{{$lt->id}}"
                                    @if($lt->id == $tintuc->idLoaiTin)
                                        {{"selected"}}
                                            @endif
                                    >{{$lt->Ten}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tiêu đề</label>
                            <input class="form-control" name="TieuDe" placeholder="Nhập tiêu đề"
                                   value="{{$tintuc->TieuDe}}"/>
                        </div>
                        <div class="form-group">
                            <label>Tóm tắt</label>
                            <textarea class="form-control" name="TomTat" cols="30" rows="10"
                                      placeholder="Nhập tóm tắt">{{$tintuc->TomTat}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Nội dung</label>
                            <textarea id="demo" class="form-control ckeditor" name="NoiDung" cols="30" rows="10"
                                      placeholder="Nhập nội dung">{{$tintuc->NoiDung}}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Hình ảnh</label>
                            <p><img src="{{asset('images/tintuc/'.$tintuc->Hinh)}}" height="400px"></p>
                            <input type="file" name="Hinh" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Nổi bật</label>
                            <label class="radio-inline">
                                <input name="NoiBat" value="0"
                                       @if($tintuc->NoiBat == 0)
                                               {{"checked"}}
                                       @endif
                                       type="radio">Không
                            </label>
                            <label class="radio-inline">
                                <input name="NoiBat" value="1"
                                       @if($tintuc->NoiBat == 1)
                                        {{"checked"}}
                                       @endif
                                       type="radio">Có
                            </label>
                        </div>
                        <button type="submit" class="btn btn-default">Add</button>
                        <button type="reset" class="btn btn-default">Reset</button>
                    </form>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Comment
                        <small>{{$tintuc->TieuDe}}</small>
                    </h1>
                    @if(session('status'))
                        <div class="alert alert-success text-center">
                            {{session('status')}}
                        </div>
                    @endif
                </div>
                <!-- /.col-lg-12 -->
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                    <tr align="center">
                        <th class="text-center">ID</th>
                        <th class="text-center">User</th>
                        <th class="text-center">Nội dung</th>
                        <th class="text-center">Ngày đăng</th>
                        <th class="text-center">Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(! empty($tintuc))
                        @foreach($tintuc->comment  as $item)
                            <tr class="odd gradeX" align="center">
                                <td>{{$item->id}}</td>
                                <td>{{$item->user->name}}</td>
                                <td>{{$item->NoiDung}}</td>
                                <td>{{$item->created_at}}</td>
                                <td><i class="fa fa-trash-o  fa-fw"></i><a href="/admin/comment/delete/{{$item->id}}">Delete</a></td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
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