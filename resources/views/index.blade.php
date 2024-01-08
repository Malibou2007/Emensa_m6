@extends("layouts.layout")
@vite('resources/css/emensa.css')

@section("title", "Ihre E-Mensa")

@section("Logo")
    <img src="{{ Vite::asset('resources/images/logo-FH.png') }}" class="logopic" alt="Fh-Logo">
@endsection

@section("Navigation")
    <a href="#Entrance" class="Text">Ankündigung</a>
    <a href="#Meals" class="Text">Speisen</a>
    <a href="#Numbers" class="Text">Zahlen</a>
    <a href="#Exit" class="Text">Wichtig für uns</a>
    <a href="#Direction" class="Text">Anreise</a>
@endsection

@section("Login")
    @auth
            <form action="{{ route('profil') }}" method="post">
                @csrf
                <button type="submit" class="Text_profil" style="color: white;">{{auth()->user()->name}}</button>
            </form>
    @else
        @if (Route::has('login'))
            <a class="Text" href="{{ route('login') }}">{{ __('Login') }}</a>
        @endif
    @endauth
@endsection


@section("Entrance")
    <h2 class="überschrift">Bald gibt es Essen auch online ;)</h2>
    <p>Junge wird das lecker! Ob Schnitzelmittwoch oder feinsten Fisch am Freitag! Jetzt anmelden und dem ewigen
        Mensawartschlangen entgegentreten! Wir versorgen mit leckerem Essen seit über 50 Jahren. Geld nehmen wir gerne
        von euch, aber nicht soviel wie Lidl, Rewe und die andern Kapitalisten. Scroll gerne durch, gute Website 1A,
        Lorem ipsum und so weiter. ha ha, ja ja, dies das. Folgendes sagt ChatGPT zu diesem tollen Etablissement: Unsere
        Leidenschaft für hochwertige Zutaten und geschmackvolle Zubereitung spiegelt sich in jedem Gericht, das wir
        servieren, wider. Von frischen Salaten über herzhafte Hauptspeisen bis hin zu verlockenden Desserts - unsere
        Speisekarte bietet eine breite Palette von Optionen für jeden Geschmack und jedes Bedürfnis. Wir legen großen
        Wert auf Qualität und Nachhaltigkeit und arbeiten eng mit lokalen Lieferanten zusammen, um frische und gesunde
        Lebensmittel anzubieten.</p>
@endsection

@section("Meals")
    @foreach($randomMeals as $meal)
        <div class="meal_container">
            @if($meal->bildname)
                <div class="meal_logo">
                    <img class="meal_img" src="{{ Vite::asset('resources/images/gerichte/' . $meal->bildname) }}"
                         alt={{$meal->name}}>
                </div>
                <div class="meal_logo_blur">
                    <img class="meal_img_blur" src="{{ Vite::asset('resources/images/gerichte/' . $meal->bildname) }}"
                         alt={{$meal->name}}>
                </div>
                <div class="meal_info">
                    <h3 class="meal_name">{{ $meal->name }}</h3>
                    <p class="meal_des">{{ $meal->beschreibung }}</p>
                    <div class="prices">
                        <span class="price">Intern: {{ number_format($meal->preisintern, 2) }}€</span>
                        <span class="price">Extern: {{ number_format($meal->preisextern, 2) }}€</span>
                    </div>
                    @if ($meal->allergene->count() > 0)
                        <p class="meal_allergen">Allergen
                            Codes: {{ implode(', ', $meal->allergene->pluck('code')->toArray()) }}</p>
                    @endif
                </div>
            @else
                <div class="meal_logo">
                    <img class="meal_img" src="{{ Vite::asset('resources/images/gerichte/00_image_missing.jpg') }}"
                         alt={{$meal->name}}>
                </div>
                <div class="meal_info">
                    <h3 class="meal_name">{{ $meal->name }}</h3>
                    <p class="meal_des">{{ $meal->beschreibung }}</p>
                    <div class="prices">
                        <span class="price">Intern: {{ number_format($meal->preisintern, 2) }}€</span>
                        <span class="price">Extern: {{ number_format($meal->preisextern, 2) }}€</span>
                    </div>
                    @if ($meal->allergene->count() > 0)
                        <p class="meal_allergen">Allergen
                            Codes: {{ implode(', ', $meal->allergene->pluck('code')->toArray()) }}</p>
                    @endif
                </div>
            @endif
        </div>
    @endforeach
    <div style="display: flex; justify-content: space-between; margin: 1rem; align-items: center; width: 81%;">
        <div class="allergen_legend">
            <h2>Allergenlegende:</h2>
            <p>
                @foreach($allergenLegend as $legend)
                    @if(in_array($legend->code, $allergenLegendmeals))
                        <span class="fett">{{ $legend->code }}</span> = {{ $legend->name }}@if(!$loop->last)
                            ,
                        @endif
                    @endif
                @endforeach
            </p>
        </div>
        <form method="GET" action="{{ route('wunschgericht') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div>
                <button type="submit">wunschgericht äussern</button>
            </div>
        </form>
@endsection

@section("Numbers")
    <h2 class="überschrift">E-Mensa in Zahlen</h2>
    <div class="Zahlenübersicht" id="Zahlen">
        <div class="Zahlen">
            <p class="custom-font">{{$visitercount}}</p>
            <p class="Zahlentext">Besuche</p>
        </div>
        <div class="Zahlen">
            <p class="custom-font">{{$usercount}}</p>
            <p class="Zahlentext">Anmeldungen</p>
        </div>
        <div class="Zahlen">
            <p class="custom-font">{{$mealcount}}</p>
            <p class="Zahlentext">Gerichte</p>
        </div>
    </div>
@endsection

@section("Exit")
    <h2 class="überschrift">Das ist uns wichtig</h2>
    <div class="highlights">
        <ul>
            <li>Beste frische saisonale Zutaten</li>
            <li>Ausgewogene abwechslungsreiche Gerichte</li>
            <li>Sauberkeit</li>
        </ul>
    </div>
@endsection

@section("Direction")
    <div class="anreisebild">
        <img src="{{ Vite::asset('resources/images/Eupener.png') }}" alt="Wegbeschreibung"
             style="border-radius: 10px; width: 100%; height: 100%;border: 1px solid black; padding: 5px">
    </div>
    <h2 class="überschrift" style="width: 50%; margin: 100px auto 60px;">Wir freuen uns auf ihren Besuch!</h2>
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
