<?php

namespace App\Http\Controllers;


use App\Models\Category;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminBlogController extends Controller
{
    public function index()
    {
        return view('admin.blogs.index', [
            'blogs' => Blog::latest()->paginate(4)
        ]);
    }

    public function create()
    {
        //custom middle create yan
        return view('admin.blogs.create', [
            'categories' => Category::all()
        ]);
    }

    public function store(Request $request)
    {


        request()->validate([
            'title' => ['required'],
            'intro' => ['required'],
            'slug' => ['required', Rule::unique('blogs', 'slug')],
            'body' => ['required'],
            "category_id" => ['required', Rule::exists('categories', 'id')]


        ]);
        $post = new Blog();
        $post->title = $request->title;
        $post->intro = $request->intro;
        $post->slug = $request->slug;
        $post->body = $request->body;
        $post->category_id = $request->category_id;

        // Upload Image
        $thumbnail = $request->thumbnail;
        if ($thumbnail) {

            $imagename = time() . '.' . $thumbnail->getClientOriginalExtension();
            $request->thumbnail->move('postimage', $imagename);
            $post->thumbnail = $imagename;
        }
        $post['user_id'] = auth()->id();

        $post->save();
        return redirect('/');
    }

    //Delete
    public function destory(Blog $blog)

    {
        // dd($blog_delete);
        $blog->delete();
        return back();
    }

    //Edit
    public function edit(Blog $blog)
    {
        return view('admin.blogs.edit', [
            'blog' => $blog,
            'categories' => Category::all()
        ]);
    }
    public  function update(Request $request, $id)
    {
        $postupdate = Blog::find($id);
        $postupdate->title = $request->title;
        $postupdate->intro = $request->intro;
        $postupdate->slug = $request->slug;
        $postupdate->body = $request->body;
        $postupdate->category_id = $request->category_id;

        // Upload Image
        $thumbnail = $request->thumbnail;
        if ($thumbnail) {

            $imagename = time() . '.' . $thumbnail->getClientOriginalExtension();
            $request->thumbnail->move('postimage', $imagename);
            $postupdate->thumbnail = $imagename;
        }
        $postupdate['user_id'] = auth()->id();

        $postupdate->save();
        return redirect()->back()->with('success', 'Blog Update Successfully');
    }
}
