<section>
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h3 class="card-title">List User</h3>
            <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#addUser">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users-plus me-2"
                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M5 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                        <path d="M3 21v-2a4 4 0 0 1 4 -4h4c.96 0 1.84 .338 2.53 .901"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        <path d="M16 19h6"></path>
                        <path d="M19 16v6"></path>
                    </svg>
                </span>
                Tambah User
            </button>
        </div>
        <div class="card-body border-bottom py-3">
            <div class="d-flex">
                <div class="text-secondary">
                    Show
                    <div class="d-inline-block mx-2">
                        <input type="text" class="form-control form-control-sm" value="10" size="3"
                            aria-label="Invoices count" wire:model.live='perPage'>
                    </div>
                    entries
                </div>
                <div class="text-secondary ms-auto">
                    Search:
                    <div class="d-inline-block ms-2">
                        <input type="text" class="form-control form-control-sm" aria-label="Search invoice"
                            wire:model.live='search'>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="card-table table-vcenter text-nowrap datatable table">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td>
                                <span class="me-2"><img src="{{ $user->picture }}" class="rounded-pill"
                                        style="width: 30px"></span>
                                {{ $user->name }}
                            </td>
                            <td>
                                {{ $user->username }}
                            </td>

                            <td>
                                {{ $user->email }}
                            </td>
                            <td class="{{ $user->type == 2 ? 'text-purple' : 'text-green' }}">
                                {{ $user->authorType->name }}
                            </td>
                            <td>
                                <span class="badge bg-success me-1"></span> Paid
                            </td>
                            <td class="text-end">
                                <span class="dropdown position-static">
                                    <button class="btn dropdown-toggle" data-bs-boundary="window"
                                        data-bs-toggle="dropdown">Actions</button>
                                    <div class="dropdown-menu">
                                        <button class="dropdown-item"
                                            wire:click.prevent='editUser({{ $user }})'>
                                            Edit User
                                        </button>
                                        <button class="dropdown-item" data-bs-toggle="modal"
                                            data-bs-target="#deleteUser{{ $user->id }}">
                                            Delete User
                                        </button>
                                    </div>
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-danger" colspan="6">Data tidak ditemukan</td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
        <div class="card-footer d-flex align-items-center justify-content-between">
            <p class="text-secondary m-0">Total Users <span>{{ $totaluser->count() }}</span> user</p>
            <span>{{ $users->links('livewire::bootstrap') }}</span>
        </div>
    </div>

    {{-- Modal add user --}}
    <div wire:ignore.self class="modal modal-blur fade" id="addUser" tabindex="-1" role="dialog" aria-hidden="true"
        data-bs-backdrop="static" data-bs-keybiard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent='addUser' method="post">

                    <input type="hidden" wire:model='email_verified_at'>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="example-text-input"
                                placeholder="Masukan Nama User" wire:model='name' />
                            <span class="text-danger">
                                @error('name')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control" name="example-text-input"
                                placeholder="Masukan Username User" wire:model='username' />
                            <span class="text-danger">
                                @error('username')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="example-text-input"
                                placeholder="Masukan Email User" wire:model='email' />
                            <span class="text-danger">
                                @error('email')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="form-group mb-3">
                            <div class="form-label">Jenis Kelamin</div>
                            <div class="input-group custom">
                                <select class="form-select" wire:model='gender'>
                                    <option value="">--- No Selected ---</option>
                                    <option value="Pria">Pria</option>
                                    <option value="Wanita">Wanita</option>
                                </select>
                            </div>
                            <span class="text-danger">
                                @error('gender')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="form-group mb-3">
                            <div class="form-label">Author Type</div>
                            <div>
                                <select class="form-select" wire:model='type'>
                                    <option value="">--- No Selected ---</option>
                                    @foreach (\App\Models\Type::all() as $type)
                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <span class="text-danger">
                                @error('type')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn me-auto" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal edit User --}}
    <div wire:ignore.self class="modal modal-blur fade" id="editUser" tabindex="-1" role="dialog"
        aria-hidden="true" data-bs-backdrop="static" data-bs-keybiard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent='updateUser()' method="post">
                    <div class="modal-body">
                        <input type="hidden" wire:model='selected_user_id'>
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="example-text-input"
                                placeholder="Masukan Nama Author" wire:model='name' />
                            <span class="text-danger">
                                @error('name')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control" name="example-text-input"
                                placeholder="Masukan Username Author" wire:model='username' />
                            <span class="text-danger">
                                @error('username')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="example-text-input"
                                placeholder="Masukan Email Author" wire:model='email' />
                            <span class="text-danger">
                                @error('email')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="form-group mb-3">
                            <div class="form-label">Jenis Kelamin</div>
                            <div class="input-group custom">
                                <select class="form-select" wire:model='gender'>
                                    <option value="Pria" {{ $gender == 'Pria' ? 'selected' : '' }}>Pria
                                    </option>
                                    <option value="Wanita" {{ $gender == 'Wanita' ? 'selected' : '' }}>
                                        Wanita
                                    </option>
                                </select>
                            </div>
                            <span class="text-danger">
                                @error('gender')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="form-group mb-3">
                            <div class="form-label">Author Type</div>
                            <div>
                                <select class="form-select" wire:model='type'>
                                    @foreach (\App\Models\Type::all() as $type)
                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <span class="text-danger">
                                @error('type')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="form-group mb-3">
                            <div class="form-label">Blocked User?</div>
                            <div class="input-group custom">
                                <select class="form-select" wire:model='blocked'>
                                    <option value="0" {{ $blocked == 0 ? 'selected' : '' }}>No
                                    </option>
                                    <option value="1" {{ $blocked == 1 ? 'selected' : '' }}>
                                        Blocked
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal hapus user --}}
    @foreach ($users as $user)
        <div wire:ignore.self class="modal modal-blur fade" id="deleteUser{{ $user->id }}" tabindex="-1"
            role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-keybiard="false">
            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="modal-status bg-danger"></div>
                    <form wire:submit.prevent='delete_user({{ $user->id }})' method="POST">
                        <div class="modal-body py-4 text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon text-danger icon-lg mb-2"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 9v2m0 4v.01" />
                                <path
                                    d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" />
                            </svg>
                            <h3>Apakah kamu yakin?</h3>
                            <div class="text-secondary">Kamu ingin menghapus user
                                <b>{{ $user->name }}</b>
                                ?
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
                                        <button type="submit" class="btn btn-danger w-100" data-bs-dismiss="modal">
                                            Delete
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

</section>

