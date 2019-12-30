<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function user()
    {
        return View('admin.user.index');
    }

    public function developer()
    {
        return View('admin.developer.index');
    }

    public function profile()
    {
        return View('admin.profile.index');
    }


}
