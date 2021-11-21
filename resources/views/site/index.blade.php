@extends('base')

@section('main')

    {!! getLinks('col-intro-slider') !!}

    @include('site.blocks.sections.catalog')

    {!! getNews('poleznye-stati') !!}

    {!! getNews('col-product-preview', 'product-preview') !!}

    @include('site.blocks.sections.feedback')

    {!! getNews('nashi-raboty') !!}

    {!! getNews('otzyvy-o-produkcii') !!}

    @include('site.blocks.sections.contacts')

@endsection
