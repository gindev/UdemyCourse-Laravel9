<?php

namespace App\Http\Controllers\Home;

use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class BlogController extends Controller
{
    public function AllBlog()
    {
        $blogs = Blog::latest()->get();
        return view('admin.blogs.blogs_all', compact('blogs'));
    }

    public function AddBlog()
    {
        $categories = BlogCategory::orderBy('blog_category', 'ASC')->get();
        return view('admin.blogs.blogs_add', compact('categories'));
    }

    public function StoreBlog(Request $request)
    {
        $image = $request->file('blog_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();

        $save_url = 'upload/blog/'.$name_gen;

        Image::make($image)->resize(430,327)->save($save_url);

        Blog::insert([
            'blog_category_id' => $request->blog_category_id,
            'blog_title' => $request->blog_title,
            'blog_image' => $save_url,
            'blog_description' => $request->blog_description,
            'blog_tags' => $request->blog_tags,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Blog Inserted Successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('all.blog')->with($notification);
    }

    public function EditBlog($id)
    {
        $blog = Blog::findOrFail($id);
        $categories = BlogCategory::orderBy('blog_category', 'ASC')->get();
        return view('admin.blogs.blogs_edit', compact('blog','categories'));
    }

    public function UpdateBlog(Request $request)
    {
        $blog_id = $request->id;

        if($request->file('blog_image'))
        {
            $image = $request->file('blog_image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();

            $save_url = 'upload/blog/'.$name_gen;

            Image::make($image)->resize(430,327)->save($save_url);

            Blog::findOrFail($blog_id)->update([
                'blog_category_id' => $request->blog_category_id,
                'blog_title' => $request->blog_title,
                'blog_image' => $save_url,
                'blog_description' => $request->blog_description,
                'blog_tags' => $request->blog_tags,
            ]);

            $notification = array(
                'message' => 'Blog Updated Successfully',
                'alert-type' => 'success',
            );

            return redirect()->route('all.blog')->with($notification);
        }
        else
        {
            Blog::findOrFail($blog_id)->update([
                'blog_category_id' => $request->blog_category_id,
                'blog_title' => $request->blog_title,
                'blog_description' => $request->blog_description,
                'blog_tags' => $request->blog_tags,
            ]);

            $notification = array(
                'message' => 'Blog Updated Successfully',
                'alert-type' => 'success',
            );

            return redirect()->route('all.blog')->with($notification);
        }
    }

    public function DeleteBlog($id)
    {
        $blog = Blog::findOrFail($id);
        $img = $blog->blog_image;
        unlink($img);
        
        // try to delete with $portfolio->delete();

        Blog::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Blog Deleted Successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('all.blog')->with($notification);
    }

    public function BlogDetails($id)
    {
        $blog = Blog::findOrFail($id);
        $allBlogs = Blog::latest()->limit(5)->get();
        $categories = BlogCategory::orderBy('blog_category', 'ASC')->get();

        return view('frontend.blog_details', compact('blog','allBlogs','categories'));
    }

    public function CategoryBlog($id)
    {
        $blogpost = Blog::where('blog_category_id', $id)->orderBy('id','DESC')->get();
        $allBlogs = Blog::latest()->limit(5)->get();
        $categories = BlogCategory::orderBy('blog_category', 'ASC')->get();
        $category = BlogCategory::findOrFail($id);

        return view('frontend.category_blog_details',compact('blogpost','category','allBlogs','categories'));
    }

    public function HomeBlog()
    {
        $allBlogs = Blog::latest()->get();
        $categories = BlogCategory::orderBy('blog_category', 'ASC')->get();

        return view('frontend.blog',compact('allBlogs','categories'));
    }
}
