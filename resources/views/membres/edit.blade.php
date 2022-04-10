@extends("layouts.app")
@section("title", "Véville Membres Edit")
@section("content")

<table>
    <thead>
        <th>id membre</th>
        <th>pseudo</th>
        <th>nom</th>
        <th>prenom</th>
        <th>email</th>
        <th>civilité</th>
        <th>statut</th>
        <th>date_enregistrement</th>
        <th>actions</th>
    </thead>

    <tbody>
        <td>{{ $membres->id_membre }}</td>
        <td>{{ $membres->pseudo }}</td>
        <td>{{ $membres->nom }}</td>
        <td>{{ $membres->prenom }}</td>
        <td>{{ $membres->email }}</td>
        <td>{{ $membres->civilite }}</td>
        <td>{{ $membres->statut }}</td>
        <td>{{ $membres->date_enregistrement }}</td>
        <td>
            <a href="{{ route('membres.index') }}" >Retour Accueil</a>
        </td>
    </tbody>

</table>

<form action="{{ route('membres.update', $membres->id_membre) }}" method="POST">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    @method('PUT')

    <br>
    <label for="pseudo">Pseudo</label>
    <input type="text" name="pseudo" value="{{$membres->pseudo}}" placeholder="pseudo">

    <br>
    <label for="mdp">Mot de passe</label>
    <input type="text" name="mdp" value="{{$membres->mdp}}" placeholder="mot de passe">

    <br>
    <label for="nom">Nom</label>
    <input type="text" name="nom" value="{{$membres->nom}}" placeholder="votre nom">

    <br>
    <label for="prenom">Prénom</label>
    <input type="text" name="prenom" value="{{$membres->prenom}}" placeholder="votre prénom">

    <br>
    <label for="email">Email</label>
    <input type="text" name="email" value="{{$membres->email}}" placeholder="Email">

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