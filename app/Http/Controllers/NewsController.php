<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        $searchingCategory = $request['categories'] ?? ' ';
        $statusSearch = $searchingCategory == ' ' ? 'all' : 'notAll';

        if ($searchingCategory == ' ')
            $newss = News::paginate(5);
        else
            $newss = News::all();



        return view('news.index', compact('user', 'newss', 'searchingCategory', 'statusSearch'));
    }

    public function create()
    {
        $this->authorize('create', News::class);
        return view('news.form');
    }

    public function store(Request $request)
    {
        $this->authorize('create', News::class);
        $data = $this->validated($request);

        $news = auth()->user()->news();
        $newNews = $news->create($data);

        return redirect()->route('news.show', $newNews);
    }

    public function show(News $news)
    {
        $this->authorize('view', $news);
        $imgArr = explode(',', $news->img);
        return view('news.show', compact('news', 'imgArr'));
    }

    public function edit(News $news)
    {
        $this->authorize('update', $news);
        return view('news.form', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        $this->authorize('update', $news);
        $data = $this->validated($request, $news);
        $news->update($data);
        return redirect()->route('news.show', $news);
    }

    public function destroy(News $news)
    {
        $this->authorize('delete', $news);
        $news->delete();
        return redirect()->route('news.index');
    }

    protected function validated(Request $request, News $new = null) {
        $rules = [
            'title' => 'required|min:5|max:100|unique:news',
            'content' => 'nullable',
            'category_list' => 'required',
            'img' => 'nullable'
        ];

        if($new)
            $rules['title'] .= ',title,' . $new->id;

        return $request->validate($rules);
    }
}
