@extends('layouts.main')

@section('content')

    <div class="row position-relative mt-5">
        <div class="col-1">
            @if(count($groupedFilms) > 1)
                <button class="carousel-control-prev" type="button" data-bs-target="#film-carousel"
                        data-bs-slide="prev">
                    <span class="carousel-control-prev-icon bg-dark" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
            @endif
        </div>

        <div class="col-10">
            <div id="film-carousel" class="carousel slide carousel-dark" data-bs-ride="carousel" data-bs-interval="false">
                <div class="carousel-inner">
                    @foreach($groupedFilms as $key => $filmSet)
                        <div class="carousel-item {{ $key === 0 ? 'active' : null }}">
                            <div class="row text-center">
                                @foreach ($filmSet as $film)
                                    <div class="col-md-2">
                                        <div class="card h-100 bg-stars">
                                            <img alt="{{ $film['title'] . ' Image' }}" class="card-img-top film-card" src="{{ $film['image'] }}" />
                                            <div class="card-footer text-white">
                                                <h3>{{ $film['title'] }}</h3>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>

        <div class="col-1">
            @if(count($groupedFilms) > 1)
                <button class="carousel-control-next" type="button" data-bs-target="#film-carousel"
                        data-bs-slide="next">
                    <span class="carousel-control-next-icon  bg-dark" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            @endif
        </div>
    </div>

    <div class="row bg-stars mt-5 py-2">
        <div class="col-12 text-white text-center">
            <h1>Films</h1>
        </div>
    </div>


@endsection
