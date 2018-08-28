@extends('admin.layout.index')
@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">User
                        <small>{{$user->name}}</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-7" style="padding-bottom:120px">
                    <form action="/admin/user/edit/{{$user->id}}" method="POST">
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
                            <label>Full Name</label>
                            <input class="form-control" name="name" placeholder="Please Enter Full Name"
                                   value="{{$user->name}}"/>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Please Enter email"
                                   value="{{$user->email}}" readonly/>
                        </div>
                        <div class="form-group">
                            <label>
                                <input type="checkbox" name="changePassword" id="changePass">
                                Change Password
                            </label>
                            <input class="form-control password" name="password" placeholder="Please Enter password"
                                   type="password" disabled=""/>
                        </div>
                        <div class="form-group">
                            <label>Password Again</label>
                            <input class="form-control password" name="passwordAgain"
                                   placeholder="Please Enter password again" type="password" disabled=""/>
                        </div>
                        <div class="form-group">
                            <label>Level</label>
                            <label class="radio-inline">
                                <input name="quyen" value="1" type="radio"
                                @if($user->quyen == 1)
                                    {{"checked"}}
                                        @endif
                                >Admin
                            </label>
                            <label class="radio-inline">
                                <input name="quyen" value="2" type="radio"
                                @if($user->quyen == 0)
                                    {{"checked"}}
                                        @endif
                                >User
                            </label>
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