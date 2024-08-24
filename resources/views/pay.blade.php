<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid min-vh-100 d-flex align-items-center justify-content-center"
        style="background-color: #f9c9aa;">
        <div class="col-md-8 col-lg-6 col-xl-5">
            <div class="card">
                <img src="profile/1.jpg" class="card-img-top" alt="Black Chair" />
                <div class="card-body text-center">
                    <h3 class="card-title">{{ $price }}</h3>
                </div>
                <div class="rounded-bottom bg-light">
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success text-center">{{ session('success') }}</div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger text-center">{{ session('error') }}</div>
                        @endif

                        <h3 class="text-center mb-4">Your Payment Details</h3>
                        <form method="POST" action="{{ route('updatePaid') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="payment_amount" class="form-label">Enter Payment Amount:</label>
                                <input type="number" id="payment_amount" name="payment_amount" class="form-control"
                                    placeholder="Enter amount" required>
                            </div>
                            <input type="hidden" id="price" name="price" value="{{ $price }}">
                            <button type="submit" class="btn btn-block"
                                style="background-color: #9A616D; color: white;">Pay Now</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
