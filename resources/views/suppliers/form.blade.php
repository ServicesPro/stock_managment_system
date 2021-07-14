@extends('layouts.master')

@push('css')
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
@endpush

@push('js')
    <script src="{{ asset('js/select2.full.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.cities').select2();
        });
    </script>
@endpush

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Fournisseurs</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                @isset($supplier)
                    Editer
                @else
                    Ajouter
                @endisset
                 un fournisseur
            </h6>
            
        </div>
        <form class="m-4" method="POST" action="{{ isset($supplier) ? route('suppliers.update', $supplier) : route('suppliers.store') }}">
            @csrf
            @isset($supplier)
                @method('PUT')
            @endisset

            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="name">Nom</label>
                    <input type="text" class="form-control @if ($errors->has('name')) is-invalid @endif" name="name" value="{{ isset($supplier) ? $supplier->name : old('name') }}" id="name" placeholder="Entrez le nom du fournisseur">
                    @if ($errors->has('name'))
                        <span class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </span>
                    @endif
                </div>
                <div class="col-md-6 form-group">
                    <label for="address">Adresse</label>
                    <input type="text" class="form-control @if ($errors->has('address')) is-invalid @endif" name="address" value="{{ isset($supplier) ? $supplier->address : old('address') }}" id="address" placeholder="Entrez l'adresse du fournisseur'">
                    @if ($errors->has('address'))
                        <span class="invalid-feedback">
                            {{ $errors->first('address') }}
                        </span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="phone">Téléphone</label>
                    <input type="phone" class="form-control @if ($errors->has('phone')) is-invalid @endif" name="phone" value="{{ isset($supplier) ? $supplier->phone : old('phone') }}" id="phone" placeholder="Entrez le numéro de téléphone du fournisseur">
                    @if ($errors->has('phone'))
                        <span class="invalid-feedback">
                            {{ $errors->first('phone') }}
                        </span>
                    @endif
                </div>
                <div class="col-md-6 form-group">
                    <label for="address">Email</label>
                    <input type="email" class="form-control @if ($errors->has('email')) is-invalid @endif" name="email" value="{{ isset($supplier) ? $supplier->email : old('email') }}" id="email" placeholder="Entrez l'email du fournisseur'">
                    @if ($errors->has('email'))
                        <span class="invalid-feedback">
                            {{ $errors->first('email') }}
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label for="city">Ville</label>
                <select class="cities form-control" name="city">
                    <option value="test">--- Choisir une ville ---</option>
                    @foreach ($cities as $item)
                        <option value="{{ $item->id }}" {{ ($supplier->city_id === $item->id) ? 'selected' : '' }}>{{ $item->name }}</option>
                    @endforeach
                </select>
                @if ($errors->has('city'))
                    <span class="invalid-feedback">
                        {{ $errors->first('city') }}
                    </span>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save mr-1"></i> Sauver
            </button>
        </form>
    </div>
@endsection
