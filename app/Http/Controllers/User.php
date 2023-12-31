<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User as UserModel;
use App\Http\Controllers\UserPlayers as UserPlayersController;
use App\Http\Controllers\Matches as MatchesController;

class User extends Controller
{
    public function index(Request $req) {
        $userId = $req->user()->id;
        return UserModel::whereNot('id', $userId)->get();
    }

    public function updateUserInfo(Request $req) {
        $data = $req->only([
            'img_url', 'name', 'birthdate', 'budget', 'score', 'mobile'
        ]);

        $user = $req->user();
        $user->updateOrFail($data);
        return ["message" => "success"];
    }

    public function getDetails(Request $req, UserModel $user) {
        $user->players = (new UserPlayersController())
            ->getUserPlayers($req, $user->id);
        $user->matchStats = (new MatchesController())
            ->getUserMatchesStats($user->id);
        return $user;
    }

    public function deleteProfile(Request $req) {
        $userId = $req->user()->id;
        UserModel::whereKey($userId)->delete();
        return ["message" => "success" ];
    }
}
