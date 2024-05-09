@extends('admin.fooditems.layouts.create-or-edit')

@section('page-title', 'Crea nuovo piatto')

@section('form-action')
    {{ route('admin.fooditems.store') }}
@endsection

@section('form-method')
    @method('POST')
@endsection

