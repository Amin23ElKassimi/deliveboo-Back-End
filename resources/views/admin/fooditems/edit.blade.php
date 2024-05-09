@extends('admin.fooditems.layouts.create-or-edit')

@section('page-title', 'Modifica Piatto')

@section('form-action')
    {{ route('admin.fooditems.update',$foodItem->id) }}
@endsection

@section('form-method')
    @method('PUT')
@endsection