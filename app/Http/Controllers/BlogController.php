<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use GuzzleHttp\Psr7\Response;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Blog::orderBy('id', 'desc')->paginate(25);
        return response()->json([
            'Blogs' => $posts,
        ], 200);
    }

    public function create()
    {
        //show create blog form
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'Required|string|min:5|max:100',
            'description' => 'Required|string|min:5|max:2000',
            'user_id' => 'Required|integer',
            'category_id' => 'Required',
            'tag_id' => 'Required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'rate' => 'Required|integer',

        ]);
        $imageName = time() . '.';
        $categories = Category::pluck('id');
        $tags = Tag::pluck('id');

        $blog = new Blog;
        $blog = [
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imageName,
            'user_id' => Auth::user()->id,
            'category_id' => $categories = 1,
            'tag_id' => $tags = 1,
            'rate' => $request->rate,
        ];

        Blog::create($blog);
        return response()->json([
            'blog' => $blog,
            'message' => 'Blog created successfully',
        ], 201);
    }

    public function show(Blog $blog)
    {
        return $blog;
    }

    public function edit(Blog $blog)
    {
        //show edit blog form
        return $blog;
    }

    public function update(Request $request, Blog $blog, $id)
    {
        // dd($blog);

        $validated = Blog::find($id)->update([
            'title' => 'Required|string|min:5|max:100',
            'description' => 'Required|string|min:5|max:2000',
            'user_id' => 'Required|integer',
            'category_id' => 'Required',
            'tag_id' => 'Required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'rate' => 'Required|integer',

        ]);
        // dd($validated);

        $imageName = time() . '.';
        $categories = Category::pluck('id');
        $tags = Tag::pluck('id');

        // $blog = new Blog;
        $blog = [
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imageName,
            'user_id' => Auth::user()->id,
            'category_id' => $categories = 1,
            'tag_id' => $tags = 1,
            'rate' => $request->rate,
        ];
        // $blog->update($validated);
        return response()->json([
            'blog' => $blog,
            'message' => 'Blog created successfully',
        ], 201);
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();
        return response()->json([
            'message' => 'Blog deleted successfully',
        ], 200);
    }
}
