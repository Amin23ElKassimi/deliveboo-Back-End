@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-12 p-2 mb-3 text-center">
                <h2>
                    These are all our available orderss, {{ Auth::user()->name }}!
                </h2>
            </div>
            <div class="col-12">
                <table class="table table-striped table-hover table-dark">
                    <thead>
                        <tr>
                            <th scope="col">client_id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Type</th>
                            <th scope="col">status</th>
                            <th scope="col">start_date</th>
                            <th scope="col">end_date</th>
                            <th scope="col">budget</th>
                            <th scope="col">priority</th>
                            <th scope="col">description</th>
                            <th scope="col">
                                <a href="{{ route('admin.orders.create',) }}">
                                    <button class="btn btn-secondary btn-lg">
                                        Add New Project
                                    </button>
                                </a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ( $orders as $project )
                            <tr>
                                <th scope="row">
                                    {{ $project->client_id }}
                                </th>
                                <td>
                                    <a href="{{ route('admin.orders.show', $project) }}">
                                        {{ $project->name }}
                                    </a>
                                </td>
                                <td>
                                    <span  style="color: {{ $project->type->color }}">
                                        ⬤
                                    </span>
                                    {{ $project->type->name }}
                                </td>
                                <td>
                                    {{ $project->status }}
                                </td>
                                <td>
                                    {{ $project->start_date }}
                                </td>
                                <td>
                                    {{ $project->end_date }}
                                </td>
                                <td>
                                    {{ $project->budget }}
                                </td>
                                <td>
                                    {{ $project->priority }}
                                </td>
                                <td>
                                    <em>
                                        {{ substr($project->description, 0, 35) }}
                                    </em>
                                    <td>
                                        <a href="{{ route('admin.orders.deleted.show', $project) }}" class="text-decoration-none">
                                            <button class="btn btn-sm btn-primary">
                                                View
                                            </button>
                                        </a>
                                        <form class="d-inline-block" action="{{ route('admin.orders.deleted.restore', $project) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
        
                                            <button class="btn btn-sm btn-warning" type="submit">
                                                Restore
                                            </button>
                                        </form>
                                        <form class="d-inline-block" action="{{ route('admin.orders.deleted.destroy', $project) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
        
                                            <button class="btn btn-sm btn-danger" type="submit">
                                                Delete
                                            </button>
                                        </form>
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