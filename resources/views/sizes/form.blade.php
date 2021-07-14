@extends('layouts.master')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Tailles</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                @isset($size)
                    Editer
                @else
                    Ajouter
                @endisset
                 une taille
            </h6>
            
        </div>
        <form class="m-4" method="POST" action="{{ isset($size) ? route('sizes.update', $size) : route('sizes.store') }}">
            @csrf
            @isset($size)
                @method('PUT')
            @endisset

            <div class="form-group">
                <label for="name">Nom</label>
                <input type="text" class="form-control @if ($errors->has('name')) is-invalid @endif" name="name" value="{{ isset($size) ? $size->name : old('name') }}" id="name" placeholder="Entrez le nom de la taille">
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
