@extends('backend.layouts.pages_layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Admin-Profile')
@section('content')
    @livewire('backend.profile.user-profile')

    {{-- Tabs --}}
    <div class="page-header card">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs">
                <li class="nav-item">
                    <a href="#tabs-detail" class="nav-link active" data-bs-toggle="tab"><svg xmlns="http://www.w3.org/2000/svg"
                            class="icon icon-tabler icon-tabler-id me-1" width="24" height="24" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M3 4m0 3a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v10a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3z">
                            </path>
                            <path d="M9 10m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                            <path d="M15 8l2 0"></path>
                            <path d="M15 12l2 0"></path>
                            <path d="M7 16l10 0"></path>
                        </svg>Personal Detail</a>
                </li>
                <li class="nav-item">
                    <a href="#tabs-password" class="nav-link" data-bs-toggle="tab"><svg xmlns="http://www.w3.org/2000/svg"
                            class="icon icon-tabler icon-tabler-key me-1" width="24" height="24" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path
                                d="M16.555 3.843l3.602 3.602a2.877 2.877 0 0 1 0 4.069l-2.643 2.643a2.877 2.877 0 0 1 -4.069 0l-.301 -.301l-6.558 6.558a2 2 0 0 1 -1.239 .578l-.175 .008h-1.172a1 1 0 0 1 -.993 -.883l-.007 -.117v-1.172a2 2 0 0 1 .467 -1.284l.119 -.13l.414 -.414h2v-2h2v-2l2.144 -2.144l-.301 -.301a2.877 2.877 0 0 1 0 -4.069l2.643 -2.643a2.877 2.877 0 0 1 4.069 0z">
                            </path>
                            <path d="M15 9h.01"></path>
                        </svg>Change Password</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content">
                <div class="tab-pane active show" id="tabs-detail">
                    @livewire('backend.profile.personal-detail')
                </div>

                <div class="tab-pane" id="tabs-password">

                    @livewire('backend.profile.update-password')

                </div>
            </div>
        </div>
    </div>

    <script>
        const showPassword = document.getElementById("showPassword");
        const showNewPassword = document.getElementById("showNewPassword");
        const showConfirmPassword = document.getElementById("showConfirmPassword");
        const password = document.getElementById("password");
        const newPassword = document.getElementById("newPassword");
        const confirmPassword = document.getElementById("confirmPassword");
        const show_eye = document.getElementById("show_eye");
        const show_eye_new = document.getElementById("new_show_eye");
        const show_eye_confirm = document.getElementById("show_eye_confirm");
        const hide_eye = document.getElementById("hide_eye");
        const hide_eye_new = document.getElementById("new_hide_eye");
        const hide_eye_confirm = document.getElementById("hide_eye_confirm");

        showPassword.addEventListener("click", function() {
            hide_eye.classList.remove("d-none");

            if (password.type === "password") {
                password.type = "text";
                show_eye.style.display = "none";
                hide_eye.style.display = "block";
            } else {
                password.type = "password";
                show_eye.style.display = "block";
                hide_eye.style.display = "none";
            }
        });

        showNewPassword.addEventListener("click", function() {
            hide_eye_new.classList.remove("d-none");

            if (newPassword.type === "password") {
                newPassword.type = "text";
                show_eye_new.style.display = "none";
                hide_eye_new.style.display = "block";
            } else {
                newPassword.type = "password";
                show_eye_new.style.display = "block";
                hide_eye_new.style.display = "none";
            }
        });

        showConfirmPassword.addEventListener("click", function() {
            hide_eye_confirm.classList.remove("d-none");

            if (confirmPassword.type === "password") {
                confirmPassword.type = "text";
                show_eye_confirm.style.display = "none";
                hide_eye_confirm.style.display = "block";
            } else {
                confirmPassword.type = "password";
                show_eye_confirm.style.display = "block";
                hide_eye_confirm.style.display = "none";
            }
        });
    </script>
@endsection

@push('scripts')
    <script>
        $('#ChangeUserPictureFile').ijaboCropTool({
            preview: '.image-previewer',
            setRatio: 1,
            allowedExtensions: ['jpg', 'jpeg', 'png'],
            buttonsText: ['CROP', 'QUIT'],
            buttonsColor: ['#30bf7d', '#ee5155', -15],
            processUrl: '{{ route('admin.change-profile-picture') }}',
            withCSRF: ['_token', '{{ csrf_token() }}'],
            onSuccess: function(message, element, status) {
                Livewire.dispatch('updateUser');
                toastr.success(message);
            },
            onError: function(message, element, status) {
                toastr.error(message);
            }
        });
    </script>

    <script>
        // reset modal form kalo ditutup
        $(window).on("hidden.bs.modal", function() {
            Livewire.dispatch('resetForm');
        });

        // Open modal confirm password
        window.addEventListener('openModalPassword', event => {
            $('#showModalPassword').modal('show');
        });

        // CLose modal password kalo password benar
        window.addEventListener('closeModalPassword', event => {
            $('#showModalPassword').modal('hide');
        });
    </script>
@endpush

