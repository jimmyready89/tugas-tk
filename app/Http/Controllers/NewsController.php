<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Comment;
use App\Models\User;
use App\Models\CompanyProfile;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    public function home()
    {
        $latestNews = News::latest()->take(7)->get();
        $totalNews = News::count();
        $totalComments = Comment::where('is_visible', true)->count();
        $totalUsers = User::count();
        $companyProfile = CompanyProfile::first();

        return view('home', compact(
            'latestNews',
            'totalNews',
            'totalComments',
            'totalUsers',
            'companyProfile'
        ));
    }

    public function index(Request $request)
    {
        $query = News::latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('body', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category')) {
            $query->where('news_tag', 'like', "%{$request->category}%");
        }

        $news = $query->paginate(12);

        return view('news.index', compact('news'));
    }

    public function show($news_id)
    {
        $news = News::findOrFail($news_id);
        $comments = Comment::where('news_id', $news_id)
            ->where('is_visible', true)
            ->latest()
            ->get();

        return view('news.show', compact('news', 'comments'));
    }

    public function create()
    {
        return view('news.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'news_tag' => 'required|string|max:255|unique:news,news_tag',
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'author_nip' => 'required|string|exists:users,nip',
        ]);

        $news = News::create([
            'news_tag' => $request->news_tag,
            'title' => $request->title,
            'body' => $request->body,
            'author_nip' => $request->author_nip,
        ]);

        return redirect()->route('news.show', $news->news_id)
            ->with('success', 'Berita berhasil dipublikasikan!');
    }

    /**
     * Show the form for editing the specified news.
     */
    public function edit($news_id)
    {
        $news = News::findOrFail($news_id);

        // Check if user is author or admin
        if (auth()->user()->nip !== $news->author_nip && auth()->user()->role !== 'admin') {
            abort(403, 'Anda tidak memiliki izin untuk mengedit berita ini.');
        }

        return view('news.edit', compact('news'));
    }

    /**
     * Update the specified news in storage.
     */
    public function update(Request $request, $news_id)
    {
        $news = News::findOrFail($news_id);

        // Check if user is author or admin
        if (auth()->user()->nip !== $news->author_nip && auth()->user()->role !== 'admin') {
            abort(403, 'Anda tidak memiliki izin untuk mengedit berita ini.');
        }

        $request->validate([
            'news_tag' => 'required|string|max:255|unique:news,news_tag,' . $news_id . ',news_id',
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $news->update([
            'news_tag' => $request->news_tag,
            'title' => $request->title,
            'body' => $request->body,
        ]);

        return redirect()->route('news.show', $news->news_id)
            ->with('success', 'Berita berhasil diperbarui!');
    }

    /**
     * Remove the specified news from storage.
     */
    public function destroy($news_id)
    {
        $news = News::findOrFail($news_id);

        // Check if user is author or admin
        if (auth()->user()->nip !== $news->author_nip && auth()->user()->role !== 'admin') {
            abort(403, 'Anda tidak memiliki izin untuk menghapus berita ini.');
        }

        $news->delete();

        return redirect()->route('news.index')
            ->with('success', 'Berita berhasil dihapus!');
    }

    public function search(Request $request)
    {
        $query = $request->get('q');

        $news = News::where('title', 'like', "%{$query}%")
            ->orWhere('body', 'like', "%{$query}%")
            ->orWhere('news_tag', 'like', "%{$query}%")
            ->latest()
            ->take(10)
            ->get(['news_id', 'title', 'news_tag', 'created_at']);

        return response()->json($news);
    }
}
