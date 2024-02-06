<?php

namespace App\Http\Controllers;


use App\Models\Wunschgericht;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WunschgerichtController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('wunschgericht');
    }

    public function wunschgericht(Request $request)
    {
            return view('wunschgericht');
    }


    public function wunschverify(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'beschreibung' => 'required|string',
        ]);

        if (Auth::check()) {
            $user = Auth::user();

            // Daten für das Wunschgericht vorbereiten
            $wunschgerichtData = [
                'name' => $request->input('name'),
                'beschreibung' => $request->input('beschreibung'),
                'autor' => $user->name,
                'autormail' => $user->email,
            ];

            // Wunschgericht erstellen
            Wunschgericht::createWunschgericht($wunschgerichtData);

            return redirect()->route('wunschgericht')->with('success', 'Wunschgericht erfolgreich eingereicht!');
        } else {
            // Benutzer ist nicht authentifiziert, zum Login weiterleiten
            return redirect('/login')->with('error', 'Sie müssen eingeloggt sein, um ein Wunschgericht einzureichen.');
        }
    }
    public function destroy(Request $request)
    {
        $wunschgericht = Wunschgericht::findOrFail($request->input('id'));
        $wunschgericht->delete();

        return redirect('/profil')->with('success', 'Wunschgericht erfolgreich gelöscht');
    }
}
