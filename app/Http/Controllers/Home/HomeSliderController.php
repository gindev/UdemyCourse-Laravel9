<?php

namespace App\Http\Controllers\Home;

use Carbon\Carbon;
use App\Models\HomeSlide;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;


class HomeSliderController extends Controller
{
    public function HomeSlider()
    {
        $homeslide = HomeSlide::find(1);

        return view('admin.home_slide.home_slide_all', compact('homeslide'));
    }
    
    public function UpdateSlider(Request $request)
    {
        $slide_id = $request->id;

        if($request->file('home_slide'))
        {
            $image = $request->file('home_slide');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();

            $save_url = 'upload/home_slider/'.$name_gen;

            Image::make($image)->resize(636,852)->save($save_url);

            HomeSlide::findOrFail($slide_id)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'video_url' => $request->video_url,
                'home_slide' => $save_url,
                'created_at' => Carbon::now(),
            ]);

            $notification = array(
                'message' => 'Home Slider Updated Successfully',
                'alert-type' => 'success',
            );

            return redirect()->back()->with($notification);
        }
        else
        {
            HomeSlide::findOrFail($slide_id)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'video_url' => $request->video_url,
            ]);

            $notification = array(
                'message' => 'Home Slider Updated Successfully',
                'alert-type' => 'success',
            );

            return redirect()->back()->with($notification);
        }
    }
}
