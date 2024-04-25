<?php

namespace App\Http\Controllers\api;
use App\Models\User;
use App\Http\Resources\UserResource;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    function index()
    {
        $users = User::paginate(10);
        return UserResource::collection($users);
    }
}
