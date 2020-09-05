<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/">Closed on Sundays</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item @if(Request::is('/')) active @endif">
          <a class="nav-link" href="/">About</a>
        </li>
        <li class="nav-item dropdown @if(Request::is('games/*')) active @endif">
          <a class="nav-link dropdown-toggle " href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Unity Projects
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            @foreach($gamesList as $id=>$game)
                <a class="dropdown-item @if(Request::is("games/$id")) active @endif" href="/games/{{$id}}">{{$game->friendlyName}}</a>
            @endforeach
          </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="https://github.com/aldinas">Github</a>
          </li>
      </ul>
    </div>
  </nav>
