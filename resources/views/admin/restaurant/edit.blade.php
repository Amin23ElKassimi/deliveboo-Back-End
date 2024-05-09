@extends('admin.restaurant.layouts.create-or-edit')

@section('page-title', 'Modifica Ristorante')

@section('form-action')
    {{ route('admin.restaurants.update',$restaurant->id) }}
@endsection

@section('form-method')
    @method('PUT')
@endsection