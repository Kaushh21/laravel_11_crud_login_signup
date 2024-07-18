<!DOCTYPE html>
<html>

<head>
    <title>User List - CLICKUP TASK</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">
        <div class="row">
            <div class="d-flex col-md-7">
                <h1>User List</h1>
            </div>
            <div class="col-md-5 justify-content-between">
                <a href="{{ route('dashboard') }}" class="btn btn-secondary ms-2">
                    Back to Dashboard
                </a>
                <a href="{{ route('users.pdf') }}" class="btn btn-primary">
                    Download as PDF
                </a>
                <a href="{{ route('users.excel') }}" class="btn btn-success">
                    Download as Excel
                </a>
            </div>
        </div>
        @if(session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <table class="table table-bordered mt-3 custom-table">
            <thead>
                <tr>
                    <th style="width: 5%;">ID</th>
                    <th style="width: 15%;">Name</th>
                    <th style="width: 20%;">Email</th>
                    <th style="width: 10%;">City</th>
                    <th style="width: 25%;">Description</th>
                    <th style="width: 7%;">Age</th>
                    <th style="width: 13%;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->city }}</td>
                        <td>{{ $user->description }}</td>
                        <td>{{ $user->age}}</td>
                        <td>
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary">Edit</a>
                            <button type="button" class="btn btn-danger"
                                onclick="confirmDelete('{{ $user->id }}')">Delete</button>
                            <form id="delete-form-{{ $user->id }}" action="{{ route('users.destroy', $user->id) }}"
                                method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function confirmDelete(userId) {
            if (confirm('Are you sure you want to delete this user?')) {
                document.getElementById('delete-form-' + userId).submit();
            }
        }
    </script>
</body>

</html>
