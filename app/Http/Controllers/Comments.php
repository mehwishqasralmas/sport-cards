<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comments as CommentsModel;

class Comments extends Controller
{
    public function index() {
        return CommentsModel::all();
    }

    public function add(Request $req) {
        CommentsModel::create($req->all());
        return ["message" => "success"];
    }

    public function update(Request $req, CommentsModel $comment) {
        $comment->update($req->all());
        return ["message" => "success"];
    }

    public function delete(Request $req, CommentsModel $comment) {
        $comment->delete();
        return ["message" => "success"];
    }
}
