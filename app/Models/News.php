<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class News extends Model
{
    use HasFactory;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'news_id';

    protected $fillable = [
        'news_tag',
        'title',
        'body',
        'author_nip',
    ];

    // Methods per interface
    /**
     * Get a single news by news_id or tag
     */
    public static function getNews(mixed $idOrTag)
    {
        if (is_numeric($idOrTag)) {
            return self::find($idOrTag); // Find by news_id
        }
        return self::where('news_tag', $idOrTag)->first(); // Find by news_tag
    }

    /**
     * Get all news
     */
    public static function getAllNews()
    {
        return self::query()->get();
    }

    /**
     * Create news
     */
    public static function createNews(array $data): self
    {
        return self::create($data);
    }

    /**
     * Delete news
     */
    public function deleteNews(): ?bool
    {
        return $this->delete();
    }
}
