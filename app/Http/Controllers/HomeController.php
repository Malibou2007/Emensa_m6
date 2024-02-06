<?php

namespace App\Http\Controllers;

use App\Models\Bewertung;
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
        $bewertungen=[];
        foreach ($randomMeals as $meal) {

            $bewertungen[] = $meal->bewertung()->get();
        }
        $bewertungenInProzent = [];
        foreach ($bewertungen as $bewertung) {
            $gesamtBewertung = 0;
            $anzahlBewertungen = $bewertung->count();

            foreach ($bewertung as $einzelBewertung) {
                $gesamtBewertung += $this->umrechnenInProzent($einzelBewertung->sterne_bewertung);
            }

            if ($anzahlBewertungen > 0) {
                $bewertungenInProzent[] = $gesamtBewertung / $anzahlBewertungen;
            } else {
                $bewertungenInProzent[] = 0;
            }
        }
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
                                    'mealcount' => Meal::get_mealcount(),
                                    'bewertungen' => $bewertungen,
                                    'bewertungenProzent' => $bewertungenInProzent,]);
    }
    public function login(){
        return view('auth.login');
    }
    public function profil()
    {
        if (auth()->user()->admin) {
            $bewertungen = Bewertung::orderBy('erfasst_am', 'desc')->get();
        } else {
            // Wenn der Benutzer kein Admin ist, nur eigene Bewertungen anzeigen
            $bewertungen = auth()->user()->bewertungen()->orderBy('erfasst_am', 'desc')->get();
        }

        return view('profil', ['bewertungen' => $bewertungen]);
    }

    function umrechnenInProzent($bewertungString)
    {
        switch ($bewertungString) {
            case 'schlecht':
                return 33;
            case 'gut':
                return 66;
            case 'sehr gut':
                return 100;
            default:
                return 0; // Default-Wert für unbekannte Bewertungen
        }
    }
}
