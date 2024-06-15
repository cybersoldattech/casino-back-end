@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Ajouter une nouvelle marque</h1>

        <form method="POST" action="{{ route('admin.brands.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="form-group col-md-6 col-xs-12">
                    <label for="brand_name">Nom de la marque</label>
                    <input type="text" id="brand_name" name="brand_name" class="form-control" value="{{ old('brand_name') }}">
                </div>
                <div class="form-group col-md-6 col-xs-12">
                    <label for="rating">Rating</label>
                    <input type="number" id="rating" name="rating" class="form-control" value="{{ old('rating') }}">
                </div>

            </div>
            

           

            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" class="form-control">{{ old('description') }}</textarea>
            </div>

            <div class="form-group">
                <label for="brand_image">Image de la marque</label>
                <input type="file" id="brand_image" name="brand_image" class="form-control-file">
            </div>

           

            <button type="submit" class="btn btn-primary">Enregistrer</button>
            <a href="{{ route('admin.brands.index') }}" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
@endsection
