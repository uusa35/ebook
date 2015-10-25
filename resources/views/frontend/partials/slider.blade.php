<div class="row">
    <div class="col-md-12">
        <div class="box box-solid">
            <div class="box-header with-border">

            </div><!-- /.box-header -->
            <div class="box-body">
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
                        <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
                    </ol>
                    <div class="carousel-inner">
                        @foreach($sliders as $slider)
                            <div class="item {{ ($slider->id === 1) ? 'active' : '' }}">
                                <img src="{{ asset('images/uploads/slide/large/'.$slider->slide) }}" alt="{{ $slider->caption }}">
                                <div class="carousel-caption">
                                    {{ $slider->caption }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                        <span class="fa fa-angle-left"></span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                        <span class="fa fa-angle-right"></span>
                    </a>
                </div>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->