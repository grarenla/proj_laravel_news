@extends('layout.index')

@section('content')
<!-- Page Content -->
<div class="container">

    <!-- slider -->
    <div class="row carousel-holder">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">Thông tin tài khoản</div>
                <div class="panel-body">
                    <form action="/account" method="post">
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
                        <div>
                            <label>Họ tên</label>
                            <input type="text" class="form-control" placeholder="Username" name="name" aria-describedby="basic-addon1" value="{{$acc->name}}">
                        </div>
                        <br>
                        <div>
                            <label>Email</label>
                            <input type="email" class="form-control" placeholder="Email" name="email" aria-describedby="basic-addon1" value="{{$acc->email}}" readonly>
                        </div>
                        <br>
                        <div>

                            <label><input type="checkbox" class="" name="changePassword" id="changePass"> Đổi mật khẩu</label>
                            <input type="password" class="password form-control" name="password" disabled>
                        </div>
                        <br>
                        <div>
                            <label>Nhập lại mật khẩu</label>
                            <input type="password" class="password form-control" name="passwordAgain" disabled>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-default">Sửa
                        </button>

                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-2">
        </div>
    </div>
    <!-- end slide -->
</div>
<!-- end Page Content -->
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $('#changePass').change(function () {
                if ($('#changePass').is(':checked')) {
                    $('.password').removeAttr('disabled');
                } else {
                    $('.password').attr('disabled', '');
                }
            });
        });
    </script>
@endsection