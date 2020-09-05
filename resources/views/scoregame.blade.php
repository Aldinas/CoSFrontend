<!DOCTYPE html>
<html lang="en-us">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Unity WebGL Player | {{ucfirst($gameName)}}</title>
    <link rel="shortcut icon" href="/unitybuilds/TemplateData/favicon.ico">
    <link rel="stylesheet" href="/unitybuilds/TemplateData/style.css">
    <link rel="stylesheet" href="/css/app.css">
    <script src="/unitybuilds/TemplateData/UnityProgress.js"></script>
    <script src="/unitybuilds/{{$id}}/Build/UnityLoader.js"></script>
    <script src="/js/app.js"></script>
    <script src="/js/bootstrap.js"></script>
    <script>
      var unityInstance = UnityLoader.instantiate("unityContainer", "/unitybuilds/{{$id}}/Build/Builds.json", {onProgress: UnityProgress});
    </script>
  </head>
  <body>
      <div class="container">
        @include('includes.navbar')
      </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg">
                <h1 class="text-center">{{$gameName}}</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                @if ($hasScores)
                    <h3 class="text-center">Todays Top Scores</h3>
                    @if(count($todaysScores) > 0)
                    <table class="table table-sm table-hover text-right">
                        <tr>
                            <th>Rank</th>
                            <th>Player</th>
                            <th>Score</th>
                        </tr>
                        @foreach ($todaysScores as $key=>$scores)
                        <tr>
                            <td>{{$key +1}}</td>
                            <td><span @if(strlen($scores->name) > 15) data-toggle="tooltip" data-placement="top" title="{{$scores->name}}" @endif >{{\Illuminate\Support\Str::limit($scores->name, 15, '...')}}</span></td>
                            <td>{{$scores->score}}</td>
                        </tr>
                        @endforeach
                    </table>
                    @else
                    <br />
                    <div class="alert alert-warning text-center">No one has recorded any scores for today, will you be the first?</div>
                    @endif
                @endif
            </div>
            <div class="col-lg-6">
                <div class="webgl-content">
                    <div id="unityContainer" style="width: 100%; height: 600px margin: 0 auto"></div>
                    <div class="footer">
                    <div class="webgl-logo"></div>
                    <div class="fullscreen" onclick="unityInstance.SetFullscreen(1)"></div>
                    <div class="title">{{$gameName}}</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                @if ($hasScores)
                    <h3 class="text-center">Yesterdays Top Scores</h3>
                    @if(count($yesterdaysScores) > 0)
                    <table class="table table-sm table-hover">
                        <tr>
                            <th>Rank</th>
                            <th>Player</th>
                            <th>Score</th>
                        </tr>
                        @foreach ($yesterdaysScores as $key=>$scores)
                        <tr>
                            <td>{{$key +1}}</td>
                            <td>{{$scores->score}}</td>
                            <td><span @if(strlen($scores->name) > 15) data-toggle="tooltip" data-placement="top" title="{{$scores->name}}" @endif >{{\Illuminate\Support\Str::limit($scores->name, 15, '...')}}</span></td>
                        </tr>
                        @endforeach
                    </table>
                    @else
                    <br />
                    <div class="alert alert-warning text-center">There are no entries for yesterday.</div>
                    @endif
                @endif
            </div>
        </div>
        <div class="row">
            @if($controls != "")
            <div class="col-lg-6 text-center offset-3">
                <h3>Controls</h3>
                <p>{{ $controls }}</p>
            </div>
            @endif
        </div>
    </div>
    @include('includes.footer')
  </body>
  <script>
      $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
        });
  </script>
</html>



