<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    {{-- @title('Register') --}}
    <section class="vh-100" style="background-color: #9A616D;">
        <div class="container py-5 h-100">
            <div class="row justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                        <div class="card-body p-4 p-md-5">
                            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Registration Form</h3>
                            {{-- error message --}}
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif


                            <form method="POST" action="{{ url('/register') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 mb-6">
                                        <div data-mdb-input-init class="form-outline">
                                            <label for="name" class="form-label">Name:</label>
                                            <input type="text" id="name" name="name" class="form-control"
                                                value="{{ old('name') }}" required autofocus>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-6">
                                        <div data-mdb-input-init class="form-outline">
                                            <label for="email" class="form-label">Email:</label>
                                            <input type="email" id="email" name="email" class="form-control"
                                                value="{{ old('email') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-6">
                                        <div data-mdb-input-init class="form-outline">
                                            <label for="password" class="form-label">Password:</label>
                                            <input type="password" id="password" name="password" class="form-control"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-6">
                                        <div data-mdb-input-init class="form-outline">
                                            <label for="password_confirmation" class="form-label">Confirm
                                                Password:</label>
                                            <input type="password" id="password_confirmation"
                                                name="password_confirmation" class="form-control" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4 d-flex align-items-center">
                                        <div data-mdb-input-init class="form-outline datepicker w-100">
                                            <label for="linkedin" class="form-label">LinkedIn Username:</label>
                                            <input type="text" id="linkedin" name="linkedin" class="form-control"
                                                value="{{ old('linkedin') }}" required>
                                        </div>

                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label for="gender" class="form-label">Gender:</label>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" id="male" name="gender" value="male"
                                                class="form-check-input" {{ old('gender') == 'male' ? 'checked' : '' }}
                                                required>
                                            <label for="male" class="form-check-label">Male</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input type="radio" id="female" name="gender" value="female"
                                                class="form-check-input"
                                                {{ old('gender') == 'female' ? 'checked' : '' }} required>
                                            <label for="female" class="form-check-label">Female</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 mb-6 pb-2">
                                        <div data-mdb-input-init class="form-outline">
                                            <label for="phone_number" class="form-label">Phone Number:</label>
                                            <input type="text" id="phone_number" name="phone_number"
                                                class="form-control" value="{{ old('phone_number') }}" required>
                                        </div>
                                    </div>

                                    <div class="col-md-12 pb-2">
                                        <label for="job" class="form-label">Fields of Work:</label>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="job[]"
                                                value="Technology">
                                            <label class="form-check-label">Technology</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="job[]"
                                                value="Health">
                                            <label class="form-check-label">Health</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="job[]"
                                                value="Education">
                                            <label class="form-check-label">Education</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="job[]"
                                                value="Finance">
                                            <label class="form-check-label">Finance</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="job[]"
                                                value="Art">
                                            <label class="form-check-label">Art</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-4 pt-2">
                                    <input data-mdb-ripple-init class="btn btn-primary btn-lg" type="submit"
                                        value="Register" />
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

</body>

</html>
