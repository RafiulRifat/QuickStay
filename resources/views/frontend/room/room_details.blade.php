@extends('frontend.main_master')
@section('content')

<!-- Room Details Section -->
<section class="room-details-section py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="room-details-content">
                    <h2 class="mb-3">Luxury Room</h2>
                    <img src="{{ asset('assets/img/room/room-details-img1.jpg') }}" class="img-fluid rounded" alt="Luxury Room">
                    
                    <p class="mt-3">
                        Experience the ultimate luxury in our spacious and elegantly designed rooms. Enjoy world-class amenities, breathtaking views, and impeccable service.
                    </p>

                    <h3 class="mt-4">Room Features</h3>
                    <ul class="list-unstyled">
                        <li>🛏️ King-size Bed</li>
                        <li>📡 Free Wi-Fi</li>
                        <li>📺 Smart TV</li>
                        <li>❄️ Air Conditioning</li>
                        <li>🚿 Private Bathroom</li>
                        <li>🍽️ Room Service</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="room-details-sidebar p-4 border rounded">
                    <h4>Book This Room</h4>
                    <form action="{{ route('booking.submit') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="check-in" class="form-label">Check-in Date</label>
                            <input type="date" id="check-in" name="check_in" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="check-out" class="form-label">Check-out Date</label>
                            <input type="date" id="check-out" name="check_out" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="guests" class="form-label">Guests</label>
                            <select id="guests" name="guests" class="form-control">
                                <option value="1">1 Guest</option>
                                <option value="2">2 Guests</option>
                                <option value="3">3 Guests</option>
                                <option value="4">4 Guests</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Book Now</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
