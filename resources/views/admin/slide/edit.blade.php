@extends('admin.layout.index')
@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Slide
                        <small>{{$slide->Ten}}</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-7" style="padding-bottom:120px">
                    <form action="/admin/slide/edit/{{$slide->id}}" method="POST" enctype="multipart/form-data">
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
                            <label>Tên</label>
                            <input class="form-control" name="Ten" placeholder="Nhập tên" value="{{$slide->Ten}}"/>
                        </div>
                        <div class="form-group">
                            <label>Nội dung</label>
                            <input class="form-control" name="NoiDung" placeholder="Nhập nội dung" value="{{$slide->NoiDung}}"/>
                        </div>
                        <div class="form-group">
                            <label>Hình ảnh</label>
                            <p><img src="{{asset('images/slide/'.$slide->Hinh)}}" width="400px"></p>
                            <input type="file" name="Hinh" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Link</label>
                            <input class="form-control" name="Link" placeholder="Nhập link" value="{{$slide->link}}"/>
                        </div>
                        <button type="submit" class="btn btn-default">Update</button>
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