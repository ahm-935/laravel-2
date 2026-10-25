<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body>

<div class="container py-5">

    <div class="row justify-content-center">
        <div class="col-md-7">

            <div class="card shadow">

                <div class="card-body text-center p-5">

                    <h2 class="text-success mb-3">
                        Payment Successful!
                    </h2>

                    <p class="mb-4">
                        Your booking has been confirmed successfully.
                    </p>

                    <div class="text-start">

                        <p>
                            <strong>Booking Code:</strong>
                            {{ $booking->booking_code }}
                        </p>

                        <p>
                            <strong>Event:</strong>
                            {{ $booking->event->title }}
                        </p>

                        <p>
                            <strong>Ticket:</strong>
                            {{ $booking->ticketType->name }}
                        </p>

                        <p>
                            <strong>Quantity:</strong>
                            {{ $booking->quantity }}
                        </p>

                        <p>
                            <strong>Total:</strong>
                            BDT {{ number_format($booking->total_price, 2) }}
                        </p>

                        <p>
                            <strong>Status:</strong>
                            <span class="badge bg-success">
                                {{ ucfirst($booking->status) }}
                            </span>
                        </p>

                    </div>

                    <div class="mt-4">
                        <a
                            href="{{ route('bookings.index') }}"
                            class="btn btn-primary"
                        >
                            My Bookings
                        </a>
                    </div>

                </div>

            </div>

        </div>
    </div>

</div>

</body>
</html>