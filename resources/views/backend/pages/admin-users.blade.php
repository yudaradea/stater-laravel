@extends('backend.layouts.pages_layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Users list')
@section('content')
    @livewire('backend.users')
@endsection

@push('scripts')
    <script>
        // reset modal form kalo ditutup
        $(window).on("hidden.bs.modal", function() {
            Livewire.dispatch('resetForm');
        });

        // CLose modal addUser ketika sudah sukses menambahkan user
        window.addEventListener('hideAddUserModal', event => {
            $('#addUser').modal('hide');
        });

        // Open modal edit User
        window.addEventListener('openModalEditUser', event => {
            $('#editUser').modal('show');
        });

        // Close modal edit User
        window.addEventListener('closeModalEditUser', event => {
            $('#editUser').modal('hide');
        });
    </script>
@endpush

