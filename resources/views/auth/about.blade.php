@extends('layouts.app')

@section('content')
<div class="container px-4 py-1" id="featured-3">
    <h2 class="pb-2 border-bottom text">Kenapa Affiliate UNITI?</h2>
    <div class="row g-4 py-3 row-cols-1 row-cols-lg-3">
        <div class="feature col">
            <h3 class="fs-2 text-body-emphasis">Lorem ipsum dolor.</h3>
            <p class="fs-6">sit amet consectetur adipisicing elit. Expedita doloribus, consequatur ullam quia sint provident, illo dolorum molestias quasi veniam facilis recusandae.</p>
        </div>
        <div class="feature col">
            <h3 class="fs-2 text-body-emphasis">Lorem ipsum dolor.</h3>
            <p class="fs-6">sit amet consectetur adipisicing elit. Expedita doloribus, consequatur ullam quia sint provident.</p>
        </div>
        <div class="feature col">
            <h3 class="fs-2 text-body-emphasis">Lorem ipsum dolor.</h3>
            <p class="fs-6">sit amet consectetur adipisicing elit. Expedita doloribus, consequatur ullam quia sint provident, illo dolorum molestias quasi veniam facilis recusandae.</p>
        </div>
    </div>
    <div class="row g-4 py-1 row-cols-1 row-cols-lg-3">
        <div class="feature col">
            <h3 class="fs-2 text-body-emphasis">Lorem ipsum dolor.</h3>
            <p class="fs-6">sit amet consectetur adipisicing elit. Expedita doloribus, consequatur ullam quia sint provident, illo dolorum molestias quasi veniam facilis recusandae.</p>
        </div>
        <div class="feature col">
            <h3 class="fs-2 text-body-emphasis">Lorem ipsum dolor.</h3>
            <p class="fs-6">sit amet consectetur adipisicing elit. Expedita doloribus, consequatur ullam quia sint provident, illo dolorum molestias quasi veniam facilis recusandae.</p>
        </div>
        <div class="feature col">
            <h3 class="fs-2 text-body-emphasis">Lorem ipsum dolor.</h3>
            <p class="fs-6">sit amet consectetur adipisicing elit. Expedita doloribus, consequatur ullam quia sint provident.</p>
        </div>
    </div>
    <div class="row g-4 py-1 row-cols-1 mt-1">
        <div class="feature col text-center">
            <p class="fs-6">Adakah anda berminat untuk menjadi Affiliate UNITI?</p>
            <a href="{{ route('register') }}" class="btn btn-danger">Daftar Sekarang</a>
        </div>
    </div>
</div>
@endsection
