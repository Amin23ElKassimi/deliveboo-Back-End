@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('main-content')
<section class="products">
    <div class="container">
        <div class="row">
            <div class="row mb-3 justify-content-center">
                <div class="col-7 p-3">
                    <div class="card p-4 text-center">
                        <h1>
                            {{ $project->name }}
                        </h1>
                        <ul>
                            @forelse ($project->technologies as $technology)
                                <li class="d-inline me-3">
                                    <span class="badge px-2 px-1" style="background-color: {{ $technology->color }} ">
                                        {{ $technology->name }}
                                    </span>
                                </li>
            
                            @empty
                                <li class="d-inline me-3">
                                    This post has no tags yet...
                                </li>
                            @endforelse
                        </ul>
                        <p class="text-capitalize">
                            Status: {{ $project->status }}
                        </p>
                        <p class="text-capitalize">
                            Type: {{ $project->type->name }}
                        </p>
                        <p class="text-capitalize">
                            Priority: {{ $project->priority }}
                        </p>
                        <p>
                            start_date: {{ $project->start_date }}
                        </p>
                        <p>
                            end_date: {{ $project->end_date }}
                        </p>
                        <p>
                            Budget: {{ $project->budget }} &euro;
                        </p>
                        <div class="card-image">
                            <img class="w-50" src="{{  $project->view }}" alt="{{ $project->name }} ">
                        </div>
                        <div class="card-body">
                            <h2>
                                Descrizione
                            </h2>
                            <p>
                                {{ $project->description }}
                            </p>
                        </div>
                        <form class="d-inline-block" action="{{ route('admin.projects.deleted.restore', $project) }}" method="POST">
                            @csrf
                            @method('PATCH')

                            <button class="btn btn-sm btn-warning" type="submit">
                                Restore
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection