<div class="card border-0 shadow rounded-30">
    <div class="card-body my-3">
        <h3 class="text-teal fw-bold">{{ auth()->user()->name }}</h3>
        <p>
            ID: {{ auth()->user()->id }} <br>
            Balance: Rp {{ number_format(auth()->user()->balance) }}</p>
        <hr>
        <ul class="list-unstyled sidebar-style">
            <li>
                <a href="{{ route('dashboard') }}"><i class="fas fa-home me-2"></i>Main Dashboard</a>
            </li>
            <li>
                <a href="{{ route('profile') }}">
                    <i class="fas fa-user me-2"></i>Profile</a>
            </li>
            <li>
                <a href="{{ route('home') }}"><i class="fas fa-ticket-alt me-2" aria-hidden="true"></i>Create New
                    Booking</a>
            </li>
            @if (auth()->user()->role == 'ADMIN')
                <li>
                    <a href="{{ route('admin') }}">
                        <i class="fas fa-people-arrows me-2"></i>Payment Confirmation</a>
                </li>
            @elseif (auth()->user()->role == 'OTA')
                <li>
                    <a href="{{ route('chat-consultations.ota') }}">
                        <i class="fas fa-people-arrows me-2"></i>Your Consultations</a>
                </li>
                <li>
                    <a href="{{ route('recommendations.index') }}">
                        <i class="fas fa-star me-2"></i>Recommendations</a>
                </li>
            @else
                <li>
                    <a href="{{ route('bookings.index') }}">
                        <i class="fas fa-ticket-alt me-2" aria-hidden="true"></i>My
                        Bookings</a>
                </li>
                <li>
                    <a href="{{ route('checkouts.index') }}">
                        <i class="fas fa-shopping-cart me-2" aria-hidden="true"></i>My Checkouts</a>
                </li>
                <li>
                    <a href="{{ route('consultations.index') }}">
                        <i class="fas fa-people-arrows me-2"></i>
                        Select Travel Agent Consultant</a>
                </li>
                <li>
                    <a href="{{ route('chat-consultations.index') }}"><i class="fas fa-people-arrows me-2"></i>Your
                        Consultations</a>
                </li>
            @endif
        </ul>
    </div>
</div>
