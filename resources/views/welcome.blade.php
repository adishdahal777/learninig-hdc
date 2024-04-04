<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <title>Learning</title>
</head>

<body>

    <div class=" p-5 bg-primary text-white mb-5">
        <h1>{{ __('lang.heading') }}</h1>
        <p>{{ env('APP_NAME') }}</p>
        <form action="{{ route('language.switch') }}" method="POST">
            @csrf
            <select name="lang" onchange="this.form.submit()" class="form-select">
                <option value="en" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>English</option>
                <option value="np" {{ app()->getLocale() == 'np' ? 'selected' : '' }}>Nepali</option>
                <option value="in" {{ app()->getLocale() == 'in' ? 'selected' : '' }}>Hindi</option>
            </select>
        </form>
    </div>
    <div class="container">

        @if (isset($data))
            <form class="card" action="{{ route('welcome.add.update', ['id' => $data->id]) }}" method="POST">
                @method('POST')
                @csrf
                <div class="card-header">
                    <a href="{{ route('welcome.hi') }}" class="btn btn-warning">Go Back</a>
                </div>
                <div class="card-body">
                    <div class="form-group mb-2">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter name"
                            value="{{ $data->name }}">
                        @error('name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label for="address">Address:</label>
                        <input type="text" class="form-control" name="address" placeholder="Enter address"
                            value="{{ $data->address }}">
                        @error('address')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label for="number">Number:</label>
                        <input type="text" class="form-control" name="phone" placeholder="Enter number"
                            value="{{ $data->number }}">
                        @error('phone')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" name="email" placeholder="Enter email"
                            value="{{ $data->email }}">
                        @error('email')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        @else
            @session('info')
                <div class="alert alert-success">
                    {{ session('info.message') }}
                </div>
            @endsession

            @if ($add)
                <form class="card" action="{{ route('welcome.add.submit') }}" method="POST">
                    @method('POST')
                    @csrf
                    <div class="card-header">
                        <a href="{{ route('welcome.hi') }}" class="btn btn-warning">Go Back</a>
                    </div>
                    <div class="card-body">
                        <div class="form-group mb-2">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" name="name" placeholder="Enter name"
                                value="{{ old('name') }}">
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label for="address">Address:</label>
                            <input type="text" class="form-control" name="address" placeholder="Enter address"
                                value="{{ old('address') }}">
                            @error('address')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label for="number">Number:</label>
                            <input type="text" class="form-control" name="phone" placeholder="Enter number"
                                value="{{ old('phone') }}">
                            @error('phone')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" name="email" placeholder="Enter email"
                                value="{{ old('email') }}">
                            @error('email')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            @endif

            <div class="row mt-5">
                <table class="table table-stripped">
                    <thead>
                        @if (!$add)
                            <tr>
                                <th colspan="6">
                                    <a href="{{ route('welcome.add') }}" class="btn btn-primary">Add User</a>
                                </th>
                            </tr>
                        @endif
                        <tr>
                            <th>SN</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($users) > 0)
                            @php
                                $sn = 1;
                            @endphp
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $sn++ }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->address }}</td>
                                    <td>{{ $user->number }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <a href="{{ route('welcome.add.edit', ['id' => $user->id]) }}"
                                            class="btn btn-success">Edit</a>
                                        <button class="btn btn-danger" id="deleteButton"
                                            data-id="{{ $user->name }}">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6">
                                    <div class="alert alert-danger">
                                        No Users Found
                                    </div>
                                </td>
                            </tr>
                        @endif

                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <script>
        $(document).ready(function() {
            $('#deleteButton').click(function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                console.log(id);

            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
</body>

</html>
