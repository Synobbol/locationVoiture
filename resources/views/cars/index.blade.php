@extends("layouts.app")
@section("title", "Véville Cars")
@section("content")

<div class="container-fluid">
    <table class="table">
        <thead class="table-dark ">
            <th>vehicule</th>
            <th>Agence</th>
            <th>titre</th>
            <th>marque</th>
            <th>modele</th>
            <th>description</th>
            <th>photo</th>
            <th>prix</th>
            <th>actions</th>
        </thead>
        @foreach ($vehicule as $car)
        <tbody>
            <td class="col">{{ $car->id_vehicule }}</td>
            <td class="col-1">{{ $car->agence_titre }}</td>
            <td class="col-1">{{ $car->titre }}</td>
            <td class="col-1">{{ $car->marque }}</td>
            <td class="col-1">{{ $car->modele }}</td>
            <td class="col-3">{{ $car->description }}</td>
            <td class="col-6"><img src="{{asset('storage/'. $car->photo)  }}" width="40%" alt="photo du vehicule"></td>
            <td class="col-1">{{$car->prix_journalier}}</td>
            <td class="col">
                <form method="post" action="{{ route('cars.destroy', $car->id_vehicule ) }}" >
                    @csrf
                    @method("DELETE")
                    <input type="submit" value=" Supprimer" >
                </form>
                <a href="{{ route('cars.edit', $car->id_vehicule) }}" >Modifier</a>
            </td>
        </tbody>
        @endforeach
        <!-- Diesel,boite auto, 5 portes, GPS, AutoRadio, Forfait 1000 km (0,5/km supplémentaire) -->
    </table>
</div>

<div class="container-fluid">
    <form action="{{ route('cars.store') }}" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <select  name="agences" id="agence">
            <option value="1">Agence de Paris</option>
            <option value="2">Agence de Lyon</option>
            <option value="3">Agence de Marseille</option>
            <option value="4">Agence de Bordeaux</option>
            <option value="5">Agence de Toulouse</option>
        </select>
        <br>
        <div class="col">
            <div class="row">
                <label class="form-label" for="title">Titre</label>
                <input class="col-4" type="text" name="title" placeholder="Titre du vehicule">
            </div>
            <div class="row">
                <label class="form-label" for="brand">Marque</label>
                <input  class="col-4" type="text" name="brand" placeholder="Marque">
            </div>
            <div class="row">
                <label class="form-label" for="model">Modele</label>
                <input class=" col-4" type="text" name="model" placeholder="Modele">
            </div>
            <div class="row">
                <label class="form-label" for="price">Prix</label>
                <input class="col-4" type="text" name="price" placeholder="Prix journalier">
            </div>
        </div>
        <div class="col">
            <br>
            <label class="form-label" for="photo">Photo</label>
            <input type="file" name="photo">
            <br>
            <label class="form-label" for="description">Description</label>
            <textarea name="description" id="descript" cols="30" rows="10" placeholder="Description de votre vehicule"></textarea>
            <br>
        </div>
        <button class="btn btn-primary col-4" type="submit">Enregistrer</button>
    </form>
</div>
@endsection