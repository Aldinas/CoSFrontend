<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class ScoreController extends Controller
{
    public function gameView($id)
    {
        /* Use this controller for games that call the API for the scoring system */
        // Get the two seeds we'll need:
        $todaysSeed = $this->getSeed();
        $yesterdaysSeed = $this->getSeed(Carbon::now()->subtract(1, 'day')->format('d-m-Y'));

        // Convert ID to  lowercase for uniformity.
        $id = strtolower($id);

        // Get the scores in JSON format.
        try
        {
            $todayScoresJson = file_get_contents(env("COS_ENDPOINT") . $id . "/scores/" . $todaysSeed);
            $todaysScores = array_slice(json_decode($todayScoresJson), 0, 12);
        } catch (\Throwable $th)
        {
            $todaysScores = [];
        }

        try
        {
            $yesterdayScoresJson = file_get_contents(env("COS_ENDPOINT") . $id . "/scores/" . $yesterdaysSeed);
            $yesterdaysScores = array_slice(json_decode($yesterdayScoresJson), 0, 12);
        } catch (\Throwable $th)
        {
            $yesterdaysScores = [];
        }

        $data['id'] = $id;
        $data["todaysScores"] = $todaysScores;
        $data["yesterdaysScores"] = $yesterdaysScores;

        // TODO: Rebuild these projects in unity to use WebGL player, for now its a bit hit and miss.
        if($id == "smashsteroids")
        {
            return redirect("unitybuilds/smashsteroids/smashsteroids.html");
        }
        else if($id == "tapracer")
        {
            return redirect("unitybuilds/tapracer/index.html");
        }
        else
        {
            $availableGames = scandir('unitybuilds/');

            if(in_array($id, $availableGames))
            {
                // Get the game data
                $gameData = $this->getGameData($id);
                $data['controls'] = $gameData->controls;
                $data['hasScores'] = $gameData->hasScores;
                $data['gameName'] = $gameData->friendlyName;

                return view('scoregame', $data);
            }
            else
                return ('Sorry, no game found by that name.');
        }
    }

    public function getSeed(string $date = null)
    {
        // Returns the seed for the given date, or today if none given.
        // Date needs to be in the format of dd-mm-yyyy.
        if($date == null)
        {
            $date = Carbon::now()->format('d-m-Y');
        }

        $cleanDate = str_replace("-", "", $date);
        return $cleanDate;
    }

    public function getGameData($id)
    {
        $gameFile = Storage::disk('local')->get("games.json");
        $gameData = json_decode($gameFile);

        return $gameData->$id;
    }

    public function gamesIndex()
    {
        // Remove the Template data and linux dot dirs.
        $gameFile = Storage::disk('local')->get("games.json");

        $data['gamesList'] = json_decode($gameFile);

        // return response()->json($data);
        return view('gameindex', $data);
    }
}
