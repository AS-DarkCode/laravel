<?php 
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class User_Controller extends Controller
{
    public function dashboard()
    {
        return view('user.dashboard');
    }
}