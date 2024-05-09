@extends('layouts.admin')

@section('page-title', 'Admin Dashboard')

@section('main-content')
    <section class="products">
        <div class="container">
            <div class="row">
                <div class="row mb-3 justify-content-center">
                    <div class="col-7 p-3">
                        <div class="card p-4 text-center">
                            <h1>
                            Cliente: {{ $order->customer }}
                            </h1>
                            <p class="text-capitalize">
                                Indirizzo: {{ $order->user_address }}
                            </p>
                            <p>
                                Ordinato il: {{ date_format($order->created_at, "H:i:s d/m/y") }}
                            </p>
                            <p class="text-capitalize">
                                Stato: {{ $order->status}}
                            </p>
                            {{-- Lista Ordine --}}
                            <ul class="list-group">
                                @foreach ($order->foodItems as $foodItem)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        {{ $foodItem->name }} - {{ $foodItem->price }}
                                        <span class="badge text-bg-primary rounded-pill">1</span>
                                    </li>
                                @endforeach
                            </ul>
                            <p class="text-capitalize">
                                Totale: {{ $order->total }} &euro;
                            </p>
                            <p>
                                Email Cliente: {{ $order->user_mail }}
                            </p>
                            <p>
                                Numero di Telefono: {{ $order->user_phone_number }} 
                            </p>
                            <div class="actions mb-3 pt-3">
                                <a href="{{ route('admin.orders.edit', $order->id) }}">
                                    <button class="btn btn-primary">
                                        Modifica Ordine
                                    </button>
                                </a>
                            </div>
                                {{-- Modal --}}
                            <!-- Button trigger modal -->
                            <div class="actions mb-3 pt-3">
                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal-{{ $order->id }}">
                                    Elimina Ordine
                                </button>
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal-{{ $order->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h1 class="modal-title fs-5 text-danger" id="exampleModalLabel">Deleting order...</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div> 
                                    <div class="modal-body text-black">
                                        Vuoi eliminare l'ordine di {{ $order->customer }}?
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                    <form class="d-inline-block" action="{{ route('admin.orders.destroy', $order) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit">
                                            Delete
                                        </button>
                                    </form>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection