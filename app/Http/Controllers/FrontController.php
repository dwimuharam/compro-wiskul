<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAppointmentRequest;
use App\Models\Appointment;
use App\Models\CompanyAbout;
use App\Models\CompanyStatistic;
use App\Models\HeroSection;
use App\Models\OurPrinciple;
use App\Models\OurTeam;
use App\Models\Product;
use App\Models\ShopItem;
use App\Models\Testimonial;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    //
    public function index(){
        $hero_section = HeroSection::orderByDesc('id')->take(1)->get(); 
        $testimonials = Testimonial::take(4)->get(); 
        $statistics = CompanyStatistic::take(4)->get(); 
        $principles = OurPrinciple::take(4)->get();
        $products = Product::take(4)->get();
        $teams = OurTeam::take(7)->get();
        return view('front.index', compact('hero_section', 'statistics', 'principles', 'products', 'teams', 'testimonials'));
    }

    public function team(){
        $statistics = CompanyStatistic::take(4)->get(); 
        $teams = OurTeam::take(14)->get();
        return view('front.team', compact('teams', 'statistics'));
    }

    public function about(){
        $statistics = CompanyStatistic::take(4)->get(); 
        $abouts = CompanyAbout::take(2)->get(); 
        return view('front.about', compact('statistics', 'abouts'));
    }

    public function appointment(){
        $products = Product::take(3)->get();
        $testimonials = Testimonial::take(4)->get(); 
        return view('front.appointment', compact('testimonials', 'products'));
    }

    public function appointment_store(StoreAppointmentRequest $request){
        DB::transaction(function() use ($request) {
            $validated = $request->validated();
            $newAppointment = Appointment::create($validated);
        });
        return redirect()->route('front.index');
    }

    public function shop(Request $request)
    {
    $query = \App\Models\ShopItem::query();

    // Hanya filter jika ada parameter kategori dan nilainya valid
        if ($request->has('category') && in_array($request->category, ['merchandise', 'ebook'])) {
            $query->where('category', $request->category);
        }

        $shopItems = $query->latest()->get();

        return view('front.shop.index', compact('shopItems'));
    }

    public function shop_show(ShopItem $item)
    {
        return view('front.shop.show', compact('item'));
    }

}
