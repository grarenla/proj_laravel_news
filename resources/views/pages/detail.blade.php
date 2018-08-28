@extends('layout.index')

@section('content')
    <!-- Page Content -->
    <div class="container">
        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-9">

                <!-- Blog Post -->

                <!-- Title -->
                <h1>{{$tintuc->TieuDe}}</h1>

                <!-- Author -->
                <p class="lead">
                    by <a href="javascript:void(0)">Admin</a>
                </p>

                <!-- Preview Image -->
                <img class="img-responsive" src="{{asset('images/tintuc/'.$tintuc->Hinh)}}">

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on : {{$tintuc->created_at}}</p>
                <hr>

                <!-- Post Content -->
                <p class="lead">
                    {!! $tintuc->NoiDung !!}
                </p>

                <hr>

                <!-- Blog Comments -->
                @if(\Illuminate\Support\Facades\Auth::check())
                    <!-- Comments Form -->
                    <div class="well">
                        <h4>Viết bình luận ...<span class="glyphicon glyphicon-pencil"></span></h4>
                        <form action="/comment/{{$tintuc->id}}" role="form" method="post">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="form-group">
                                <textarea class="form-control" name="NoiDung" rows="3"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Gửi</button>
                        </form>
                    </div>
                @endif
                <hr>

                <!-- Posted Comments -->

                @foreach($tintuc->comment as $cmt)
                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">{{$cmt->user->name}}
                            <small>{{$cmt->created_at}}</small>
                        </h4>
                        {{$cmt->NoiDung}}
                    </div>
                </div>
                @endforeach

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-3">

                <div class="panel panel-default">
                    <div class="panel-heading"><b>Tin liên quan</b></div>
                    <div class="panel-body">
                        @foreach($lienquan as $lq)
                            <!-- item -->
                            <div class="row" style="margin-top: 10px;">
                                <div class="col-md-5">
                                    <a href="/news/{{$lq->id}}">
                                        <img class="img-responsive" src="{{asset('images/tintuc/'.$lq->Hinh)}}" alt="">
                                    </a>
                                </div>
                                <div class="col-md-7">
                                    <a href="/news/{{$lq->id}}"><b>{{$lq->TieuDe}}</b></a>
                                </div>
                                <p style="padding-left: 5px">{{$lq->TomTat}}</p>
                                <div class="break"></div>
                            </div>
                            <!-- end item -->
                        @endforeach
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading"><b>Tin nổi bật</b></div>
                    <div class="panel-body">
                        @foreach($noibat as $nb)
                            <!-- item -->
                            <div class="row" style="margin-top: 10px;">
                                <div class="col-md-5">
                                    <a href="/news/{{$nb->id}}">
                                        <img class="img-responsive" src="{{asset('images/tintuc/'.$nb->Hinh)}}" alt="">
                                    </a>
                                </div>
                                <div class="col-md-7">
                                    <a href="/news/{{$nb->id}}"><b>{{$nb->TieuDe}}</b></a>
                                </div>
                                <p style="padding-left: 5px">{{$nb->TomTat}}</p>
                                <div class="break"></div>
                            </div>
                            <!-- end item -->
                        @endforeach

                    </div>
                </div>

            </div>

        </div>
        <!-- /.row -->
    </div>
    <!-- end Page Content -->
@endsection