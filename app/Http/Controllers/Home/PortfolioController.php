<?php

namespace App\Http\Controllers\Home;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class PortfolioController extends Controller
{
    public function AllPortfolio()
    {
        $portfolio = Portfolio::latest()->get();
        return view('admin.portfolio.portfolio_all', compact('portfolio'));
    }

    public function AddPortfolio()
    {
        return view('admin.portfolio.portfolio_add');
    }

    public function StorePortfolio(Request $request)
    {
        $request->validate([
            'portfolio_name' => 'required',
            'portfolio_title' => 'required',
            'portfolio_image' => 'required',
        ],[
            'portfolio_name.required' => 'Portfolio Name is Required',
            'portfolio_title.required' => 'Portfolio Title is Required',
        ]);

        $image = $request->file('portfolio_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();

        $save_url = 'upload/portfolio/'.$name_gen;

        Image::make($image)->resize(1020,519)->save($save_url);

        Portfolio::insert([
            'portfolio_name' => $request->portfolio_name,
            'portfolio_title' => $request->portfolio_title,
            'portfolio_image' => $save_url,
            'portfolio_description' => $request->portfolio_description,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Portfolio Inserted Successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('all.portfolio')->with($notification);
    }

    public function EditPortfolio($id)
    {
        $portfolio = Portfolio::findOrFail($id);

        return view('admin.portfolio.portfolio_edit', compact('portfolio'));
    }

    public function UpdatePortfolio(Request $request)
    {
        $portfolio_id = $request->id;

        if($request->file('portfolio_image'))
        {
            $image = $request->file('portfolio_image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();

            $save_url = 'upload/portfolio/'.$name_gen;

            Image::make($image)->resize(1020,519)->save($save_url);

            Portfolio::findOrFail($portfolio_id)->update([
                'portfolio_name' => $request->portfolio_name,
                'portfolio_title' => $request->portfolio_title,
                'portfolio_image' => $save_url,
                'portfolio_description' => $request->portfolio_description,
            ]);

            $notification = array(
                'message' => 'Portfolio Updated Successfully',
                'alert-type' => 'success',
            );

            return redirect()->route('all.portfolio')->with($notification);
        }
        else
        {
            Portfolio::findOrFail($portfolio_id)->update([
                'portfolio_name' => $request->portfolio_name,
                'portfolio_title' => $request->portfolio_title,
                'portfolio_description' => $request->portfolio_description,
            ]);

            $notification = array(
                'message' => 'Portfolio Updated Successfully',
                'alert-type' => 'success',
            );

            return redirect()->route('all.portfolio')->with($notification);
        }
    }

    public function DeletePortfolio($id)
    {
        $portfolio = Portfolio::findOrFail($id);
        $img = $portfolio->portfolio_image;
        unlink($img);
        
        // try to delete with $portfolio->delete();

        Portfolio::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Portfolio Deleted Successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('all.portfolio')->with($notification);
    }

    public function PortfolioDetails($id)
    {
        $portfolio = Portfolio::findOrFail($id);

        return view('frontend.portfolio_details', compact('portfolio'));       
    }
}