<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <meta name="google" content="notranslate">
    <meta name="description" content="{{ strip_tags($settings['description']) }}">
    <meta name="author" content="">
    <meta name="keyword" content="{{ strip_tags($settings['keywords']) }}">
    <meta name="_token" content="{{ csrf_token() }}">
    @php
        $sectionTitle = '';

        if (isset($section)) {
            if ($section->type == 'news') {
                if (isset($data)) {
                    $sectionTitle .= $data->title . ' | ';
                }
            }
            $sectionTitle .= $section->name . ' | ';
        }
    @endphp
    <title>{{ $sectionTitle . strip_tags($settings['title']) }}</title>

    @include('site.blocks.base.favicon')
    @include('site.blocks.base.open-graph')
    @include('site.blocks.base.styles')

    <!-- Scripts -->
    <script>
        window.site = {
            locale: '{{ app()->getLocale() }}'
        }
    </script>

    @include('site.blocks.base.statistics')
</head>

@php
    $bodyClass = '';
    $bodyClass = trim($bodyClass);
@endphp

<body @if($bodyClass) class="{{ $bodyClass }}" @endif>
