<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{{ $pageTitle }}</title>
<meta name="title" content="{{ $metaTitle }}">
<meta name="description" content="{{ $metaDesc }}">
<meta name="keywords" content="{{ $metaKey }}">
@if (isset($metaOGTitle) && $metaOGTitle != '')
    <meta property="og:title" content="{{ $metaOGTitle }}">
    <meta property="og:description" content="{{ $metaOGDesc }}">
    <meta property="og:image" content="{{ $metaOGImage }}">
    <meta property="og:url" content="{{ $metaOGUrl }}">
    <meta property="og:site_name" content="Watch Anime Online AnimeCenter.TV">
@endif
@if (isset($episode['title']) && $episode['not_yet_aired'] == '')
    <meta name="medium" content="video">
    <meta name="video_type" content="application/x-shockwave-flash">
    <meta name="video_height" content="370">
    <meta name="video_width" content="650">
    <meta name="language" content="en-us">
@endif
<meta name="sth-site-verification" content="bf6527dae5e1867e7d5b65f8c47eb99c">
<meta name="google-site-verification" content="5cikZ3O5_LPFgVIEN_S0EHXxFbnjG62VdpcYQZ1c3hk">
<link rel="icon" href="{{ asset('favicon.ico') }}">
<link href="{{ asset('css/app.css') }}" rel="stylesheet">