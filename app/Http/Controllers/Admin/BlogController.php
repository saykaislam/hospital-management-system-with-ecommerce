<?php

namespace App\Http\Controllers\Admin;

use App\Blog;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{

    public function index()
    {
        $blogs = Blog::latest()->get();
        return view('backend.admin.blogs.index',compact('blogs'));
    }


    public function create()
    {
        return view('backend.admin.blogs.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title'=> 'required',
            'description'=> 'required',
            'image'=> 'required',
        ]);
        $blog = new Blog();
        $blog->title = $request->title;
        $blog->slug = Str::slug($request->title);
        $blog->author = $request->author;
        $blog->description = $request->	description;
        $blog->short_description = strip_tags($request->description);
        if($request->hasFile('image')){
            $blog->image = $request->image->store('uploads/blogs/');
        }
        $blog->save();
        Toastr::success('Blog Created Successfully', 'Success');
        return redirect()->route('admin.blogs.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $blog = Blog::find($id);
        return view('backend.admin.blogs.edit',compact('blog'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title'=> 'required',
            'description'=> 'required',

        ]);
        $blog = Blog::find($id);
        $blog->title = $request->title;
        $blog->slug = Str::slug($request->title);
        $blog->author = $request->author;
        $blog->description = $request->	description;
        $blog->short_description = strip_tags($request->description);
        if($request->hasFile('image')){
            $blog->image = $request->image->store('uploads/blogs/');
        }
        $blog->save();
        Toastr::success('Blog Updated Successfully', 'Success');
        return redirect()->route('admin.blogs.index');
    }

    public function destroy($id)
    {
        $blog = Blog::find($id);
        if(Blog::destroy($id)){
            if($blog->image != null){
                unlink($blog->image);
            }
            Toastr::success('Blog Deleted Successfully');
            return redirect()->route('admin.blogs.index');
        }
    }
}
