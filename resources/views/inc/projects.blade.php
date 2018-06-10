<div class="row">
    @foreach($projects as $project)
        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-2">
            <div class="row">
                <div class="view overlay hm-black-strong">
                    <img src="images/languages/{{ urlencode($project['language']) }}.png" alt="{{ $project['language'] }}">
                    <div class="mask flex-center">
                        <div>
                        <p class="white-text">{{ $project['description'] }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row text-center">
                <h5>
                    <a href="{{ $project['html_url'] }}" target="_blank">{{ $project['name'] }}</a>
                </h5>
            </div>
        </div>
    @endforeach
</div>