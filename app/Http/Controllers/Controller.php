<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Helpers\Http;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function getPosts()
    {
        $data = Http::get('https://jsonplaceholder.typicode.com/posts');
        $posts = json_decode($data->getBody()->getContents());
        dd($posts);
    }


    public function addPost()
    {
        $data = Http::post('https://jsonplaceholder.typicode.com/posts', [
            'title' => 'foo',
            'body' => 'bar',
            'userId' => 1
        ]);
        $post = json_decode($data->getBody()->getContents());
        dd($post);
    }
}
