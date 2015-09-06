@if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <div class="row">
            <div class="col-lg-1">
                <i class="fa fa-2x fa-check-circle-o fa-fw"></i>
            </div>
            <div class="col-lg-11">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                @if(is_array($message))
                    @foreach ($message as $m)
                        {{ $m }}
                    @endforeach
                @else
                    {{ $message }}
                @endif
            </div>
        </div>
    </div>
@endif

@if ($message = Session::get('error'))
    <div class="alert alert-danger alert-block">
        <div class="row">
            <div class="col-lg-1">
                <i class="fa fa-1x fa-exclamation-triangle fa-fw"></i>
            </div>
            <div class="col-lg-11">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                @if(is_array($message))
                    @foreach ($message as $m)
                        {{ $m }}
                    @endforeach
                @else
                    {{ $message }}
                @endif
            </div>
        </div>
    </div>
@endif

@if ($message = Session::get('errors'))
    <div class="alert alert-danger alert-block">
        <div class="row">
            <div class="col-lg-1">
                <i class="fa fa-2x fa-exclamation-triangle fa-fw"></i>
            </div>
            <div class="col-lg-11">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                @if($message->all())
                    @foreach ($message->all() as $m)
                        <li>{{ $m }}  </li>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endif

@if ($message = Session::get('warning'))
    <div class="alert alert-warning alert-block">
        <div class="row">
            <div class="col-lg-1">
                <i class="fa fa-2x fa-exclamation fa-fw"></i>
            </div>
            <div class="col-lg-11">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                @if(is_array($message))
                    @foreach ($message as $m)
                        {{ $m }}
                    @endforeach
                @else
                    {{ $message }}
                @endif
            </div>
        </div>
    </div>
@endif

@if ($message = Session::get('info'))
    <div class="alert alert-info alert-block">
        <div class="row">
            <div class="col-lg-1">
                <i class="fa fa-2x fa-info-circle fa-fw"></i>
            </div>
            <div class="col-lg-11">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                @if(is_array($message))
                    @foreach ($message as $m)
                        {{ $m }}
                    @endforeach
                @else
                    {{ $message }}
                @endif
            </div>
        </div>
    </div>
@endif
