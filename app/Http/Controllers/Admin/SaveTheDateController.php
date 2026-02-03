<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\SaveTheDate;
use Illuminate\Http\Request;

class SaveTheDateController extends Controller
{
    public function index()
    {
        $saveTheDates = SaveTheDate::query()
            ->with(['article.category'])
            ->orderBy('order')
            ->orderByDesc('created_at')
            ->paginate(20)
            ->withQueryString();

        return view('admin.articles.save-the-date', [
            'saveTheDates' => $saveTheDates,
        ]);
    }

    public function create()
    {
        $articles = BlogPost::query()
            ->with(['category'])
            ->orderByDesc('created_at')
            ->get();

        return view('admin.articles.save-the-date-create', [
            'articles' => $articles,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'article_id' => ['required', 'integer', 'exists:blog_posts,id', 'unique:save_the_dates,article_id'],
            'order' => ['nullable', 'integer', 'min:1', 'max:8'],
        ]);

        if (empty($data['order'])) {
            $data['order'] = (int) (SaveTheDate::query()->max('order') ?? 0) + 1;
        }

        SaveTheDate::create($data);

        return redirect()->route('admin.save-the-date.index')->with('success', 'Article ajouté à Save The Date.');
    }

    public function destroy(SaveTheDate $saveTheDate)
    {
        $saveTheDate->delete();

        return redirect()->route('admin.save-the-date.index')->with('success', 'Article retiré de Save The Date.');
    }
}
