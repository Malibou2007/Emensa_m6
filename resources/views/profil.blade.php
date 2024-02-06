@extends("layouts.view_layout")
@vite('resources/css/profil.css')
@section("title", "Ihre E-Mensa")

@section("Logo")
    <a class="navbar-brand" style="margin-right: 2rem;" href="{{ url('/') }}">Emensa</a>
@endsection

@section("Navigation")
    <h1>{{auth()->user()->name}}</h1>
@endsection

@section("Login")
        <form action="{{ route('logout') }}" method="post">
            @csrf
            <button type="submit" class="button_def" class="Text" style=" margin-left: -1rem; margin-right: 2rem; color: white;">Logout</button>
        </form>
@endsection

@section("Main")
    <table class="table_profile">
        <tbody>
            <tr>
                <td>
                    Name:
                </td>
                <td>
                    {{auth()->user()->name}}
                </td>
            </tr>
            <tr>
                <td>
                    Email:
                </td>
                <td>
                    {{auth()->user()->email}}
                </td>
            </tr>
            <tr>
                <td>
                    Rolle:
                </td>
                <td>
                    @if(auth()->user()->admin)
                        Admin
                    @else
                        Nutzer
                    @endif
                </td>
            </tr>
            <tr>
                <td>
                    Letzte Anmeldung:
                </td>
                <td>
                    {{auth()->User()->letzteanmeldung}}
                </td>
            </tr>
            <tr>
                <td>
                    Letzter Anmeldefehler:
                </td>
                <td>
                    @if(auth()->User()->letzterfehler)
                        {{auth()->User()->letzterfehler}}
                    @else
                        -
                    @endif
                </td>
            </tr>
        </tbody>
    </table>
@endsection

@section("Bewertungen")
    <div class="section-container">
        <h2>Deine Bewertungen</h2>

        <table class="table_common">
            <thead>
            <tr>
                <th>Gericht</th>
                <th>Bewertung</th>
                <th>Sternebewertung</th>
                <th>Erfasst am</th>
                <th>Aktionen</th> <!-- New column for actions -->
            </tr>
            </thead>
            <tbody>
            @foreach($bewertungen as $bewertung)
                <tr>
                    <td>{{ $bewertung->meal->name }}</td>
                    <td>{{ $bewertung->bewertung }}</td>
                    <td>{{ $bewertung->sterne_bewertung }}</td>
                    <td>{{ $bewertung->erfasst_am }}</td>
                    <td>
                        @if(auth()->user()->admin)
                            @if($bewertung->adminapproved)
                                <p>{{ $bewertung->user->name }}</p>
                                <form action="{{ route('reacceptBewertung', ['id' => $bewertung->id]) }}" method="post">
                                    @csrf
                                    <button type="submit" class="button_def_grey" style="margin-left: 0; margin-right: 2rem;">Akzeptiert</button>
                                </form>
                            @else
                                <p>{{ $bewertung->user->name }}</p>
                                <form action="{{ route('acceptBewertung', ['id' => $bewertung->id]) }}" method="post">
                                    @csrf
                                    <button type="submit" class="button_def" style="margin-left: 0; margin-right: 2rem; color: white;">Akzeptieren</button>
                                </form>
                            @endif
                        @endif
                        <form action="{{ route('deleteBewertung', ['id' => $bewertung->id]) }}" method="post">
                            @csrf
                            <button type="submit" class="button_def" style="margin-left: 0; margin-right: 2rem; color: white;">Löschen</button>
                        </form>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
@endsection




@section("content")
    <h2>Deine Wunschgerichte</h2>
    <table class="table_wunschgerichte">
        <tbody>
        @if(auth()->user()->admin)
            <!-- Display all Wunschgerichte for admin users -->
            @foreach(App\Models\Wunschgericht::all() as $wunschgericht)
                <tr>
                    <td>Name:</td>
                    <td>{{ $wunschgericht->name }}</td>
                    <td>Beschreibung:</td>
                    <td>{{ $wunschgericht->beschreibung }}</td>
                    <td>Autor:</td>
                    <td>{{ $wunschgericht->autor }}</td>
                    <td>
                        <form action="{{ route('deleteWunschgericht', ['id' => $wunschgericht->id]) }}" method="post">
                            @csrf
                            <button type="submit" class="button_def" style="margin-left: 0; margin-right: 2rem; color: white;">Löschen</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        @else
            <!-- Display only the user's Wunschgerichte for non-admin users -->
            @foreach(auth()->user()->wunschgerichte as $wunschgericht)
                <tr>
                    <td>Name:</td>
                    <td>{{ $wunschgericht->name }}</td>
                    <td>Beschreibung:</td>
                    <td>{{ $wunschgericht->beschreibung }}</td>
                    <td>
                        <form action="{{ route('deleteWunschgericht', ['id' => $wunschgericht->id]) }}" method="post">
                            @csrf
                            <button type="submit" class="button_def" style="margin-left: 0; margin-right: 2rem; color: white;">Löschen</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
@endsection



@section("Footer")
    <div class="footer">
        <div><a>(c) E-Mensa GmbH</a></div>
        <div class="vertical"></div>
        <div><a>Malte & Konstantin</a></div>
        <div class="vertical"></div>
        <div><a style="color: rgba(64,190,170,255); text-decoration: underline; cursor: pointer">Impressum</a></div>
    </div>
@endsection
