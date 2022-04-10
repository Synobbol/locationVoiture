@extends("layouts.app")
@section("title", "Véville Agences")
@section("content")

<div class="container-fluid">

    <br>
    <table class="table">
        <thead class="table-dark">
            <th>Agence</th>
            <th>titre</th>
            <th>adresse</th>
            <th>ville</th>
            <th>cp</th>
            <th>description</th>
            <th>photo</th>
            <th>actions</th>
        </thead>

        @foreach ($agences as $agency)
            <tbody>
                <td>{{ $agency->id_agence }}</td>
                <td>{{ $agency->titre }}</td>
                <td>{{ $agency->adresse }}</td>
                <td>{{ $agency->ville }}</td>
                <td>{{ $agency->cp }}</td>
                <td>{{ $agency->description }}</td>
                <td><img src="{{asset('storage/'. $agency->photo) }}" width="30%" alt="photo de l'agence"></td>
                <td>
                    <form method="post" action="{{ route('agences.destroy', $agency->id_agence ) }}" >
                        @csrf
                        <input type="hidden" name="_method" value="DELETE">
                    
                        <input type="submit" value=" Supprimer" >
                    </form>
                    <a href="{{ route('agences.edit', $agency->id_agence) }}" >Modifier</a>
                </td>
            </tbody>
        @endforeach
    </table>
</div>

<div class="container-fluid">
    <form action="{{ route('agences.store') }}" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        
        <br>
        <label for="title">Titre</label>
        <input type="text" name="title" placeholder="Titre de l'agence">
        <br>
        <label for="adress">Adresse</label>
        <input type="text" name="adress" placeholder="Adresse">
        <br>
        <label for="city">Ville</label>
        <input type="text" name="city" placeholder="Ville">
        </div>
        <label for="cp">Code Postal</label>
        <input type="text" name="cp" placeholder="Code Postal">
        <br>
        <label for="description">Description</label>
        <textarea name="description" id="descript" cols="30" rows="10" placeholder="Description de votre agence"></textarea>
        <!-- Notre Agence de Paris 300 boulevard de vaugirard, 75015, Paris Ouvert 7j/7 de 09h à 13h et de 14h à 20h 01 49 75 21 33 contact@veville.com -->
        <br>
        <label for="photo">Photo</label>
        <input type="file" name="photo">
        <br>
        <button class="btn btn-primary" type="submit">Enregistrer</button>
    </form>
</div>
@endsection