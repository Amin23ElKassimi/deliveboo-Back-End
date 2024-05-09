@extends('layouts.admin')

@section('head-title')
    @yield('page-title')
@endsection

@section('main-content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-7">
                @include('partials.errors')

                <form action="@yield('form-action')" method="POST">
                    @csrf
                    @yield('form-method')
                        {{-- Name Cliente: --}}
                        <div class="mb-3 input-group">
                            <label for="customer" class="input-group-text">Nome Cliente:</label>
                            <input class="form-control" type="text" name="customer" id="customer" value="{{ old('customer', $order->customer) }}">
                        </div>
                        {{-- Indirizzo: --}}
                        <div class="mb-3 input-group">  
                            <label for="user_address" class="input-group-text">Indirizzo Cliente:</label>
                            <input class="form-control" type="text" name="user_address" id="user_address" value="{{ old('user_address', $order->user_address) }}">
                        </div>
                        {{-- status: --}}
                        <div class="mb-3 input-group">
                            <label for="status" class="input-group-text">Stato Consegna:</label>
                            <input class="form-control" type="text" name="status" id="status" value="{{ old('status', $order->status) }}">
                        </div>
                        {{-- Totale Euro --}}
                        <div class="mb-3 input-group">
                            <label for="total" class="input-group-text">Totale da pagare:</label>
                            <input class="form-control" type="number" name="total" id="total" value="{{ old('total', $order->total) }}">
                        </div>
                        {{-- Email Cliente--}}
                        <div class="mb-3 input-group">
                            <label for="user_mail" class="input-group-text">Email Cliente:</label>
                            <input class="form-control" type="text" name="user_mail" id="user_mail" value="{{ old('user_mail',$order->user_mail) }}">
                        </div>
                        {{-- Numero di telefono --}}
                        <div class="mb-3 input-group">
                            <label for="user_phone_number" class="input-group-text">Tell Cliente:</label>
                            <input class="form-control" type="phone" name="user_phone_number" id="user_phone_number" value="{{ old('user_phone_number',$order->user_phone_number) }}">
                        </div>

                        {{-- Buttons --}}
                        <div class="mb-3 input-group">
                            <button type="submit" class="btn btn-xl btn-primary">
                                @yield('page-title')
                            </button>
                            <button type="reset" class="btn btn-xl btn-warning">
                                Reset all fields
                            </button>
                        </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Script for preview image url --}}
    <script>
        document.getElementById('view').addEventListener('change', function(event){
            const imageElement = document.getElementById('image-preview');
            imageElement.setAttribute('src' , this.value);
            imageElement.classList.remove('d-none');
        });
    </script>
@endsection