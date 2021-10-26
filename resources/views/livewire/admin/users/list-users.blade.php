<div>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Users</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Users</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- /.col-md-12 -->
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <button class="btn btn-primary btn-sm" wire:click="create"><i class="fas fa-plus"></i>
                                    &nbsp; Add User
                                </button>
                                <div class="d-flex justify-content-center align-items-center border bg-white pr-2 input-group-sm">
                                    <input wire:model="search_keywords" type="text" class="form-control border-0" placeholder="Search">
                                    <div wire:loading.delay wire:target="search_keywords">
                                        <div class="la-ball-clip-rotate la-dark la-sm">
                                            <div></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th class="text-right">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $key => $user)
                                    <tr>
                                        <td>{{ $users->firstItem() + $key }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->created_at->toFormattedDate() }}</td>
                                        <td>{{ $user->updated_at->toFormattedDate() }}</td>
                                        <td class="text-right">
                                            <button type="button" class="btn btn-info btn-sm"><i class="fas fa-eye"></i>
                                            </button>
                                            <button type="button" wire:click.prevent="edit({{ $user }})"
                                                    class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></button>
                                            <button type="button" wire:click.prevent="destroy({{ $user->id }})"
                                                    class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
                <!-- /.col-md-12 -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->

    <!-- form modal -->
    <div wire:ignore.self class="modal fade" id="show-form" tabindex="-1" aria-labelledby="show-form-label"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="show-form-label">
                        @if($edit_mode)
                            <span>Edit User</span>
                        @else
                            <span>Add User</span>
                        @endif
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form autocomplete="off" wire:submit.prevent="{{ $edit_mode ? 'update' : 'store' }}">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input type="text" wire:model.defer="state.name"
                                   class="form-control @error('name') is-invalid @enderror" id="name"
                                   placeholder="Full name">
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" wire:model.defer="state.email"
                                   class="form-control @error('email') is-invalid @enderror" id="email"
                                   placeholder="Enter email">
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" wire:model.defer="state.password"
                                   class="form-control @error('password') is-invalid @enderror" id="password"
                                   placeholder="Password">
                            @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Confirm Password</label>
                            <input type="password" wire:model.defer="state.password_confirmation" class="form-control"
                                   id="passwordConfirmation" placeholder="Confirm Password">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                                class="fas fa-times"></i> Close
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i>
                            @if($edit_mode)
                                <span>Save Change</span>
                            @else
                                <span>Save</span>
                            @endif
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /. form modal -->
</div>

@push('styles')
    <style>
        /*!
     * Load Awesome v1.1.0 (http://github.danielcardoso.net/load-awesome/)
     * Copyright 2015 Daniel Cardoso <@DanielCardoso>
     * Licensed under MIT
     */
        .la-ball-clip-rotate,
        .la-ball-clip-rotate > div {
            position: relative;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        .la-ball-clip-rotate {
            display: block;
            font-size: 0;
            color: #fff;
        }

        .la-ball-clip-rotate.la-dark {
            color: #333;
        }

        .la-ball-clip-rotate > div {
            display: inline-block;
            float: none;
            background-color: currentColor;
            border: 0 solid currentColor;
        }

        .la-ball-clip-rotate {
            width: 32px;
            height: 32px;
        }

        .la-ball-clip-rotate > div {
            width: 32px;
            height: 32px;
            background: transparent;
            border-width: 2px;
            border-bottom-color: transparent;
            border-radius: 100%;
            -webkit-animation: ball-clip-rotate .75s linear infinite;
            -moz-animation: ball-clip-rotate .75s linear infinite;
            -o-animation: ball-clip-rotate .75s linear infinite;
            animation: ball-clip-rotate .75s linear infinite;
        }

        .la-ball-clip-rotate.la-sm {
            width: 16px;
            height: 16px;
        }

        .la-ball-clip-rotate.la-sm > div {
            width: 16px;
            height: 16px;
            border-width: 1px;
        }

        .la-ball-clip-rotate.la-2x {
            width: 64px;
            height: 64px;
        }

        .la-ball-clip-rotate.la-2x > div {
            width: 64px;
            height: 64px;
            border-width: 4px;
        }

        .la-ball-clip-rotate.la-3x {
            width: 96px;
            height: 96px;
        }

        .la-ball-clip-rotate.la-3x > div {
            width: 96px;
            height: 96px;
            border-width: 6px;
        }

        /*
         * Animation
         */
        @-webkit-keyframes ball-clip-rotate {
            0% {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            50% {
                -webkit-transform: rotate(180deg);
                transform: rotate(180deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        @-moz-keyframes ball-clip-rotate {
            0% {
                -moz-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            50% {
                -moz-transform: rotate(180deg);
                transform: rotate(180deg);
            }
            100% {
                -moz-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        @-o-keyframes ball-clip-rotate {
            0% {
                -o-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            50% {
                -o-transform: rotate(180deg);
                transform: rotate(180deg);
            }
            100% {
                -o-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        @keyframes ball-clip-rotate {
            0% {
                -webkit-transform: rotate(0deg);
                -moz-transform: rotate(0deg);
                -o-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            50% {
                -webkit-transform: rotate(180deg);
                -moz-transform: rotate(180deg);
                -o-transform: rotate(180deg);
                transform: rotate(180deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
                -moz-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }
    </style>
@endpush
