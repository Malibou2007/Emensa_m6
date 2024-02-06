@extends("layouts.view_layout")
@vite('resources/css/profil.css')
@section("title", "Ihre E-Mensa")

@section("Logo")
    <a class="navbar-brand" style="margin-right: 2rem;" href="{{ url('/') }}">Emensa</a>
@endsection

@section("Navigation")
    <h1>Bewertungen</h1>
@endsection

@section("Login")
    @auth
        <form action="{{ route('profil') }}" method="post">
            @csrf
            <button type="submit" class="button_def" style=" margin-left: -2rem; margin-right: 2rem; color: white;">{{auth()->user()->name}}</button>
        </form>
    @else
        @if (Route::has('login'))
            <a class="Text" style="margin-right: 5rem;" href="{{ route('login') }}">{{ __('Login') }}</a>
        @endif
    @endauth
@endsection

@section("Bewertungen")
    <div class="section-container">
        <h2>Deine Bewertungen</h2>

        <form action="{{ route('bewertungen') }}" method="get">
            @csrf
            <label for="meal">Filter by Meal:</label>
            <select name="meal" id="meal" style="border-radius: 1rem;">
                <option value="">All Meals</option>
                @foreach($meals as $meal)
                    <option value="{{ $meal->id }}">{{ $meal->name }}</option>
                @endforeach
            </select>
            <button type="submit" style="margin:0.5rem 0 0 0; color: white;" class="button_def">Filter</button>
        </form>

        <table class="table_common">
            <thead>
            <tr>
                <th colspan="2">Gericht</th>
                <th>Bewertung</th>
                <th>Sternebewertung</th>
                <th>Erfasst am</th>
                <th>Aktionen</th> <!-- New column for actions -->
            </tr>
            </thead>
            <tbody>
            @foreach($bewertungen as $bewertung)
                <tr>
                    @if($bewertung->adminapproved)
                        @if($bewertung->meal->bildname)
                            <td><img class="meal_img" style="width: 10rem;height: 10rem; border-radius: 5rem; border: 0.3rem solid gold;" src="{{ Vite::asset('resources/images/gerichte/' . $bewertung->meal->bildname) }}" alt="{{ $meal->name }}"></td>
                        @else
                            <td><img class="meal_img" style="width: 10rem;height: 10rem; border-radius: 5rem; border: 0.3rem solid gold;" src="{{ Vite::asset('resources/images/gerichte/00_image_missing.jpg') }}" alt="{{ $meal->name }}"></td>
                        @endif
                    @else
                        @if($bewertung->meal->bildname)
                            <td><img class="meal_img" style="width: 10rem;height: 10rem; border-radius: 0;" src="{{ Vite::asset('resources/images/gerichte/' . $bewertung->meal->bildname) }}" alt="{{ $meal->name }}"></td>
                        @else
                            <td><img class="meal_img" style="width: 10rem;height: 10rem; border-radius: 0;" src="{{ Vite::asset('resources/images/gerichte/00_image_missing.jpg') }}" alt="{{ $meal->name }}"></td>
                        @endif
                    @endif
                    <td>{{ $bewertung->meal->name }}</td>
                    <td>{{ $bewertung->bewertung }}</td>
                    <td>{{ $bewertung->sterne_bewertung }}</td>
                    <td>{{ $bewertung->erfasst_am }}</td>
                    <td>
                        @auth
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
                                    <form action="{{ route('deleteBewertung', ['id' => $bewertung->id]) }}" method="post">
                                        @csrf
                                        <button type="submit" class="button_def" style="margin-left: 0; margin-right: 2rem; color: white;">Löschen</button>
                                    </form>
                            @elseif(auth()->user()->id === $bewertung->user->id)
                                <form action="{{ route('deleteBewertung', ['id' => $bewertung->id]) }}" method="post">
                                    @csrf
                                    <button type="submit" class="button_def" style="margin-left: 0; margin-right: 2rem; color: white;">Löschen</button>
                                </form>
                            @endif
                        @endauth
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
@endsection
