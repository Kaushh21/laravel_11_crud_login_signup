<!DOCTYPE html>
<html>

<head>
    <title>CLICKUP TASK</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

    <nav class="navbar navbar-light navbar-expand-lg mb-5" style="background-color:#d4bcf5;">
        <div class="container">

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register-user') }}">Register</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('signout') }}">Logout</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="{{ route('profile') }}">Update Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('users.index') }}">Show Users</a>
                        </li>
                    @endguest

                </ul>

            </div>
        </div>
    </nav>
    <div class="container">  
    @if(auth()->check())
                <h1 class="text-danger mb-3" >Welcome {{ auth()->user()->name }}</h1>
            @else
                <h1 class="text-danger" href="#">Welcome Guest</h1>
            @endif   
            <h3 ><strong>Description: </strong> <span class="text-success">{{ Auth::user()->description }}</span></h3>       
            <h3><strong>City: </strong> <span class="text-success">{{ Auth::user()->city }}</span></h3>        
            <h3><strong>Age: </strong><span class="text-success">{{ Auth::user()->age }}</span></h3>
            <h3><strong>Created at: </strong><span class="text-success">{{ Auth::user()->created_at }}</span></h3> 
            <h3><strong>Updated at: </strong> <span class="text-success">{{ Auth::user()->updated_at }}</span></h3>   
    </div>
    <!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>