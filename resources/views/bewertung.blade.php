@extends("layouts.view_layout")
@vite('resources/css/profil.css')
@section("title", "Ihre E-Mensa")

@section("Logo")
    <img src="{{ Vite::asset('resources/images/logo-FH.png') }}" class="logopic" alt="Fh-Logo">
@endsection

@section("Navigation")
    <h1>{{$meal->name}}</h1>
@endsection

@section("Login")
        <form action="{{ route('profil') }}" method="post">
            @csrf
            <button type="submit" class="button_def" style=" margin-left: -1rem; margin-right: 2rem; color: white;">{{auth()->user()->name}}</button>
        </form>
@endsection

@section("Main")
    <div class="bewertbar">
        <div class="meal_logo">
            @if($meal->bildname)
                <img class="meal_img" src="{{ Vite::asset('resources/images/gerichte/' . $meal->bildname) }}" alt="{{$meal->name}}">
            @else
                <img class="meal_img" src="{{ Vite::asset('resources/images/gerichte/00_image_missing.jpg') }}" alt="{{$meal->name}}">
            @endif
        </div>

        <div class="bewertung-form">
            <form method="POST" action="{{ route('bewertungsverify') }}">
            @csrf
                <input type="hidden" name="gericht_id" value="{{ $meal->id }}">
                <div class="form-group">
                    <label for="bewertung">Bewertung:</label>
                    <select id="bewertung" name="Bewertung">
                        <option value="sehr gut">sehr gut</option>
                        <option value="gut">gut</option>
                        <option value="schlecht">schlecht</option>
                        <option value="sehr schlecht">sehr schlecht</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="Kommentar">Kommentar:</label>
                    <input type="text" id="Kommentar" name="Kommentar">
                </div>
                <button class='button_pro' type="submit">Abschicken</button>
            </form>

        </div>
    </div>
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
