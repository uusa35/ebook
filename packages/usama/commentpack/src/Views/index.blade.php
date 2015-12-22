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

        .post .post-footer .comments-list .comment  {
            margin-left: 50px;
        }

        .post .post-footer .comments-list .comment > .comments-list {
            margin-left: 50px;
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
                        <div class="input-group">
                            <textarea class="form-control" placeholder="إضافة تعليق" type="text" aria-multiline="true" rows="4"></textarea>
                    <span class="input-group-addon">
                        <a href="#"><i class="fa fa-comments"></i></a>
                    </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        @for($s=0;$s<=3;$s++)
                            <div class="row">
                                <div class="col-lg-12">
                                    <ul class="comments-list">
                                        <li class="comment">
                                            <div class="row">
                                                <div class="col-lg-1">
                                                    <a class="pull-left" href="#">
                                                        <img class="img-responsive img-circle"
                                                             src="http://bootdey.com/img/Content/user_1.jpg"
                                                             alt="avatar">
                                                    </a>
                                                </div>
                                                <div class="col-lg-11">
                                                    <div class="comment-body">
                                                        <div class="row">
                                                            <div class="col-lg-10">
                                                                <div class="comment-heading">
                                                                    <h4 class="user text-right">جاســـم</h4>
                                                                    <span><h5 class="time">- 12/12/2015</h5></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <hr>
                                                                <p class="text-justify">
                                                                    نحن موقع تواصل إلكتروني يتابع فيه ابداعات حروف الموهوبين، نحن على يقين بأن منكم من يريد أن يطلق عنان كتابه الأول في الاسواق ولكن تحتم علينا الظروف وتمنعنا من ذلك لأسباب مالية أو عدم التمرس في الكتابة التي تصل بنا إلى الثقة بطباعة كتاب الأول، فالموقع بمثابة برهان ودليل لدور النشر لإقبال الناس على كتابك، وسنسعى جاهدين أن نكون حلقة وصل بين الكاتب ودور النشر .. إضافة إلى ذلك سيتم إختيار الكُتّاب الأكثر تميزا وسيتم طباعتها على نفقة إدارة الموقع بعد موافقة الكاتب في نشر حروفه على نطاق أكبر. علماً بأن موقع حروف سيكون تحت الرقابة الفكرية فلا نحبذ الحروف المخلة للآداب او تلك التي تحمل السب و القذف او مساس للدين وما شابه من الامور التي تخدش الحياء و نستميحكم العذر في عدم نشرها. www.7orof.com إدارة الموقع


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
                                            <ul class="comments-list">
                                                @for($i=1;$i<=2;$i++)
                                                    <li class="comment">
                                                        <div class="row">
                                                            <div class="col-lg-1 col-lg-offset-1">
                                                                <img class="img-responsive img-circle"
                                                                     src="http://bootdey.com/img/Content/user_{{$i}}.jpg"
                                                                     alt="avatar">
                                                            </div>
                                                            <div class="col-lg-10">
                                                                <div class="comment-body">
                                                                    <div class="comment-heading">
                                                                        <h4 class="user">اسامـة أحمد</h4>
                                                                        <h5 class="time">- 12/1/2015</h5>
                                                                    </div>
                                                                    <hr>
                                                                    <p class="text-justify">
                                                                        الكتاب يتحدث عن الكثير من الافكار التي يمكن أن تؤثر
                                                                        في
                                                                        المجتمع بما
                                                                        لا
                                                                        يدعو مجالا
                                                                        للشك أن هناك اساسيات تميل إلى ابتعاث الكثير من
                                                                        الخواط
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endfor
                                            </ul>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        @endfor
                    </div>c
                </div>
            </div>
        </div>
    </div>
</div>