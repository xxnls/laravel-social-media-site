<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>
            {{$pageTitle??"Home"}}
        </title>
        <link rel="stylesheet" href="{{mix('/node_modules/bootstrap/dist/css/bootstrap.min.css')}}" />
        <link rel="stylesheet" href="{{mix('/node_modules/bootstrap-icons/font/bootstrap-icons.min.css')}}" />
    </head>
    <body class="bg-light">
        @include("partials._topbar")

        {{-- Login form for user --}}
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3 mt-3">
                    <div class="card">
                        <div class="card-header">
                            Login
                        </div>
                        <div class="card-body">
                            <form action="users/authenticate" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" class="form-control" value="{{old('email')}}" required>

                                    @error('email')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" id="password" class="form-control" required>

                                    @error('password')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary mt-2">Login</button>
                                </div>

                                @error('login_info')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include("partials._footer")
    </body>
</html>