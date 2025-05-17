<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index() {
        $users = User::paginate(10); // Paginate users, 10 per page
        return view('user-management.index', compact('users'));
    }
}
