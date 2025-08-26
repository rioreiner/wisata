@extends('layouts.app')

@section('content')
<div class="container-fluid p-0">

    <!-- Hero Section -->
    <section class="hero-section d-flex align-items-center justify-content-center text-center text-white">
        <div class="overlay"></div>
        <div class="content px-4">
            <h1 class="display-3 fw-bold mb-3 animate-fade-in">
                Wonderful <span class="text-warning">Kei</span>
            </h1>
            <p class="lead mb-4 animate-fade-in-delay">
                It's the perfect time to travel and enjoy the beauty of kei
            </p>
            <a class="btn btn-lg btn-gradient shadow-lg px-5 py-3 animate-fade-in-delay2" 
               href="{{ route('destinations.index') }}" role="button">
                Explore Now!
            </a>
        </div>
    </section>

    <div class="container mt-5">

        <!-- Top Destinations -->
        <div class="row">
            <div class="col-12 mb-4 text-center">
                <h2 class="mb-4 fw-bold section-title">🌍 Tempat Populer</h2>
            </div>
            <div class="row">
                @forelse($destinations as $destination)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 modern-card">
                            @if($destination->image)
                                <img src="{{ asset('storage/' . $destination->image) }}" 
                                     class="card-img-top" 
                                     alt="{{ $destination->name }}">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title fw-bold text-dark">{{ $destination->name }}</h5>
                                <p class="card-text text-muted">{{ Str::limit($destination->description, 100) }}</p>
                                <p class="text-muted mb-2">
                                    <i class="fas fa-map-marker-alt text-danger"></i> {{ $destination->location }}
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-primary fw-bold fs-6">Rp {{ number_format($destination->price, 0, ',', '.') }}</span>
                                    <div class="text-warning">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star{{ $i <= $destination->rating ? '' : '-o' }}"></i>
                                        @endfor
                                        <small>({{ $destination->rating }})</small>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer bg-white border-0">
                                <a href="{{ route('destinations.show', $destination->slug) }}" class="btn btn-primary btn-sm w-100">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-center text-muted">No destinations available</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Latest News -->
        <div class="row mt-5">
            <div class="col-12 text-center">
                <h2 class="mb-4 fw-bold section-title">📰 Berita Terbaru</h2>
            </div>
            <div class="row">
                @forelse($news as $article)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 modern-card">
                            @if($article->image)
                                <img src="{{ asset('storage/' . $article->image) }}" 
                                     class="card-img-top" 
                                     alt="{{ $article->title }}">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title fw-bold text-dark">{{ $article->title }}</h5>
                                <p class="card-text text-muted">{{ $article->excerpt }}</p>
                                <small class="text-muted">✍️ {{ $article->author->name }} | {{ $article->created_at->format('M d, Y') }}</small>
                            </div>
                            <div class="card-footer bg-white border-0">
                                <a href="{{ route('news.show', $article->slug) }}" class="btn btn-outline-primary btn-sm w-100">
                                    Read More
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-center text-muted">No news available</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer mt-5">
        <div class="container d-flex flex-wrap justify-content-between">
            <div class="mb-4">
                <div class="logo fw-bold fs-4">R-<span class="text-warning">Wisata</span></div>
                <p class="text-">Our vision is to help people find the best places to travel with high security.</p>
            </div>
            <div>
                <h5 class="fw-bold">About</h5>
                <ul class="list-unstyled">
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Features</a></li>
                    <li><a href="#">News & Blog</a></li>
                </ul>
            </div>
            <div>
                <h5 class="fw-bold">Company</h5>
                <ul class="list-unstyled">
                    <li><a href="#">How We Work?</a></li>
                    <li><a href="#">Capital</a></li>
                    <li><a href="#">Security</a></li>
                </ul>
            </div>
            <div>
                <h5 class="fw-bold">Support</h5>
                <ul class="list-unstyled">
                    <li><a href="#">FAQs</a></li>
                    <li><a href="#">Support Center</a></li>
                    <li><a href="#">Contact Us</a></li>
                </ul>
            </div>
        </div>
    </footer>
</div>

{{-- Custom CSS --}}
<style>
    /* Hero Section */
    .hero-section {
        position: relative;
        height: 100vh;
        background: url('https://images.unsplash.com/photo-1507525428034-b723cf961d3e?ixlib=rb-4.0.3&auto=format&fit=crop&w=1650&q=80') center/cover no-repeat;
    }
    .hero-section .overlay {
        position: absolute;
        inset: 0;
        background: rgba(0, 57, 115, 0.6);
    }
    .hero-section .content {
        position: relative;
        z-index: 2;
        max-width: 800px;
    }

    /* Gradient Button */
    .btn-gradient {
        background: linear-gradient(90deg, #4f46e5, #3b82f6);
        color: #fff;
        border: none;
        border-radius: 10px;
        transition: 0.3s;
    }
    .btn-gradient:hover {
        opacity: 0.9;
        transform: translateY(-3px);
    }

    /* Animations */
    .animate-fade-in {
        opacity: 0;
        transform: translateY(20px);
        animation: fadeIn 1s forwards;
    }
    .animate-fade-in-delay {
        opacity: 0;
        transform: translateY(20px);
        animation: fadeIn 1s forwards 0.5s;
    }
    .animate-fade-in-delay2 {
        opacity: 0;
        transform: translateY(20px);
        animation: fadeIn 1s forwards 1s;
    }
    @keyframes fadeIn {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Section Title */
    .section-title {
        font-size: 32px;
        font-weight: 700;
        color: #1e3a8a;
    }

    /* Modern Card */
    .modern-card {
        border-radius: 1rem;
        overflow: hidden;
        transition: all 0.3s ease-in-out;
        box-shadow: 0 6px 18px rgba(0,0,0,0.1);
    }
    .modern-card img {
        height: 220px;
        object-fit: cover;
    }
    .modern-card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    }
    .modern-card:hover img {
        transform: scale(1.05);
        transition: transform 0.4s ease;
    }

    /* Footer */
    /* Footer dengan background gambar */
.footer {
    position: relative;
    background: url('https://images.unsplash.com/photo-1507525428034-b723cf961d3e?ixlib=rb-4.0.3&auto=format&fit=crop&w=1650&q=80') center/cover no-repeat;
    padding: 60px 20px;
    color: #fff;
    border-radius: 20px 20px 0 0;
    overflow: hidden;
}

/* Overlay gelap transparan */
.footer::before {
    content: "";
    position: absolute;
    inset: 0;
    background: rgba(0, 0, 0, 0.6); /* bisa diganti ke biru tua kalau mau */
    z-index: 1;
}

/* Konten footer di atas overlay */
.footer .container {
    position: relative;
    z-index: 2;
}

/* Link */
.footer a {
    text-decoration: none;
    color: #f1f5f9;
    font-size: 14px;
    transition: 0.3s;
}
.footer a:hover {
    color: #facc15;
}

</style>
@endsection
