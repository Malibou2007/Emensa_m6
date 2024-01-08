<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use App\Models\Allergen;
use App\Models\Session;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $randomMeals = Meal::inRandomOrder()->limit(6)->get();

        $allergenLegendmeals = [];
        foreach ($randomMeals as $meal) {
            $allergene = Allergen::join('gericht_hat_allergen', 'allergen.code', '=', 'gericht_hat_allergen.code')
                ->where('gericht_hat_allergen.gericht_id', $meal->id) // Corrected the column name
                ->get();

            $meal->allergene = $allergene;
            foreach ($allergene as $allergen) {
                $allergenLegendmeals[] = $allergen->code;
            }
        }

        $allergenLegendmeals = array_unique($allergenLegendmeals);
        $allergenLegend = Allergen::distinct()->get(['code', 'name', 'typ']);


        return view('index', ['randomMeals' => $randomMeals,
                                    'allergenLegend' => $allergenLegend,
                                    'allergenLegendmeals' => $allergenLegendmeals,
                                    'visitercount' => Session::get_visitercount(),
                                    'usercount' => Session::get_userrcount(),
                                    'mealcount' => Meal::get_mealcount()]);
    }
    public function login(){
        return view('auth.login');
    }
    public function profil(){
        return view('profil');
    }
}
