@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('DevileBoo - Admin') }}</div>

                <div class="card-body text-center">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="d-flex justify-content-between">
                        <form action="{{ route('admin.restaurants.index')}}" method="GET">
                            @csrf
                            <button class="btn btn-success">Il tuo ristorante</button>
                        </form>
                        <button class="btn btn-success">Ordini ricevuti</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
