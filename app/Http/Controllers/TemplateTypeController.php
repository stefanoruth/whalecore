<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TemplateType;

class TemplateTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TemplateType::all();
    }
}
