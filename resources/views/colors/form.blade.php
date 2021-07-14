@extends('layouts.master')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Couleurs</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                @isset($color)
                    Editer
                @else
                    Ajouter
                @endisset
                 une couleur
            </h6>
            
        </div>
        <form class="m-4" method="POST" action="{{ isset($color) ? route('colors.update', $color) : route('colors.store') }}">
            @csrf
            @isset($color)
                @method('PUT')
            @endisset

            <div class="form-group">
                <label for="name">Nom</label>
                <input type="text" class="form-control @if ($errors->has('name')) is-invalid @endif" name="name" value="{{ isset($color) ? $color->name : old('name') }}" id="name" placeholder="Entrez le nom de la couleur">
                @if ($errors->has('name'))
                    <span class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </span>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save mr-1"></i> Sauver
            </button>
        </form>
    </div>
@endsection
