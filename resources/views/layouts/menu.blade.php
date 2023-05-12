@php
    use App\Http\Controllers\ArticleController;
    $url = action([ArticleController::class, 'index']);
@endphp
<div class="menu"><a href="{{ $url }}">Статьи</a></div>
