<?php

namespace App\Http\Controllers\Auth\Api;

use App\Http\Controllers\Controller;
use App\Models\MemberList;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function viewProject()
    {
        return view('projects');
    }
    public function showProjects()
    {
        $project = MemberList::with(['hasUser','hasPosition','hasProject'])->get();
        foreach ($project as $value)
        {
            echo "<pre>";
            print_r($value->hasUser->name);
        }
    }
}
