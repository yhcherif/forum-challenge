@extends('layouts.app')


@section('content')

<div class="container">
    <div class="row">
        <div class="col-sm-3 col-md-2">
            <label  class="btn btn-danger btn-sm btn-block" >CHANNELS</a>
        </div>
        <div class="col-sm-9 col-md-10">
            <a href="/threads" class="btn btn-default" data-toggle="tooltip" title="Back to inbox">
                   All</a>
        </div>
    </div>
    <hr />
    <div class="row">
        <div class="col-sm-3 col-md-2">
            <ul class="nav nav-pills nav-stacked">
              @foreach(App\Channel::all() as $chan)
                <li><a href="{{$chan->link()}}">
                {{-- <span class="badge pull-right">42</span> --}}
                 {{$chan->name}}
                  </a>
                </li>
              @endforeach
            </ul>
        </div>
        <div class="col-sm-9 col-md-10">
            <div class="msg-wrap">
                <p class="thread-title">Forum -> {{($channel->exists) ? ucfirst($channel->name) : "All"}}</p>
                @foreach( $threads as $thread )         
                <div class="msg odd">
                  <div class="col-md-3 author">
                      <h5 class="media-heading"> <a href="{{$thread->link()}}">{{$thread->title}}</a></h5>
                  </div>
                  <div class="col-md-9 text-muted">
                      by {{$thread->creator->name}} - <small class="text-muted">
                      <i class="fa fa-clock-o"></i> {{$thread->created_at->diffForHumans()}}</small>
                  </div>
                  <div class="clearfix"></div>
              </div>
                @endforeach
        </div>
    </div>
</div>
@stop



@section('stylesheets')
<style>
  .messages .list-group-item:first-child {border-top-right-radius: 0px;border-top-left-radius: 0px;}
  .messages .list-group-item:last-child {border-bottom-right-radius: 0px;border-bottom-left-radius: 0px;}
  .messages .list-group .checkbox { display: inline-block;margin: 0px; }
  .messages .list-group input[type="checkbox"]{ margin-top: 2px; }
  .messages .list-group .glyphicon { margin-right:5px; }
  .messages .list-group .glyphicon:hover { color:#FFBC00; }
  a.list-group-item.read { color: #222;background-color: #F3F3F3; }
  hr { margin-top: 5px;margin-bottom: 10px; }
  .nav-pills>li>a {padding: 5px 10px;}

  .ad { padding: 5px;background: #F5F5F5;color: #222;font-size: 80%;border: 1px solid #E5E5E5; }
  .ad a.title {color: #15C;text-decoration: none;font-weight: bold;font-size: 110%;}
  .ad a.url {color: #093;text-decoration: none;}



   .message-wrap
      {
          box-shadow: 0 0 3px #ddd;
          padding:0;

      }
      .msg
      {
          padding:5px;
          border-top:1px solid #ddd;
          margin:0;
      }
      .msg.odd {
          background-color: #FFFFFF;
      }
      .msg.even {
          background-color: #F4F6F8;
      }
      .msg .author {
          border-right: 1px solid #ddd;
      }
      .msg-wrap {
          padding:10px;
      }
      

      .msg-wrap .thread-title {
          font-size: 22px;
          font-weight: 400;
          color: #222222;
          padding: 0 0 0 10px;
      }

      .send-wrap
      {
          border-top: 1px solid #eee;
          padding:10px;
          /*background: #f8f8f8;*/
      }

      .highlight
      {
          background-color: #f7f7f9;
          border: 1px solid #e1e1e8;
      }

      .msg-wrap .media-heading
      {
          color:#003bb3;
          font-weight: 700;
      }

      .msg-date
      {
          background: none;
          text-align: center;
          color:#aaa;
          border:none;
          box-shadow: none;
          border-bottom: 1px solid #ddd;
      }
</style>
@stop