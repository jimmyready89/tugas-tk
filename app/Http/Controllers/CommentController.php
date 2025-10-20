<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\News;
use Illuminate\Support\Str;

class CommentController extends Controller
{
    /**
     * Store a newly created comment in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'news_id' => 'required|exists:news,news_id',
            'comment' => 'required|string|max:1000',
        ]);

        // Generate unique comment_tag
        $commentTag = 'comment-' . time() . '-' . Str::random(6);

        $comment = Comment::create([
            'comment_tag' => $commentTag,
            'news_id' => $request->news_id,
            'news_tag' => News::find($request->news_id)->news_tag ?? '', // Backward compatibility
            'comment' => $request->comment,
            'comment_by' => auth()->user()->nip,
            'is_visible' => true,
        ]);

        return redirect()->back()->with('success', 'Komentar berhasil ditambahkan!');
    }

    /**
     * Update the specified comment in storage.
     */
    public function update(Request $request, $comment_id)
    {
        $comment = Comment::findOrFail($comment_id);
        
        // Check if user is comment owner or admin
        if (auth()->user()->nip !== $comment->comment_by && auth()->user()->role !== 'admin') {
            abort(403, 'Anda tidak memiliki izin untuk mengedit komentar ini.');
        }
        
        $request->validate([
            'comment' => 'required|string|max:1000',
        ]);

        $comment->update([
            'comment' => $request->comment,
        ]);

        return redirect()->back()->with('success', 'Komentar berhasil diperbarui!');
    }

    /**
     * Hide the specified comment (soft delete).
     */
    public function hide($comment_id)
    {
        $comment = Comment::findOrFail($comment_id);
        
        // Check if user is comment owner or admin
        if (auth()->user()->nip !== $comment->comment_by && auth()->user()->role !== 'admin') {
            abort(403, 'Anda tidak memiliki izin untuk menghapus komentar ini.');
        }
        
        $comment->update(['is_visible' => false]);
        
        return redirect()->back()->with('success', 'Komentar berhasil disembunyikan!');
    }

    /**
     * Remove the specified comment from storage.
     */
    public function destroy($comment_id)
    {
        $comment = Comment::findOrFail($comment_id);
        
        // Check if user is comment owner or admin
        if (auth()->user()->nip !== $comment->comment_by && auth()->user()->role !== 'admin') {
            abort(403, 'Anda tidak memiliki izin untuk menghapus komentar ini.');
        }
        
        $comment->delete();
        
        return redirect()->back()->with('success', 'Komentar berhasil dihapus!');
    }

    /**
     * Get comments by news ID (API endpoint).
     */
    public function getByNews($news_id)
    {
        $comments = Comment::where('news_id', $news_id)
                          ->where('is_visible', true)
                          ->latest()
                          ->get();
        
        return response()->json($comments);
    }

    /**
     * Toggle comment visibility (API endpoint).
     */
    public function toggleVisibility($comment_id)
    {
        $comment = Comment::findOrFail($comment_id);
        
        // Check if user is admin
        if (auth()->user()->role !== 'admin') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        
        $comment->update(['is_visible' => !$comment->is_visible]);
        
        return response()->json([
            'success' => true,
            'is_visible' => $comment->is_visible,
            'message' => $comment->is_visible ? 'Komentar ditampilkan' : 'Komentar disembunyikan'
        ]);
    }
}
