@extends("layouts.app")
@section("title", "Véville Membres")
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
    @foreach ($membres as $membre)
    <tbody>
        <td>{{ $membre->id_membre }}</td>
        <td>{{ $membre->pseudo }}</td>
        <td>{{ $membre->nom }}</td>
        <td>{{ $membre->prenom }}</td>
        <td>{{ $membre->email }}</td>
        <td>{{ $membre->civilite }}</td>
        <td>{{ $membre->statut }}</td>
        <td>{{ $membre->date_enregistrement }}</td>
        <td>
            <form method="post" action="{{ route('membres.destroy', $membre->id_membre ) }}" >
                    @csrf
                    @method("DELETE")
                    <input type="submit" value=" Supprimer" >
            </form>
            <a href="{{ route('membres.edit', $membre->id_membre) }}" ></a>
        </td>
    </tbody>
    @endforeach
</table>

<form class="mb-3" action="{{ route('membres.store') }}" method="POST">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
   
    <br>
    <label class="form-label" for="pseudo">Pseudo</label>
    <input type="text" name="pseudo" placeholder="pseudo">
    <br>
    <label class="form-label" for="mdp">Mot de passe</label>
    <input type="text" name="mdp" placeholder="mot de passe">
    <br>
    <label class="form-label" for="nom">Nom</label>
    <input type="text" name="nom" placeholder="votre nom">
    <br>
    <label class="form-label" for="prenom">Prénom</label>
    <input type="text" name="prenom" placeholder="votre prénom">
    <br>
    <label class="form-label" for="email">Email</label>
    <input type="text" name="email" placeholder="Email">
    <br>
    <label class="form-label" for="civil">Civilité</label>
    <select name="civil" id="civilite">
        <option value="masculin"> Homme</option>
        <option value="feminin">Femme</option>
    </select>
    <br>
    <label class="form-label" for="statut">Statut</label>
    <select name="statut" id="statut">
        <option value="Admin"> Admin</option>
        <option value="User">User</option>
    </select>
    <br>
    <button class="btn btn-primary" type="submit">Enregistrer</button>
</form>

@endsection