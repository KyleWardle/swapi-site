@extends('layouts.main')

@section('content')

    @include('homepage.data_carousel', [
        'data' => $groupedFilms,
        'resourceName' => 'Films',
        'titleKey' => 'title'
    ])

    <div class="row bg-stars mt-5 py-4"></div>

    @include('homepage.data_carousel', [
        'data' => $groupedPeople,
        'resourceName' => 'Characters',
        'titleKey' => 'name'
    ])


    <div class="mb-5"></div>

@endsection
