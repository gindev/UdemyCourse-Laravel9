<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Illuminate\Http\Request;
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

    }
}
