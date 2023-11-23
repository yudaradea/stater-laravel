<section>
    <form method="POST" wire:submit.prevent='UpdatePassword()'>
        <div class="row mt-1">
            {{-- Current Password --}}
            <div class="col-md-4 mb-3">
                <label class="form-label">
                    Current Password
                </label>
                <div class="input-group input-group-flat">
                    <input type="password" class="form-control" id="password" placeholder="Current password"
                        autocomplete="off" wire:model='current_password'>
                    <span class="input-group-text">
                        <span class="link-secondary" style="cursor: pointer;" title="Show Password" id="showPassword"
                            data-bs-toggle="tooltip"><!-- Download SVG icon from http://tabler-icons.io/i/eye -->

                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye-off"
                                id="show_eye" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M10.585 10.587a2 2 0 0 0 2.829 2.828"></path>
                                <path
                                    d="M16.681 16.673a8.717 8.717 0 0 1 -4.681 1.327c-3.6 0 -6.6 -2 -9 -6c1.272 -2.12 2.712 -3.678 4.32 -4.674m2.86 -1.146a9.055 9.055 0 0 1 1.82 -.18c3.6 0 6.6 2 9 6c-.666 1.11 -1.379 2.067 -2.138 2.87">
                                </path>
                                <path d="M3 3l18 18"></path>
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon d-none" id="hide_eye"width="24"
                                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                <path
                                    d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                            </svg>
                        </span>
                    </span>
                </div>
                <span class="text-danger">
                    @error('current_password')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            {{-- End Password --}}

            {{-- New Password --}}
            <div class="col-md-4 mb-3">
                <label class="form-label">
                    New Password
                </label>
                <div class="input-group input-group-flat">
                    <input type="password" class="form-control" id="newPassword" placeholder="New Password"
                        autocomplete="off" wire:model='new_password'>
                    <span class="input-group-text">
                        <span class="link-secondary" style="cursor: pointer;" title="Show Password" id="showNewPassword"
                            data-bs-toggle="tooltip"><!-- Download SVG icon from http://tabler-icons.io/i/eye -->

                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye-off"
                                id="new_show_eye" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M10.585 10.587a2 2 0 0 0 2.829 2.828"></path>
                                <path
                                    d="M16.681 16.673a8.717 8.717 0 0 1 -4.681 1.327c-3.6 0 -6.6 -2 -9 -6c1.272 -2.12 2.712 -3.678 4.32 -4.674m2.86 -1.146a9.055 9.055 0 0 1 1.82 -.18c3.6 0 6.6 2 9 6c-.666 1.11 -1.379 2.067 -2.138 2.87">
                                </path>
                                <path d="M3 3l18 18"></path>
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon d-none" id="new_hide_eye" width="24"
                                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                <path
                                    d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                            </svg>
                        </span>
                    </span>
                </div>
                <span class="text-danger">
                    @error('new_password')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            {{-- End New Password --}}

            {{-- Confirm Password --}}
            <div class="col-md-4 mb-3">
                <label class="form-label">
                    Confirm Password
                </label>
                <div class="input-group input-group-flat">
                    <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm password"
                        autocomplete="off" wire:model='confirm_password'>
                    <span class="input-group-text">
                        <span class="link-secondary" style="cursor: pointer;" title="Show Password"
                            data-bs-toggle="tooltip"
                            id="showConfirmPassword"><!-- Download SVG icon from http://tabler-icons.io/i/eye -->

                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye-off"
                                id="show_eye_confirm" width="24" height="24" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M10.585 10.587a2 2 0 0 0 2.829 2.828"></path>
                                <path
                                    d="M16.681 16.673a8.717 8.717 0 0 1 -4.681 1.327c-3.6 0 -6.6 -2 -9 -6c1.272 -2.12 2.712 -3.678 4.32 -4.674m2.86 -1.146a9.055 9.055 0 0 1 1.82 -.18c3.6 0 6.6 2 9 6c-.666 1.11 -1.379 2.067 -2.138 2.87">
                                </path>
                                <path d="M3 3l18 18"></path>
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon d-none" id="hide_eye_confirm"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                <path
                                    d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                            </svg>
                        </span>
                    </span>
                </div>
                <span class="text-danger">
                    @error('confirm_password')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            {{-- End Confirm Password --}}

        </div>
        <div class="mt-2 text-end">
            <button type="submit" class="btn btn-primary">Save Change</button>
        </div>
    </form>
</section>

