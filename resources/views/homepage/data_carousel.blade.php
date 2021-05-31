<div class="row mt-5">
    <div class="col-10 offset-1 ">
        <h1><span class="badge bg-stars">{{ $resourceName }}</span></h1>
    </div>
</div>

<div class="row position-relative">
    <div class="col-1">
        @if(count($data) > 1)
            <button class="carousel-control-prev" type="button" data-bs-target="#{{ $resourceName }}-carousel"
                    data-bs-slide="prev">
                <span class="carousel-control-prev-icon bg-dark" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
        @endif
    </div>

    <div class="col-10">
        <div id="{{ $resourceName }}-carousel" class="carousel slide carousel-dark" data-bs-ride="carousel" data-bs-interval="false">
            <div class="carousel-inner">
                @foreach($data as $key => $dataset)
                    <div class="carousel-item {{ $key === 0 ? 'active' : null }}">
                        <div class="row text-center">
                            @foreach ($dataset as $item)
                                <div class="col-md-2">
                                    <div class="card h-100 bg-stars">
                                        <img alt="{{ $item[$titleKey] . ' Image' }}" class="card-img-top carousel-card" src="{{ $item['image'] }}" />
                                        <div class="card-footer text-white">
                                            <h3>{{ $item[$titleKey] }}</h3>
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
        @if(count($data) > 1)
            <button class="carousel-control-next" type="button" data-bs-target="#{{ $resourceName }}-carousel"
                    data-bs-slide="next">
                <span class="carousel-control-next-icon  bg-dark" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        @endif
    </div>
</div>
