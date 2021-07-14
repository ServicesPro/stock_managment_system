@extends('layouts.master')

@push('js')
    <!-- Page level plugins -->
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
    <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>

    <script>
        $('.sa-delete').on('click', function () {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            let formId = $('.sa-delete').data('form-id')

            swalWithBootstrapButtons.fire({
                title: 'Ês-tu sûr(e)?',
                text: "Cette action est irréverssible!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Oui, je supprime!',
                cancelButtonText: 'Non, j\'annule!',
                reverseButtons: true
                }).then((result) => {
                if (result.isConfirmed) {
                    $('#'+formId).submit()
                    
                    swalWithBootstrapButtons.fire(
                    'Suppression!',
                    'La couleur a bien été supprimé.',
                    'success'
                    )
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                    'Annulation',
                    'L\'action a été avortée :)',
                    'error'
                    )
                }
            })
        })
    </script>
@endpush

@push('css')
    <!-- Custom styles for this page -->
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sweetalert2.min.css') }}" rel="stylesheet">
@endpush

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Couleurs</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Liste des couleurs</h6> <br>

            <a href="{{ route('colors.create') }}" class="btn btn-primary btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Ajouter une couleur</span>
            </a><br><br>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nom</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Nom</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @if ($colors)
                            @foreach ($colors as $key => $item)
                                <tr>
                                    <td># {{ ++$key }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        <a href="{{ route('colors.edit', $item) }}" class="btn btn-primary">
                                            <i class="fas fa-edit mr-1"></i> Modifier
                                        </a>
                                        <a onclick="event.preventDefault()" data-form-id="family-{{ $item->id }}" href="{{ route('colors.destroy', $item) }}" class="btn btn-danger sa-delete">
                                            <i class="fas fa-trash mr-1"></i> Supprimer
                                        </a>

                                        <form id="family-{{ $item->id }}" method="POST" action="{{ route('colors.destroy', $item) }}">
                                            @csrf
                                            @method("DELETE")
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
