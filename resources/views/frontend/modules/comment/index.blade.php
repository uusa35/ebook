@section('styles')
    @parent
    <style type="text/css" xmlns="http://www.w3.org/1999/html">

        .panel-shadow {
            box-shadow: rgba(0, 0, 0, 0.3) 7px 7px 7px;
        }

        .panel-white {
            border: 1px solid #dddddd;
        }

        .panel-white .panel-heading {
            color: #333;
            background-color: #fff;
            border-color: #ddd;
        }

        .panel-white .panel-footer {
            background-color: #fff;
            border-color: #ddd;
        }

        .post .post-heading {
            height: 95px;
            padding: 20px 15px;
        }

        .post .post-heading .avatar {
            width: 60px;
            height: 60px;
            display: block;
            margin-right: 15px;
        }

        .post .post-heading .meta .title {
            margin-bottom: 0;
        }

        .post .post-heading .meta .title a {
            color: black;
        }

        .post .post-heading .meta .title a:hover {
            color: #aaaaaa;
        }

        .post .post-heading .meta .time {
            margin-top: 8px;
            color: #999;
        }

        .post .post-image .image {
            width: 100%;
            height: auto;
        }

        .post .post-description {
            padding: 15px;
        }

        .post .post-description p {
            font-size: 14px;
        }

        .post .post-description .stats {
            margin-top: 20px;
        }

        .post .post-description .stats .stat-item {
            display: inline-block;
            margin-right: 15px;
        }

        .post .post-description .stats .stat-item .icon {
            margin-right: 8px;
        }

        .post .post-footer {
            border-top: 1px solid #ddd;
            padding: 15px;
        }

        .post .post-footer .input-group-addon a {
            color: #454545;
        }

        .post .post-footer .comments-list {
            padding: 0;
            margin-top: 20px;
            list-style-type: none;
        }

        .post .post-footer .comments-list .comment {
            display: block;
            width: 100%;
            margin: 20px 0;
        }

        .post .post-footer .comments-list .comment .avatar {
            width: 35px;
            height: 35px;
        }

        .post .post-footer .comments-list .comment .comment-heading {
            display: block;
            width: 100%;
        }

        .post .post-footer .comments-list .comment .comment-heading .user {
            font-size: 14px;
            font-weight: bold;
            display: inline;
            margin-top: 0;
            margin-right: 10px;
        }

        .post .post-footer .comments-list .comment .comment-heading .time {
            font-size: 12px;
            color: #aaa;
            margin-top: 0;
            display: inline;
        }

        .post .post-footer .comments-list .comment {

        }

        .post .post-footer .comments-list .comment > .comments-list {

        }
    </style>
@endsection

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-white post panel-shadow">
            {{--<div class="post-heading">
                <div class="pull-left image">
                    <img src="http://bootdey.com/img/Content/user_1.jpg" class="img-circle avatar" alt="user profile image">
                </div>
                <div class="pull-left meta">
                    <div class="title h5">
                        <a href="#"><b>Ryan Haywood</b></a>
                        made a post.
                    </div>
                    <h6 class="text-muted time">1 minute ago</h6>
                </div>
            </div>
            <div class="post-description">
                <p>Bootdey is a gallery of free snippets resources templates and utilities for bootstrap css hmtl js framework. Codes for developers and web designers</p>
            </div>--}}
            <div class="post-footer">
                <div class="row">
                    <div class="col-lg-12">
                        <form method="post" action="{{ route(Config::get('CommentPack.postParentCommentRoute')) }}">
                            {!! Form::token() !!}
                            {!! Form::hidden('book_id',$book->id) !!}
                            {!! Form::hidden('user_id',Auth::id()) !!}
                            <div class="input-group">
                                {!! Form::textarea('body','',['class' => "form-control" , 'placeholder' =>"إضافة تعليق" , 'rows'=>"4"]) !!}
                                <span class="input-group-addon">
                        <button type="submit"><i class="fa fa-comments"></i></button>
                    </span>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            @if(count($book->comments) > 0)
                                <div class="col-lg-12">
                                    <ul class="comments-list">
                                        @foreach($comments as $key => $comment)
                                            <li class="comment"
                                                style="{{ ($key & 1) ? 'margin-top: 35px; margin-bottom: 35px;' : ''  }};">
                                                <div class="row">
                                                    <div class="col-lg-1">
                                                        <a class="pull-left" href="#">
                                                            <img class="img-responsive img-circle"
                                                                 src="{!! asset('images/uploads/avatar/thumbnail/'.$comment->user->avatar) !!}"
                                                                 alt="avatar">
                                                        </a>
                                                    </div>
                                                    <div class="col-lg-11">
                                                        <div class="comment-body">
                                                            <div class="row">
                                                                <div class="col-lg-10">
                                                                    <div class="comment-heading">
                                                                        <h4 class="user text-right">{{ $comment->user->name }}</h4>
                                                                        <span><h5 class="time">
                                                                                - {{ $comment->created_at->diffForHumans() }}</h5></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12">
                                                                    <hr>
                                                                    <p class="text-justify">
                                                                        {{ $comment->body }}
                                                                    </p>
                                                                    <hr>
                                                                </div>
                                                            </div>

                                                            {{--<div class="stats">
                                                                <a href="#" class="btn btn-default stat-item">
                                                                    <i class="fa fa-thumbs-up icon"></i>2
                                                                </a>
                                                                <a href="#" class="btn btn-default stat-item">
                                                                    <i class="fa fa-share icon"></i>12
                                                                </a>
                                                            </div>--}}
                                                        </div>
                                                    </div>
                                                </div>
                                                @if(count($comment->children) > 0)
                                                    @foreach($comment->children as $child)
                                                        <ul class="comments-list">
                                                            <li class="comment">
                                                                <div class="row">
                                                                    <div class="col-lg-1 col-lg-offset-1">
                                                                        <img class="img-responsive img-circle"
                                                                             src="{!! asset('images/uploads/avatar/thumbnail/'.$child->user->avatar )!!}"
                                                                             alt="avatar">
                                                                    </div>
                                                                    <div class="col-lg-10">
                                                                        <div class="comment-body">
                                                                            <div class="comment-heading">
                                                                                <h4 class="user">{{ $child->user->name }}</h4>
                                                                                <h5 class="time">
                                                                                    - {{ $child->created_at->diffForHumans() }}</h5>
                                                                            </div>
                                                                            <hr>
                                                                            <p class="text-justify">
                                                                                {{ $child->body }}
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                            </li>
                                                        </ul>
                                                    @endforeach
                                                @endif
                                                <div class="row comments-list">
                                                    <div class="col-lg-11 col-lg-offset-1">
                                                        <form method="post"
                                                              action="{{ route(Config::get('CommentPack.postChildCommentRoute')) }}">
                                                            {!! Form::token() !!}
                                                            {!! Form::hidden('comment_id',$comment->id) !!}
                                                            {!! Form::hidden('user_id',Auth::id()) !!}
                                                            <div class="input-group">
                                                                {!! Form::textarea('body','',['class' => "form-control" , 'placeholder' => "إضافة رد" , 'rows'=>"1"]) !!}
                                                                <span class="input-group-addon">
                                                                    <button type="submit"><i class="fa fa-comments"></i>
                                                                    </button>
                                                                </span>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                        {{--{!!  $book->comments()->paginate(3)->render() !!}--}}
                                        <div class="col-lg-6 col-lg-offset-5">
                                            {!! $commentsRender !!}
                                        </div>
                                    </ul>
                                </div>
                            @else
                                <div class="alert alert-warning"
                                     role="alert">{{ trans('messages.no_comments') }}</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>