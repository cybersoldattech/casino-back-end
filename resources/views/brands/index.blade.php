<!-- resources/views/brands/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <h1>Liste des marques</h1>

        <a href="{{ route('admin.brands.create') }}" class="btn btn-primary mb-3">Ajouter une marque</a>

        <table class="table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Image</th>
                    <th>Description</th>
                    <th>Rating</th>
                    <th>Actions</th>
                    <input type= "hidden" id= "brandID" value="" />
                </tr>
            </thead>
            <tbody>
                @foreach ($brands as $brand)
                    <tr>
                        <td>{{ $brand->brand_name }}</td>
                        <td>
                            @if ($brand->brand_image)
                                <img src="{{ $brand->brand_image }}" alt="{{ $brand->brand_name }}"
                                    style="max-width: 100px;">
                            @else
                                Aucune image
                            @endif
                        </td>
                        <td>{{ $brand->description }}</td>
                        <td>{{ $brand->rating }}</td>
                        <td>
                            <a href="{{ route('admin.brands.edit', $brand->id) }}"
                                class="btn btn-sm btn-primary">Modifier</a>
                                <button type="button" class="btn btn-sm btn-danger delete-brand-btn" data-toggle="modal" data-target="#deleteModal"   onclick="setBrandId('{{ $brand->id }}')">
                                    Supprimer
                                </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- Modal de confirmation de suppression -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirmer la suppression</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Êtes-vous sûr de vouloir supprimer cette marque ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    function setBrandId(id) {
            if (!id) return;
            document.getElementById('brandID').value = id;
            var url = "{{ route('admin.brands.destroy', ':id') }}";
            url = url.replace(':id', id);
            $('#deleteForm').attr('action', url);
        }
</script>
