@extends('layout')
@section('content')
<main class="container">
    <h2 class="text-center">Robot adatai</h2>

    <form method="post" action="/robot" class="">
        <div class="mb-3">
            <label class="">Név: </label>
            <input type="text" name="robot[name]" value="{{ isset($robot->name) ? $robot->name : '' }}" class="form-control">            
        </div>
        <div class="mb-3">
            <label class="">Erő: </label>
            <input type="number" name="robot[power]" value="{{ isset($robot->power) ? $robot->power : '' }}" min="1" class="form-control">            
        </div>
        <div class="mb-3">
            <label class="">Típus: </label>
            <select name="robot[type]" class="form-control" required>
                @isset ($id)
                    <option value="brawler" {{ 'brawler' == $robot->type ? "selected" : "" }}>Brawler</option>
                    <option value="rogue" {{ 'rogue' == $robot->type ? "selected" : "" }}>Rogue</option>
                    <option value="assault" {{ 'assault' == $robot->type ? "selected" : "" }}>Assault</option>
                @else
                    <option value="" disabled selected>Válassz..</option>
                    <option value="brawler">Brawler</option>
                    <option value="rouge">Rouge</option>
                    <option value="assault">Assault</option>
                @endisset
            </select>
        </div>
        <div class="text-center">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            @isset ($id)
                <input type="hidden" name="robotId" value="{{ $id }} ">
            @endisset
            <button class="btn btn-success">Mentés</button>
        </div>
    </form>   
</main>
@stop