<div id="text-carousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        @for ($i = 0; $i < count($movies); $i++)
            <li data-target="#text-carousel" data-slide-to="{{ $i }}" @if ($i == 0) echo 'class="active"'; @endif></li>
        @endfor
    </ol>
    <!-- Wrapper for slides -->
    <div class="row">
        <div class="col-xs-offset-3 col-xs-6">
            <div class="carousel-inner">                
                @for ($i = 0; $i < count($movies); $i++)
                    <div class="item @if ($i == 0) {{ 'active' }} @endif">
                        <div class="carousel-content">
                            <div>
                                <h1>{{ $movies[$i]->title }}</h1>
                                <h3>{{ $movies[$i]->comment }}</h3>
                            </div>
                        </div>
                    </div>
                @endfor                        
            </div>
        </div>
    </div>
    <!-- Controls -->
    <a class="left carousel-control" href="#text-carousel" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
    </a>
    <a class="right carousel-control" href="#text-carousel" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
    </a>
</div>
