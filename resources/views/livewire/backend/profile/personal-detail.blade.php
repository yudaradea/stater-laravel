<section>
    <form method="post" wire:submit.prevent='UpdateDetails()'>
        <div class="row">
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" name="example-text-input" wire:model='name' />
                    <span class="text-danger">
                        @error('name')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
            </div>

            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" class="form-control" name="example-text-input" wire:model='username' />
                    <span class="text-danger">
                        @error('username')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
            </div>

            <div class="col-md-4">
                <div class="mb-3"> <label class="form-label">Email</label> <input type="text" class="form-control"
                        name="example-text-input" wire:model='email'>
                    <span class="text-danger">
                        @error('email')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
            </div>
        </div>
        <div class="text-end">
            <button type="submit" class="btn btn-primary">Save Change</button>
        </div>
    </form>

    {{-- Modal password show --}}
    <div wire:ignore.self class="modal modal-blur fade" id="showModalPassword" tabindex="-1" role="dialog"
        aria-hidden="true" data-bs-backdrop="static" data-bs-keybiard="false">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-status bg-primary"></div>
                <form wire:submit.prevent='passwordUser' method="POST">
                    <div class="modal-body py-4 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon text-danger icon-lg mb-2" width="24"
                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 9v2m0 4v.01" />
                            <path
                                d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" />
                        </svg>
                        <h3>Masukan password untuk melanjutkan</h3>
                        <div class="mb-2">
                            <div class="input-group input-group-flat">
                                <input type="password" class="form-control" id="passwordModal"
                                    placeholder="Your password" autocomplete="off" name="password"
                                    wire:model='password'>
                                <span class="input-group-text">
                                    <span class="link-secondary" style="cursor: pointer;" title="Show Password"
                                        id="showPasswordModal"
                                        data-bs-toggle="tooltip"><!-- Download SVG icon from http://tabler-icons.io/i/eye -->

                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-eye-off" id="show_eye_modal"
                                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M10.585 10.587a2 2 0 0 0 2.829 2.828"></path>
                                            <path
                                                d="M16.681 16.673a8.717 8.717 0 0 1 -4.681 1.327c-3.6 0 -6.6 -2 -9 -6c1.272 -2.12 2.712 -3.678 4.32 -4.674m2.86 -1.146a9.055 9.055 0 0 1 1.82 -.18c3.6 0 6.6 2 9 6c-.666 1.11 -1.379 2.067 -2.138 2.87">
                                            </path>
                                            <path d="M3 3l18 18"></path>
                                        </svg>

                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon d-none" id="hide_eye_modal"
                                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                            <path
                                                d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                        </svg>
                                    </span>
                                </span>
                            </div>
                            @error('password')
                                <div class="text-start">
                                    <span class="text-danger"><small>{{ $message }}</small></span>
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="w-100">
                            <div class="row">
                                <div class="col">
                                    <button type="button" class="btn w-100" data-bs-dismiss="modal">
                                        Cancel
                                    </button>
                                </div>
                                <div class="col">
                                    <button type="submit" class="btn btn-primary w-100">
                                        Submit
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const showPasswordModal = document.getElementById("showPasswordModal");
        const passwordModal = document.getElementById("passwordModal");
        const show_eye_modal = document.getElementById("show_eye_modal");
        const hide_eye_modal = document.getElementById("hide_eye_modal");

        showPasswordModal.addEventListener("click", function() {
            hide_eye_modal.classList.remove("d-none");

            if (passwordModal.type === "password") {
                passwordModal.type = "text";
                show_eye_modal.style.display = "none";
                hide_eye_modal.style.display = "block";
            } else {
                passwordModal.type = "password";
                show_eye_modal.style.display = "block";
                hide_eye_modal.style.display = "none";
            }
        });
    </script>

</section>

