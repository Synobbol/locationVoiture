@extends("layouts.app")
@section("title", "Véville Commandes")
@section("content")

<form action="{{route('commandes.index')}}" method="get">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">

    <select name="agences" id="agence">
        <option value="1">Agence de Paris</option>
        <option value="2">Agence de Lyon</option>
        <option value="3">Agence de Marseille</option>
        <option value="4">Agence de Bordeaux</option>
        <option value="5">Agence de Toulouse</option>
    </select>
    <button type="submit">Selectionner</button>
</form>

<table>
    <thead>
        <th>Commande</th>
        <th>Membre</th>
        <th>Vehicule</th>
        <th>Agence</th>
        <th>Date et heure de départ</th>
        <th>Date et heure de fin</th>
        <th>Prix total</th>
        <th>Date et heure d'enregistrement</th>
        <th>actions</th>
    </thead>
    @foreach ($commandes as $commande)
    <tbody>
        <td>{{ $commande->id_commande }}</td>
        <td>
        {{$commande->membreID}}-{{$commande->membre_nom}} - {{$commande->membre_prenom}} - <br>
            {{$commande->membre_email}}
        </td>
        <td>{{$commande->vehiculeID}} - {{$commande->vehicule_titre}}</td>
        <td>{{$commande->agenceID}} - {{$commande->agence_titre}}</td>
        <td>{{ $commande->date_heure_depart }}</td>
        <td>{{ $commande->date_heure_fin }}</td>
        <td>{{ $commande->prix_total }}</td>
        <td>{{ $commande->date_enregistrement }}</td>
        <td>
            <form method="post" action="{{ route('commandes.destroy', $commande->id_commande ) }}" >
                    @csrf
                    @method("DELETE")
                    <input type="submit" value=" Supprimer" >
            </form>
            <a href="{{ route('commandes.edit', $commande->id_commande) }}" >Modifier</a>
            <br>
            <a href="{{ route('commandes.index') }}" >Retour Accueil</a>
        </td>
    </tbody>
    @endforeach
</table>

@endsection