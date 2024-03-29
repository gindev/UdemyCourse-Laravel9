<?php

namespace App\Http\Controllers\Home;

use App\Models\About;
use App\Models\MultiImage;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class AboutController extends Controller
{
    public function AboutPage()
    {
        $aboutpage = About::find(1);

        return view('admin.about_page.about_page_all', compact('aboutpage'));
    }

    public function UpdateAbout(Request $request)
    {
        $about_id = $request->id;

        if($request->file('about_image'))
        {
            $image = $request->file('about_image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();

            $save_url = 'upload/home_about/'.$name_gen;

            Image::make($image)->resize(523,605)->save($save_url);

            About::findOrFail($about_id)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'short_description' => $request->short_description,
                'long_description' => $request->long_description,
                'about_image' => $save_url,
            ]);

            $notification = array(
                'message' => 'About Page Updated Successfully',
                'alert-type' => 'success',
            );

            return redirect()->back()->with($notification);
        }
        else
        {
            About::findOrFail($about_id)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'short_description' => $request->short_description,
                'long_description' => $request->long_description,
            ]);

            $notification = array(
                'message' => 'About Page Updated Successfully',
                'alert-type' => 'success',
            );

            return redirect()->back()->with($notification);
        }
    }

    public function HomeAbout()
    {
        $aboutpage = About::find(1);
        return view('frontend.about_page', compact('aboutpage'));
    }

    public function AboutMiltiImage()
    {
        return view('admin.about_page.multiimage');
    }

    public function StoreMultiImage(Request $request)
    {
        $images = $request->file('multi_image');

        foreach($images as $image)
        {
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();

            $save_url = 'upload/multi/'.$name_gen;

            Image::make($image)->resize(220,220)->save($save_url);

            MultiImage::insert([
                'multi_image' => $save_url,
                'created_at' => Carbon::now(),
            ]);
        }

        $notification = array(
            'message' => 'Multi Images Inserted Successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('all.multi.image')->with($notification);
    }

    public function AllMultiImage()
    {
        $allMultiImages = MultiImage::all();

        return view('admin.about_page.all_multiimage', compact('allMultiImages'));
    }

    public function EditMultiImage($id)
    {
        $multiImage = MultiImage::findOrFail($id);
        return view('admin.about_page.edit_multi_image', compact('multiImage'));
    }

    public function UpdateMultiImage(Request $request)
    {
        $multi_image_id = $request->id;

        if($request->file('multi_image'))
        {
            $image = $request->file('multi_image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();

            $save_url = 'upload/multi/'.$name_gen;

            Image::make($image)->resize(523,605)->save($save_url);

            MultiImage::findOrFail($multi_image_id)->update([
                'multi_image' => $save_url,
            ]);

            $notification = array(
                'message' => 'Multi Image Updated Successfully',
                'alert-type' => 'success',
            );

            //return redirect()->route('all.multi.image')->with($notification);
        }
        else
        {
            $notification = array(
                'message' => 'Nothing updated, no image uploaded',
                'alert-type' => 'warning',
            );
            
        }
        return redirect()->route('all.multi.image')->with($notification);
    }

    public function DeleteMultiImage($id)
    {
        $multi = MultiImage::findOrFail($id);
        $img = $multi->multi_image;
        unlink($img);
        
        // try to delete with $multi->delete();

        MultiImage::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Multi Image Deleted Successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('all.multi.image')->with($notification);
    }
}
