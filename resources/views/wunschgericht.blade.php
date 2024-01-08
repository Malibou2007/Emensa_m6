@extends('layouts.app')
@vite('resources/css/auth.css')
@vite('resources/css/emensa.css')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Wunschgericht</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('wunschverify') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">Name des Gerichts</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="beschreibung" class="col-md-4 col-form-label text-md-end">Beschreibung</label>

                                <div class="col-md-6">
                                    <input id="beschreibung" type="text" class="form-control" name="beschreibung" required>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button id="submitGericht" type="submit" name="submitGericht" value="Wunsch abschicken">
                                        Wunsch abschicken
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
