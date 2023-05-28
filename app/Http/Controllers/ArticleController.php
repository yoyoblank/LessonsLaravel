<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticlePostRequest;
use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::paginate();
        return view('article.index', compact('articles'));
    }
    public function show($id)
    {
        $article = Article::findOrFail($id);
        return view('article.show', compact('article'));
    }
    public function create()
    {
        // Передаем в шаблон вновь созданный объект. Он нужен для вывода формы через Form::model
        $article = new Article();
        return view('article.create', compact('article'));
    }
    public function store(ArticlePostRequest $request)
    {
        // Проверка введенных данных
        // Если будут ошибки, то возникнет исключение
        // Иначе возвращаются данные формы
        $validated = $request->validated();

        // Retrieve a portion of the validated input data...
        $validated = $request->safe()->only(['name', 'body']);

        $article = new Article();
        // Заполнение статьи данными из формы
        $article->fill($validated);
        // При ошибках сохранения возникнет исключение
        $article->save();

        // Редирект на указанный маршрут
        return redirect()
            ->route('articles.index');
    }
    public function edit($id)
    {
        $article = Article::findOrFail($id);
        return view('article.edit', compact('article'));
    }
    public function update(ArticlePostRequest $request, $id)
    {
        $article = Article::findOrFail($id);
        $validated = $request->validated();

        // Retrieve a portion of the validated input data...
        $validated = $request->safe()->only(['name', 'body']);

        $article->fill($validated);
        $article->save();
        return redirect()
            ->route('articles.index');
    }
    public function destroy($id)
    {
        // DELETE — идемпотентный метод, поэтому результат операции всегда один и тот же
        $article = Article::find($id);
        if ($article) {
            $article->delete();
        }
        return redirect()->route('articles.index');
    }
}
