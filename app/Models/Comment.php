<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'comment_id';

    protected $fillable = [
        'comment_tag',
        'news_id', // Reference to news by news_id
        'news_tag', // Keep for backward compatibility
        'comment',
        'comment_by',
        'is_visible',
    ];

    /**
     * Get comments for a news by news_id or news_tag
     */
    public static function getCommentNews(mixed $newsIdentifier)
    {
        if (is_numeric($newsIdentifier)) {
            // Search by news_id
            return self::where('news_id', $newsIdentifier)->where('is_visible', true)->get();
        }
        // Search by news_tag for backward compatibility
        return self::where('news_tag', $newsIdentifier)->where('is_visible', true)->get();
    }

    /**
     * Create a comment
     */
    public static function createComment(array $data): self
    {
        return self::create($data);
    }

    /**
     * Hide a comment
     */
    public function hideComment(): bool
    {
        $this->is_visible = false;
        return $this->save();
    }

    /**
     * Edit own comment (ensure caller checks ownership)
     */
    public function editOwnComment(array $data): bool
    {
        return $this->update($data);
    }
}
