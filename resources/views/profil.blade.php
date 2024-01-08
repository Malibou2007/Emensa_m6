@extends("layouts.view_layout")
@vite('resources/css/profil.css')
@section("title", "Ihre E-Mensa")

@section("Logo")
    <img src="{{ Vite::asset('resources/images/logo-FH.png') }}" class="logopic" alt="Fh-Logo">
@endsection

@section("Navigation")
    <h1>{{auth()->user()->name}}</h1>
@endsection

@section("Login")
        <form action="{{ route('logout') }}" method="post">
            @csrf
            <button type="submit" class="Text" style="color: white;">Logout</button>
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

@section("Footer")
    <div class="footer">
        <div><a>(c) E-Mensa GmbH</a></div>
        <div class="vertical"></div>
        <div><a>Malte & Konstantin</a></div>
        <div class="vertical"></div>
        <div><a style="color: rgba(64,190,170,255); text-decoration: underline; cursor: pointer">Impressum</a></div>
    </div>
@endsection
