<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @method static find(int $id)
 */
class News extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'category_id', 'description', 'author', 'image'];

    public string $pathToImage = '/assets/image/default.jpg';

    public string $pathToTemp = '/app/public/temp/';

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @param string $categoryName
     * @return Model
     */
    public function getCurrentCategoryByName(string $categoryName): Model
    {
       return Category::query()->where('category', $categoryName)->first();
    }

    /**
     * @param string $categoryName
     * @return Collection
     */
    public function getNewsByCategory(string $categoryName): Collection
    {
        $categoryId = $this->getCurrentCategoryByName($categoryName)->getAttributes()['id'];
        return News::query()->where('category_id', $categoryId)->get();
    }

    /**
     * @param $id
     * @return Collection
     */
    public function getNewsById($id): Collection
    {
        return News::query()->where('category_id', $id)->get();
    }

    public function handleImage($image): string
    {
        return substr(
            $image->move(public_path() . '/assets/image/',
                $image . '.' . $image->getClientOriginalExtension()
            )->getRealPath(), 43);
    }

    /**
     * @param string $category Category name
     * @return Collection Selected news
     */

    public function getNewsForDownload(string $category): Collection
    {
        if ($category === 'all') {
            return News::all();
        }

        return $this->getNewsByCategory($category);
    }

}
