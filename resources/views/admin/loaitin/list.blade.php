@extends('admin.layout.index')
@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Category
                        <small>List</small>
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
                        <th class="text-center">Name</th>
                        <th class="text-center">Tên không dấu</th>
                        <th class="text-center">Thể loại</th>
                        <th class="text-center">Delete</th>
                        <th class="text-center">Edit</th>
                    </tr>
                    </thead>
                        <tbody>
                            @if(! empty($list))
                                @foreach($list as $item)
                                    <tr class="odd gradeX" align="center">
                                        <td>{{$item->id}}</td>
                                        <td>{{$item->Ten}}</td>
                                        <td>{{$item->TenKhongDau}}</td>
                                        <td>{{$item->theloai->Ten}}</td>
                                        <td><i class="fa fa-trash-o  fa-fw"></i><a href="delete/{{$item->id}}">Delete</a></td>
                                        <td><i class="fa fa-pencil fa-fw"></i> <a href="edit/{{$item->id}}">Edit</a></td>
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