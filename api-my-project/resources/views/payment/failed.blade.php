<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Failed</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body>

<div class="container py-5">

    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow">
                <div class="card-body text-center p-5">

                    <h2 class="text-danger mb-3">
                        Payment Failed
                    </h2>

                    <p>
                        {{ session('error', 'Your payment could not be completed.') }}
                    </p>

                    <a
                        href="{{ route('events.index') }}"
                        class="btn btn-primary mt-3"
                    >
                        Back to Events
                    </a>

                </div>
            </div>

        </div>
    </div>

</div>

</body>
</html>