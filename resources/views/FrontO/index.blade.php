@extends("layouts.app")
@section("title", "Véville Accueil")
@section("content")
<div class="container">
    <div class="banner">
        <h1>Bienvenue à bord</h1>
        <h2>Location de voiture 24h/24 et 7j/7</h2>
    </div>

    <form action="">
        <label for="">Adresse de départ</label>
        <select class="form-select" name="start" id="">
            <option value=""></option>
        </select>
        <br>
        <label for="">Début de location</label>
        <select class="form-select" name="" id="">
            <option value=""></option>
        </select>
        <br>
        <label for="">Fin de location</label>
        <input type="text">
        <button>Valider un vehicule</button>
    </form>

    <table>
        <thead>
            <th></th>
            <th></th>
        </thead>
        @foreach ($cars as $car)
        <tbody>
            <td><img src="{{asset('storage/'. $car->photo)  }}" width="30%" alt="photo du vehicule"></td>
            <td>
                {{ $car->titre }} <br> 
                {{ $car->description }} <br>
                {{ $car->prix_journalier }} - {{$car->agence_titre}} <br>
                <button class="btn btn-success" >Reserver et Payer</button>
            </td>
        </tbody>
        @endforeach
    </table>
</div>
@endsection