@extends('layouts.admin')

@section('main-content')
    <section class="products">
        <div class="container">
            <div class="row">
                <div class="row mb-3 justify-content-center">
                    <div class="col-7 p-3">
                        <div class="card p-4 text-center" id="my_wrapper">
                            <h1>
                                {{ $foodItem->name }}
                            </h1>
                            <p class="fs-5">
                               <strong> Ingredienti: </strong> {{ $foodItem->ingredients }}
                            </p>
                            <p class="fs-5">
                                <strong> Prezzo: </strong>{{ $foodItem->price }} €
                            </p>
                            <div class="row g-0 d-flex justify-content-center">
                                <div class="col-md-4">
                                    @if (str_starts_with($foodItem->image_url, 'http'))
                                    <img class="img-fluid rounded-start" src="{{ $foodItem->image_url }}" alt="{{ $foodItem->name }} Image">
                                @else
                                <div class="col-12 d-flex mb-3">
                                    <img class="img-fluid rounded-start" alt="{{ $foodItem->name }} Image"
                                        src="{{ asset('storage') . '/' . $foodItem->image_url }}">
                                </div>
                                @endif
                            </div>
                            <div class="card-body">
                                <h2 class="fs-4">
                                    <strong>Descrizione: </strong>
                                </h2>
                                <p>
                                    {{ $foodItem->description }}
                                </p>
                            </div>
                            <div class="card-body">
                                <h2 class="fs-4">
                                    <strong>Disponibile: </strong>
                                </h2>
                                <p>
                                @if ($foodItem->available == 1)
                                    Si
                                @else
                                    No
                                @endif
                                </p>
                            </div>
                            <div class="col-12 justify-content-center d-flex">
                                <a class="btn btn-danger" type="submit" data-bs-toggle="modal" data-bs-target="#exampleModal-{{ $foodItem->id }}">Elimina</a>
                                {{-- Delete modal --}}
                                <div class="modal fade" id="exampleModal-{{ $foodItem->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Elimina</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                        Sicuro di voler eliminare?
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
                                        <form action="{{ route('admin.fooditems.destroy', $foodItem) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Elimina</button>
                                        </form>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                <div class="ms-3">
                                    <a href="{{ route('admin.fooditems.index', $foodItem) }}" class="btn btn-success">Elenco Piatti</a>
                                </div>
                                <div class="ms-3">
                                    <a href="{{ route('admin.fooditems.edit', $foodItem) }}" class="btn btn-warning">Modifica piatto</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

<style>
    body{
      background-image: url('https://bistro1843.com/wp-content/uploads/2020/02/new-hero-banner-2.jpg');
      background-repeat: no-repeat; /* Impedisce la ripetizione dello sfondo */
      background-size: cover; /* Ridimensiona l'immagine per coprire l'intera area */
      background-position: center; /* Centra l'immagine */
    }
    #my_wrapper {
    min-width: 300px;
    border: 5px solid rgb(206, 206, 206);
    background-color: rgb(228, 228, 228);
    border-radius: 10px;
    box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2); 
    /* transition: all 0.3s ease;  */
    }

    #my_wrapper:hover {
    /* transform: scale(1.05);  */
    box-shadow: 40px 40px 80px rgba(0, 0, 0, 0.3);   
    }
  </style>