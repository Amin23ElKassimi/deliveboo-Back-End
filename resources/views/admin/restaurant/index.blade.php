@extends('layouts.admin')
@section('main-content')
<section class="container d-flex justify-content-center align-items-center pt-5">
  <div id="restaurant-index" class="container">
    <div class="row">
      @if ($restaurants->isEmpty())
        <div class="col-12 text-center">
            <a href="{{ route('admin.restaurants.create') }}" class="btn btn-primary">Inserisci Ristorante</a>
        </div>
      @else
        {{-- inizio card --}}
        @foreach ($restaurants as $restaurant)
        <div class="col-12">
        <div class="card mb-3">
          <div class="row g-0">
            <div class="col-md-4">
              @if (str_starts_with($restaurant->image_url, 'http'))
              <div class="col-12 d-flex mb-3">
                  <img class="object-fit-cover w-100 " src="{{ $restaurant->image_url }}">
              </div>
              @else
              <div class="col-12 d-flex mb-3">
                  <img class="object-fit-cover w-100 "
                      src="{{ asset('storage') . '/' . $restaurant->image_url }}">
              </div>
              @endif
          </div>
            <div class="col-md-8">
              <div class="card-body d-flex justify-content-between">
                <div>
                  <h5 class="card-title">Ristorante "{{ $restaurant->name }}" di {{ $restaurant->user->name }} {{ $restaurant->user->last_name }} </h5>
                  <p class="card-text">Recapito ristorante: {{ $restaurant->email }}, {{ $restaurant->phone_number }}</p>
                  <p class="card-text">Indirizzo: {{ $restaurant->address }}</p>
                  <p class="card-text">Partita Iva: {{ $restaurant->vat }}</p>
                  <p class="card-text">Recapito titolare: {{ $restaurant->user->email }}</p>
                  <p class="mt-2">Categorie:</p>
                  @foreach ($restaurant->categories as $category)
                  <span class="badge">{{ $category->name }}</span>
                  @endforeach
                </div>
                {{-- Button Modified Restaurant --}}
                <div>
                  <a href="{{ route('admin.restaurants.edit', $restaurant->id) }}" class="btn btn-primary mb-3">Modifica</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
      {{-- Section Menu and Order --}}
      <article class="col-12">
        <div class="row">
          <div class="col-sm-6 mb-3 mb-sm-0">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Menù</h5>
                <p class="card-text">Aggiungi e aggiorna le tue pietanze</p>
                <div class="col-12 d-flex">
                    <a href="{{ route('admin.fooditems.create', $restaurant) }}" class="btn btn-primary me-1">Aggiungi piatto</a>
                    <a href="{{ route('admin.fooditems.index', $restaurant) }}" class="btn btn-warning">I miei Piatti</a>
                </div>
              </div>
            </div>
          </div>
          {{-- Section Order --}}
          <div class="col-sm-6">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Ordini</h5>
                <p class="card-text">Tieni sott'occhio le ordinazioni nel tuo ristorante</p>
                  <a href="{{ route('admin.orders.index', $restaurant) }}" class="btn btn-warning">I miei ordini</a>
              </div>
            </div>
          </div>
        </div>
      </article>
        @endif
        {{-- Link utility --}}
        <div class="text-center pt-5">
          <a class="bg-white p-2 rounded-4" href="http://localhost:5174/restaurants">Vai a DeliveBoo Guest</a>
        </div>
    </div>
  </div>
</section>
@endsection

<style>
  body{
    background-image: url('https://cms.finnair.com/resource/blob/1329464/d417ef1c0553da0dfb8c65eb213d13f9/long-main-data.jpg?impolicy=crop&width=4000&height=2250&x=0&y=334')
  }
</style>