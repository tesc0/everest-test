@extends('layout')
@section('content')
<main class="">
    <a href="/robot">Új robot</a>
    <table class="table table-striped mt-3">
        <tr>
            <th>Azonosító</th>
            <th>Név</th>
            <th>Típus</th>
            <th>Erő</th>
            <th></th>
            <th>Harc...</th>
        </tr>
        @foreach ($robots as $robot) 
        <tr>
            <td>{{ $robot->id }}</td>
            <td>{{ $robot->name }}</td>
            <td>{{ $robot->type }}</td>
            <td>{{ $robot->power }}</td>
            <td>
                <a href="/robot/{{ $robot->id }}">Szerkesztés</a>
                <a href="/robot/{{ $robot->id }}/delete">Törlés</a>
            </td>
            <td><input type="checkbox" class="robot-select" data-robot="{{ $robot->id }}"></td>
        </tr>
        @endforeach
    </table>

    <div class="text-center">
        <input type="hidden" id="_token" value="{{ csrf_token() }}">
        <button id="start_fight" class="btn btn-primary" disabled>Harcba küldés</button>

        <div id="winner_details" class="mt-5"></div>
    </div>
   
</main>
<script src="{{ asset('js/app.js') }}"></script>
@stop