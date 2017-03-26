@extends('layouts.app')


@section('content')
<div class="container">
  <div class="row">
      <div class="col-sm-12 col-md-12">
          <div class="msg-wrap">
              <p class="thread-title">{{$thread->title}}</p>
              @foreach( $thread->replies as $reply)
                <div class="msg odd">
                    <div class="col-md-3 author">
                        <h5 class="media-heading">{{$reply->owner->name}} <small class="text-muted"> </small></h5><small class="text-muted">
                        <i class="fa fa-clock-o"></i> {{$reply->created_at->diffForHumans()}}</small>
                        
                    </div>
                    <div class="col-md-9">
                        {{$reply->body}}
                    </div>
                    <div class="clearfix"></div>
                </div>
              @endforeach
        
          </div>

          <div class="send-wrap ">
              <form accept-charset="UTF-8" action="{{$thread->link().'/reply'}}" method="POST" role="form" class="">
              {{csrf_field()}}
                  <div class="form-group">
                      <textarea class="form-control counted" rows="8" placeholder="Write a reply..." name="body"></textarea>
                  </div>
                  <div class="form-group">
                      <h6 class="pull-right" id="counter">2500 characters remaining</h6>
                      <button class="btn btn-info" type="submit">Send</button>
                  </div>
              </form>
          </div>
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