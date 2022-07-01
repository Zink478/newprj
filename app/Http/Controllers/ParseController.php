<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Goutte\Client;
use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Http\Request;

class ParseController extends Controller
{
    public function index()
    {
        $goutteClient = new Client();
        $guzzleClient = new GuzzleClient(array(
            'timeout' => 60
        ));
//        $goutteClient->setClient($guzzleClient);
        $crawler = $goutteClient->request('GET', 'https://timpul.md/');
        $crawler->filter('.post-item')->each(function ($node) {
            $url = $node->filter('img')->attr('data-lazy-src');
            $name = $node->filter('.post-title')->text();
            ///////////////////////////////////////////
//            $chopName = chop($name); /////// NOSPACES TABS ETC.
//            $dbname = substr($chopName, 0, 12); ////////// SHORT NAME FOR DATABASE
//            $dbname = md5($chopName);
            $dbname = $name;
//            dd($url);
//            dd(pathinfo($url));
            $extension = pathinfo($url, PATHINFO_EXTENSION); // EXTENSION
            $finalName = $dbname . '.' . $extension; //////////////// STORAGE FILE FINALNAME
            $contents = file_get_contents($url); ///////////////// IMAGE
            Storage::disk('public')->put('post_images/' . $finalName, $contents);
//            $path = Storage::disk('public')->path('post_images/'. $finalName); // PATH
            $path = 'storage/post_images/' . $finalName;
//            Post::updateOrCreate([
//                'title' => $dbname,
//                'path' => $path
//            ]);

            $post = new Post;

            $post->title = $dbname;
            $post->path = $path;

            $post->save();

        });
    }

    public function show()
    {
        $posts = Post::all();
//        dd($posts[0]->path);
        return response()->json($posts);
    }
}
