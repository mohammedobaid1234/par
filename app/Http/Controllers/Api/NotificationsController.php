<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotificationsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['show', 'index']);
    }
    public function index($id) {
        $notUser = DB::table('notifications')->where('notifiable_id', $id)->get();
        return $notUser;
    }
}
