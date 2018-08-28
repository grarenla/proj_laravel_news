@extends('layout.index')

@section('content')
    <div class="container">

        @include('layout.slide')

        <div class="space20"></div>


        <div class="row main-left">
            @include('layout.menu')

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading" style="background-color:#337AB7; color:white;" >
                        <h2 style="margin-top:0px; margin-bottom:0px;">Laravel Tin Tức</h2>
                    </div>

                    <div class="panel-body">
                        @foreach($theloai as $item)
                            @if(count($item->loaitin) > 0)
                                <!-- item -->
                                <div class="row-item row">
                                    <h3>
                                        <a href="javascript:void(0)">{{$item->Ten}}</a> |
                                        @foreach($item->loaitin as $lt)
                                            <small><a href="/category/{{$lt->id}}"><i>{{$lt->Ten}}</i></a>/</small>
                                        @endforeach
                                    </h3>
                                    @php($data = $item->tintuc->where('NoiBat', 1)->sortByDesc('id')->take(5))
                                    @php($first = $data->shift())
                                    <div class="col-md-8 border-right">
                                        <div class="col-md-5">
                                            <a href="/news/{{$first['id']}}">
                                                <img class="img-responsive" src="{{asset('images/tintuc/'.$first['Hinh'])}}" alt="">
                                            </a>
                                        </div>

                                        <div class="col-md-7">
                                            <h3>{{$first['TieuDe']}}</h3>
                                            <p>{{$first['TomTat']}}</p>
                                            <a class="btn btn-primary" href="/news/{{$first['id']}}">View detail<span class="glyphicon glyphicon-chevron-right"></span></a>
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        @foreach($data as $tintuc)
                                            <a href="/news/{{$tintuc->id}}">
                                                <h4>
                                                    <span class="glyphicon glyphicon-list-alt"></span>
                                                    {{$tintuc->TieuDe}}
                                                </h4>
                                            </a>
                                        @endforeach
                                    </div>

                                    <div class="break"></div>
                                </div>
                                <!-- end item -->
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
@endsection
