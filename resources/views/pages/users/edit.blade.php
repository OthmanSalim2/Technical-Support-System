@extends('front')

@section('page-title', 'Edit User')
@section('root-title', 'Update User')
@section('large-title', 'Edit User')

@section('content')
    <div class="content">
        <div class="container-sm" style="width: 60%">
            <div class="card card-gray-dark">
                <div class="card-header">
                    <h3 class="card-title"> Change the information of user</h3>
                </div>
                <div class="container-sm">
                    <form action="{{ route('users.update', ['user' => $user->id]) }}" method="POST">
                        @method('PATCH')
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input value="{{ old('name', $user->name) }}" type="text" name="name"
                                       class="form-control"
                                       id="name"
                                       placeholder="Name">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control"
                                       value="{{ old('email', $user->email) }}"
                                       id="email" placeholder="Email...">
                            </div>
                            <div class="form-group">
                                <label for="email">Password</label>
                                <input type="password" name="password"
                                       class="form-control mb-2"
                                       id="password"
                                       placeholder="Enter password...">
                                <div class="icheck-primary d-inline">
                                    <input type="checkbox" id="togglePassword">
                                    <label for="togglePassword">Show Password</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Department</label>
                                    <label>Department</label>
                                    <select name="department" class="form-control select2 select2-hidden-accessible"
                                            style="width: 100%;"
                                            data-select2-id="1" tabindex="-1" aria-hidden="true">
                                        @forelse($departments as $department)
                                            <option value="{{ $department->id }}"
                                                    @selected($department->id == $selectedDepartment)
                                                    data-select2-id="34">
                                                {{ $department->name }}
                                            </option>
                                        @empty
                                            <option value="#" data-select2-id=" 34">
                                                Not Found Any Department
                                            </option>
                                        @endforelse
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label>Guard</label>
                                    <select name="guard" class="form-control select2 select2-hidden-accessible"
                                            style="width: 100%;"
                                            data-select2-id="1" tabindex="-1" aria-hidden="true">
                                        <option value="normal" data-select2-id="34">Normal User</option>
                                        <option value="admin" data-select2-id="35">Admin</option>
                                        <option value="super-admin" data-select2-id="36">Super Admin</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card">
                            <button type="submit" class="btn btn-outline-dark">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        const togglePassword = document
            .querySelector('#togglePassword');
        const password = document.querySelector('#password');
        togglePassword.addEventListener('click', () => {
            // Toggle the type attribute using
            // getAttribure() method
            const type = password
                .getAttribute('type') === 'password' ?
                'text' : 'password';
            password.setAttribute('type', type);
            // Toggle the eye and bi-eye icon
            this.classList.toggle('bi-eye');
        });
    </script>
@endsection
