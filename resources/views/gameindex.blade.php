@extends('defaulttemplate')
@section('content')
    <h1 class="text-center">Games Index</h1>
    @foreach ($gamesList as $id=>$game)
    <p><b><a href="/games/{{$id}}">{{ $game->friendlyName }}</a></b> - {{$game->description}}</ br></p>
    @endforeach
@stop

