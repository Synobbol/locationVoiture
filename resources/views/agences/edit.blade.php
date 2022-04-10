@extends("layouts.app")
@section("title", "Véville Agences Edit")
@section("content")

<table>
    <thead>
        <th>Agence</th>
        <th>titre</th>
        <th>adresse</th>
        <th>ville</th>
        <th>cp</th>
        <th>description</th>
        <th>photo</th>
        <th>actions</th>
    </thead>

    <tbody>
        <td>{{ $agences->id_agence }}</td>
        <td>{{ $agences->titre }}</td>
        <td>{{ $agences->adresse }}</td>
        <td>{{ $agences->ville }}</td>
        <td>{{ $agences->cp }}</td>
        <td>{{ $agences->description }}</td>
        <td><img src="{{asset('storage/'. $agences->photo)  }}" width="30%" alt="photo de l'agence"></td>
        <td><a href="{{route('agences.index')}}">Retourner à l'accueil</a></td>
    </tbody>
    <!-- Diesel,boite auto, 5 portes, GPS, AutoRadio, Forfait 1000 km (0,5/km supplémentaire) -->
</table>

<form action="{{ route('agences.update', $agences->id_agence) }}" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    @method("PUT")

    <br>
    <label for="title">Titre</label>
    <input type="text" name="title" value="{{ $agences->titre }}" placeholder="Titre de l'agence">
    <br>
    <label for="adress">Adresse</label>
    <input type="text" name="adress" value="{{ $agences->adresse }}" placeholder="Adresse">
    <br>
    <label for="city">Ville</label>
    <input type="text" name="city" value="{{ $agences->ville }}" placeholder="Ville">
    <br>
    <label for="cp">Code Postal</label>
    <input type="text" name="cp" value="{{ $agences->cp }}" placeholder="Code postal">
    <br>
    <label for="photo">Photo</label>
    <input type="file" name="photo">
    <br>
    <label for="description">Description</label>
    <textarea name="description" id="descript" cols="30" rows="10" placeholder="Description de votre agence">{{ $agences->description }}</textarea>
    <br>
    <button class="btn btn-primary" type="submit">Enregistrer</button>
</form>

@endsection

