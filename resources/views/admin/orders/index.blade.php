@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('main-content') 
    <div class="container">
        <div class="row">
            <div class="col-12 p-2 mb-3 text-center">
                <h2>
                    Ciao {{ Auth::user()->name}}! Questa e' lista degli ordini del tuo ristorante
                </h2>
            </div>
            <div class="col-12">
                <table class="table table-striped table-hover table-dark">
                    <thead>
                        <tr>
                            <th scope="col">Order ID</th>
                            <th scope="col">Cliente</th>
                            <th scope="col">Indirizzo Clienet</th>
                            <th scope="col">Stato di pagamento</th>
                            <th scope="col">Totale</th>
                            <th scope="col">Email</th>
                            <th scope="col">Telefono</th>
                            <th scope="col">Ordinato il:</th>
                            <th scope="col"></th>
                            <th scope="col">
                                <a href="{{ route('admin.orders.create',) }}">
                                    <button class="btn btn-secondary btn-lg">
                                        Add New order
                                    </button>
                                </a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ( $orders as $order )
                            <tr>
                                <th scope="row">
                                    {{ $order->id }}
                                </th>
                                <td>
                                    {{ $order->customer }} 
                                </td>
                                <td>
                                    {{ $order->user_address }}
                                </td>
                                <td>
                                    {{ $order->status }}
                                </td>
                                <td>
                                    {{ $order->total }}
                                </td>
                                <td>
                                    {{ $order->user_mail }}
                                </td>
                                <td>
                                    {{ $order->user_phone_number }}
                                </td>
                                <td>
                                    {{ date_format($order->created_at, "H:i:s d/m/y") }}
                                </td>
                                <td>
                                    <em>
                                        {{ substr($order->description, 0, 35) }}
                                    </em>
                                </td>
                                {{-- Bottoni: View - Edit - Delete --}}
                                <td>
                                    <a href="{{ route('admin.orders.show', $order) }}">
                                        <button class="btn btn-sm btn-primary">
                                            View
                                        </button>
                                    </a>
                                    <a href="{{ route('admin.orders.edit', $order) }}">
                                        <button class="btn btn-sm btn-success">
                                            Edit
                                        </button>
                                    </a>
                                        {{-- Modal --}}
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal-{{ $order->id }}">
                                        Delete
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal-{{ $order->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h1 class="modal-title fs-5 text-danger" id="exampleModalLabel">Deleting order...</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div> 
                                            <div class="modal-body text-black">
                                                Do you really want to delete {{ $order->name }}?
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
                                </td>
                                </td>
                            </tr>
                            {{-- Se non trovi niente Scrivi --}}
                        @empty
                            <tr>
                                <td colspan="4">
                                    There are no orders available
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
<style>

</style>