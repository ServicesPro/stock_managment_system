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
    <h1 class="h3 mb-4 text-gray-800">Articles</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                @isset($product)
                    Editer
                @else
                    Ajouter
                @endisset
                 un article
            </h6>
            
        </div>
        <form class="m-4" enctype="multipart/form-data" method="POST" action="{{ isset($product) ? route('products.update', $product) : route('products.store') }}">
            @csrf
            @isset($product)
                @method('PUT')
            @endisset

            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control @if ($errors->has('image')) is-invalid @endif" name="image" value="{{ isset($product) ? $product->image : old('image') }}" id="image" placeholder="Entrez la quantité seuil de l'article">
                @if ($errors->has('image'))
                    <span class="invalid-feedback">
                        {{ $errors->first('image') }}
                    </span>
                @endif
            </div>

            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="family">Familles</label>
                    <select class="families form-control" name="family">
                        <option value="test">--- Choisir une famille ---</option>
                        @foreach ($families as $item)
                            <option value="{{ $item->id }}" {{ ($product->family_id === $item->id) ? 'selected' : '' }}>{{ $item->name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('family'))
                        <span class="invalid-feedback">
                            {{ $errors->first('family') }}
                        </span>
                    @endif
                </div>
                <div class="col-md-6 form-group">
                    <label for="category">Catégories</label>
                    <select class="categories form-control" name="category">
                        <option value="test">--- Choisir une catégorie ---</option>
                        @foreach ($categories as $item)
                            <option value="{{ $item->id }}" {{ ($product->category_id === $item->id) ? 'selected' : '' }}>{{ $item->name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('category'))
                        <span class="invalid-feedback">
                            {{ $errors->first('category') }}
                        </span>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="size">Fournisseurs</label>
                    <select class="sizes form-control" name="size">
                        <option value="test">--- Choisir un fournisseur ---</option>
                        @foreach ($sizes as $item)
                            <option value="{{ $item->id }}" {{ ($product->size_id === $item->id) ? 'selected' : '' }}>{{ $item->name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('size'))
                        <span class="invalid-feedback">
                            {{ $errors->first('size') }}
                        </span>
                    @endif
                </div>
                <div class="col-md-6 form-group">
                    <label for="color">Couleurs</label>
                    <select class="colors form-control" name="color">
                        <option value="test">--- Choisir une couleur ---</option>
                        @foreach ($colors as $item)
                            <option value="{{ $item->id }}" {{ ($product->color_id === $item->id) ? 'selected' : '' }}>{{ $item->name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('color'))
                        <span class="invalid-feedback">
                            {{ $errors->first('color') }}
                        </span>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="sku">Code</label>
                    <input type="text" class="form-control @if ($errors->has('sku')) is-invalid @endif" name="sku" value="{{ isset($product) ? $product->sku : old('sku') }}" id="sku" placeholder="Entrez le code de l'article">
                    @if ($errors->has('sku'))
                        <span class="invalid-feedback">
                            {{ $errors->first('sku') }}
                        </span>
                    @endif
                </div>
                <div class="col-md-6 form-group">
                    <label for="name">Nom</label>
                    <input type="text" class="form-control @if ($errors->has('name')) is-invalid @endif" name="name" value="{{ isset($product) ? $product->name : old('name') }}" id="name" placeholder="Entrez le nom de l'article">
                    @if ($errors->has('name'))
                        <span class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </span>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="quantity">Quantité</label>
                    <input type="number" class="form-control @if ($errors->has('quantity')) is-invalid @endif" name="quantity" value="{{ isset($product) ? $product->quantity : old('quantity') }}" id="quantity" placeholder="Entrez la quantité de l'article">
                    @if ($errors->has('quantity'))
                        <span class="invalid-feedback">
                            {{ $errors->first('quantity') }}
                        </span>
                    @endif
                </div>
                <div class="col-md-6 form-group">
                    <label for="threshold_quantity">Quantité Seuil</label>
                    <input type="number" class="form-control @if ($errors->has('threshold_quantity')) is-invalid @endif" name="threshold_quantity" value="{{ isset($product) ? $product->threshold_quantity : old('threshold_quantity') }}" id="threshold_quantity" placeholder="Entrez la quantité seuil de l'article">
                    @if ($errors->has('threshold_quantity'))
                        <span class="invalid-feedback">
                            {{ $errors->first('threshold_quantity') }}
                        </span>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="cost_price">Prix d'achats</label>
                    <input type="number" class="form-control @if ($errors->has('cost_price')) is-invalid @endif" name="cost_price" value="{{ isset($product) ? $product->cost_price : old('cost_price') }}" id="cost_price" placeholder="Entrez la quantité de l'article">
                    @if ($errors->has('cost_price'))
                        <span class="invalid-feedback">
                            {{ $errors->first('cost_price') }}
                        </span>
                    @endif
                </div>
                <div class="col-md-6 form-group">
                    <label for="retail_price">Prix de vente</label>
                    <input type="number" class="form-control @if ($errors->has('retail_price')) is-invalid @endif" name="retail_price" value="{{ isset($product) ? $product->retail_price : old('retail_price') }}" id="retail_price" placeholder="Entrez la quantité seuil de l'article">
                    @if ($errors->has('retail_price'))
                        <span class="invalid-feedback">
                            {{ $errors->first('retail_price') }}
                        </span>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 form-group">
                    <label for="weight">Poids</label>
                    <input type="number" class="form-control @if ($errors->has('weight')) is-invalid @endif" name="weight" value="{{ isset($product) ? $product->weight : old('weight') }}" id="weight" placeholder="Entrez la quantité de l'article">
                    @if ($errors->has('weight'))
                        <span class="invalid-feedback">
                            {{ $errors->first('weight') }}
                        </span>
                    @endif
                </div>
                <div class="col-md-4 form-group">
                    <label for="retail_price">Prix de vente</label>
                    <input type="number" class="form-control @if ($errors->has('retail_price')) is-invalid @endif" name="retail_price" value="{{ isset($product) ? $product->retail_price : old('retail_price') }}" id="retail_price" placeholder="Entrez la quantité seuil de l'article">
                    @if ($errors->has('retail_price'))
                        <span class="invalid-feedback">
                            {{ $errors->first('retail_price') }}
                        </span>
                    @endif
                </div>
                <div class="col-md-4 form-group">
                    <label for="supplier">Fournisseurs</label>
                    <select class="suppliers form-control" name="supplier">
                        <option value="test">--- Choisir un fournisseur ---</option>
                        @foreach ($suppliers as $item)
                            <option value="{{ $item->id }}" {{ ($product->supplier_id === $item->id) ? 'selected' : '' }}>{{ $item->name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('supplier'))
                        <span class="invalid-feedback">
                            {{ $errors->first('supplier') }}
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea row="5" type="text" class="form-control @if ($errors->has('description')) is-invalid @endif" name="description" value="{{ isset($product) ? $product->description : old('description') }}" id="description" placeholder="Entrez la quantité seuil de l'article">
                </textarea>
                @if ($errors->has('description'))
                    <span class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </span>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save mr-1"></i> Sauver
            </button>
        </form>
    </div>
@endsection
