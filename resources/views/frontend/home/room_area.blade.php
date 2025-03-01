@php
    // Fetch latest rooms with the 'type' relationship to avoid null errors
    $rooms = App\Models\Room::with('type')->latest()->limit(4)->get();
@endphp

<div class="room-area pt-100 pb-70 section-bg" style="background-color:#ffffff">
    <div class="container">
        <div class="section-title text-center">
            <span class="sp-color">ROOMS</span>
            <h2>Our Rooms & Rates</h2>
        </div>
        <div class="row pt-45">

            @foreach ($rooms as $item)
                <div class="col-lg-6">
                    <div class="room-card-two">
                        <div class="row align-items-center">
                            <div class="col-lg-5 col-md-4 p-0">
                                <div class="room-card-img">
                                    <a href="room-details.html">
                                        <img src="{{ asset('upload/roomimg/' . ($item->image ?? 'default.jpg')) }}" alt="Room Image">
                                    </a>
                                </div>
                            </div>

                            <div class="col-lg-7 col-md-8 p-0">
                                <div class="room-card-content">
                                    <h3>
                                        <a href="room-details.html">
                                            {{ $item->type ? $item->type->name : 'No Type' }}
                                        </a>
                                    </h3>
                                    <span>{{ $item->price ?? 'N/A' }} / Per Night</span>
                                    <div class="rating">
                                        <i class='bx bxs-star'></i>
                                        <i class='bx bxs-star'></i>
                                        <i class='bx bxs-star'></i>
                                        <i class='bx bxs-star'></i>
                                        <i class='bx bxs-star'></i>
                                    </div>
                                    <p>{{ $item->short_desc ?? 'No Description Available' }}</p>
                                    <ul>
                                        <li><i class='bx bx-user'></i> {{ $item->room_capacity ?? 'N/A' }} Person</li>
                                        <li><i class='bx bx-expand'></i> {{ $item->size ?? 'N/A' }} ft²</li>
                                    </ul>

                                    <ul>
                                        <li><i class='bx bx-show-alt'></i> {{ $item->view ?? 'N/A' }}</li>
                                        <li><i class='bx bxs-hotel'></i> {{ $item->bed_style ?? 'N/A' }}</li>
                                    </ul>

                                    <a href="room-details.html" class="book-more-btn">
                                        Book Now
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</div>
