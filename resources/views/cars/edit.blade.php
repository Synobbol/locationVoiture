@extends("layouts.app")
@section("title", "Véville Cars Edit")
@section("content")

<table>
    <thead>
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

    <tbody>
        <td>{{ $vehicule->id_vehicule }}</td>
        <td>{{ $agence }}</td>
        <td>{{ $vehicule->titre }}</td>
        <td>{{ $vehicule->marque }}</td>
        <td>{{ $vehicule->modele }}</td>
        <td>{{ $vehicule->description }}</td>
        <td><img src="{{asset('storage/'. $vehicule->photo)  }}" width="30%" alt="photo du vehicule"></td>
        <td>{{$vehicule ->prix_journalier}}</td>
        <td><a href="{{route('cars.index')}}">Retourner à l'accueil</a></td>
    </tbody>
    <!-- Diesel,boite auto, 5 portes, GPS, AutoRadio, Forfait 1000 km (0,5/km supplémentaire) -->
</table>

<form action="{{ route('cars.update', $vehicule->id_vehicule) }}" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    @method("PUT")
    <br>
    <select name="agences" id="agence">
        <option value="1">Agence de Paris</option>
        <option value="2">Agence de Lyon</option>
        <option value="3">Agence de Marseille</option>
        <option value="4">Agence de Bordeaux</option>
        <option value="5">Agence de Toulouse</option>
    </select>
    <br>

    <br>
    <label class="form-label" for="title">Titre</label>
    <input type="text" name="title" value="{{ $vehicule->titre }}" placeholder="Titre du vehicule">
    <br>
    <label class="form-label" for="brand">Marque</label>
    <input  class="form-label" type="text" name="brand" value="{{ $vehicule->marque }}" placeholder="Marque">
    <br>
    <label class="form-label" for="model">Modele</label>
    <input type="text" name="model" value="{{ $vehicule->modele }}" placeholder="Modele">
    <br>
    <label class="form-label" for="price">Prix</label>
    <input type="text" name="price" value="{{ $vehicule->prix_journalier }}" placeholder="Prix journalier">
    <br>
    <label class="form-label" for="photo">Photo</label>
    <input type="file" name="photo">
    <br>
    <label class="form-label" for="description">Description</label>
    <textarea name="description" id="descript" cols="30" rows="10" placeholder="Description de votre vehicule">{{ $vehicule->description }}</textarea>
    <br>
    <button class="btn btn-primary" type="submit">Enregistrer</button>
</form>

@endsection

