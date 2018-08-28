@extends('layout.index')

@section('content')
    <!-- Page Content -->
    <div class="container">
        <div class="row">
            @include('layout.menu')

            <div class="col-md-9 ">
                <div class="panel panel-default">
                    <div class="panel-heading" style="background-color:#337AB7; color:white;">
                        <h4><b>{{$loaitin->Ten}}</b></h4>
                    </div>
                    @foreach($tintuc as $item)
                        <div class="row-item row">
                            <div class="col-md-3">

                                <a href="detail.html">
                                    <br>
                                    <img width="200px" height="200px" class="img-responsive" src="{{asset('images/tintuc/'.$item->Hinh)}}" alt="">
                                </a>
                            </div>

                            <div class="col-md-9">
                                <h3>{{$item->TieuDe}}</h3>
                                <p>{{$item->TomTat}}</p>
                                <a class="btn btn-primary" href="/news/{{$item->id}}">View detail <span class="glyphicon glyphicon-chevron-right"></span></a>
                            </div>
                            <div class="break"></div>
                        </div>
                    <!-- /.row -->
                    @endforeach
                    <div style="text-align: center">
                        {{$tintuc->links()}}
                    </div>
                </div>
            </div>

        </div>

    </div>
    <!-- end Page Content -->
@endsection