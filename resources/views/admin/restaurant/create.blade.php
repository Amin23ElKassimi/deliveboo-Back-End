@extends('admin.restaurant.layouts.create-or-edit')

@section('page-title', 'Crea Ristorante')

@section('form-action')
    {{ route('admin.restaurants.store',$restaurant->id) }}
@endsection

@section('form-method')
    @method('POST')
@endsection