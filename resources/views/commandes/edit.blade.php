@extends("layouts.app")
@section("title", "Véville Commandes Edit")
@section("content")

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
    
    <tbody>
        @foreach ($commandes as $commande)
        <td>{{ $commande->id_commande }}</td>
        <td>
        {{$commande->membreID}}-{{$commande->membre_nom}} - {{$commande->membre_prenom}} - <br>
            {{$commande->membre_email}}
        </td>
        <td>{{ $commande->vehiculeID }} - {{$commande->vehicule_titre}}</td>
        <td>{{ $commande->agenceID }} - {{$commande->agence_titre}}</td>
        <td>{{ $commande->date_heure_depart }}</td>
        <td>{{ $commande->date_heure_fin }}</td>
        <td>{{ $commande->prix_total }}</td>
        <td>{{ $commande->date_enregistrement }}</td>
        <td>
            <a href="{{ route('commandes.index') }}" >Retour Accueil</a>
        </td>
        @endforeach
    </tbody>

</table>

<form action="{{ route('commandes.update', $commandes->id_commande) }}" method="POST">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    @method('PUT')

    <br>
    <label for="pseudo">Membre</label>
    <input type="text" name="pseudo" value="" placeholder="pseudo">

    <br>
    <label for="mdp">Mot de passe</label>
    <input type="text" name="mdp" value="" placeholder="mot de passe">

    <br>
    <label for="nom">Nom</label>
    <input type="text" name="nom" value="" placeholder="votre nom">

    <br>
    <label for="prenom">Prénom</label>
    <input type="text" name="prenom" value="" placeholder="votre prénom">

    <br>
    <label for="email">Email</label>
    <input type="text" name="email" value="" placeholder="Email">

    <br>
    <label for="civil">Civilité</label>
    <select name="civil" id="civilite">
        <option value="m"> Homme</option>
        <option value="f">Femme</option>
    </select>

    <br>
    <label for="statut">Statut</label>
    <select name="statut" id="statut">
        <option value="Admin"> Admin</option>
        <option value="User">User</option>
    </select>

    <br>
    <button class="btn btn-primary" type="submit">Enregistrer</button>
</form>

@endsection