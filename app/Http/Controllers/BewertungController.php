<?php

namespace App\Http\Controllers;

use App\Models\Bewertung;
use App\Models\Meal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BewertungController extends Controller
{
    public function bewertung(Request $request)
    {
        $meal = Meal::whereId($request->input('gerichtid'))->first();
        // Übergebe das Gerichtsobjekt an die Ansicht
        return view('bewertung', ['meal' => $meal]);
    }
    public function bewertungsübersicht(Request $request) {
        $meals = Meal::all(); // Fetch all meals
        $selectedMealId = $request->input('meal');
        $bewertungenQuery = Bewertung::orderBy('adminapproved', 'desc')
            ->orderBy('erfasst_am', 'desc');

        if ($selectedMealId !== null) {
            $bewertungenQuery->where('gericht_id', $selectedMealId);
        }
        $bewertungen = $bewertungenQuery->latest('erfasst_am')->limit(30)->get();

        return view('bewertungen', ['bewertungen' => $bewertungen, 'meals' => $meals]);
    }
    public function bewertungsverify(Request $request)
    {
        $request->validate([
            'Kommentar' => 'required|string|min:5|max:255',
            'Bewertung' => 'required',
        ]);

        if (Auth::check()) {
            $user = Auth::user();
            $Data = [
                'user_id' => $user->id,
                'gericht_id' => $request->input('gericht_id'),
                'bewertung' => $request->input('Kommentar'),
                'sterne_bewertung' => $request->input('Bewertung'),
                'adminapproved' => 0,
            ];

            Bewertung::createBewertung($Data);
        }
        return redirect('/home');
    }
    public function destroy(Request $request)
    {
        $bewertung = Bewertung::findOrFail($request->input('id'));
        $bewertung->delete();

        return redirect()->back()->with('success', 'Wunschgericht erfolgreich gelöscht');
    }
    public function accept(Request $request)
    {
        $bewertung = Bewertung::findOrFail($request->input('id'));
        $bewertung->adminapproved = 1;
        $bewertung->save();
        return redirect()->back();
    }
    public function reaccept(Request $request)
    {
        $bewertung = Bewertung::findOrFail($request->input('id'));
        $bewertung->adminapproved = 0;
        $bewertung->save();
        return redirect()->back();
    }
}
