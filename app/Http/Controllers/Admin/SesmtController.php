<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class SesmtController extends Controller
{
    public function accident()
    {
        return View('sesmt.accident.index');
    }

    public function category()
    {
        return View('sesmt.category.index');
    }

    public function certificate()
    {
        return View('sesmt.ca.index');
    }

    public function employee()
    {
        return View('sesmt.employee.index');
    }


    public function sector()
    {
        return View('sesmt.sector.index');
    }

    public function enterprise()
    {
        return View('sesmt.enterprise.index');
    }

    public function exam()
    {
        return View('sesmt.exam.index');
    }

    public function input()
    {
        return View('sesmt.input.index');
    }

    public function output()
    {
        return View('sesmt.output.index');
    }

    public function position()
    {
        return View('sesmt.position.index');
    }

    public function product()
    {
        return View('sesmt.product.index');
    }

    public function training()
    {
        return View('sesmt.training.index');
    }

    public function typeaccident()
    {
        return View('sesmt.typeaccident.index');
    }
}
