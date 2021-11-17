<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use JetBrains\PhpStorm\ArrayShape;

class News extends Model
{
    use HasFactory;

    private Category $category;

    private string $pathToImage = '/assets/image/default.jpg';

    public string $pathToTemp = '/app/public/temp/';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->category = new Category();
    }

    /**
     * Get all list of news
     * @return array
     */
    public function getNews(): array
    {
        return DB::table('news')->get()->all();
    }

    /**
     * @param string $categoryName
     * @return array
     */
    public function getNewsByCategory(string $categoryName): array
    {
        return DB::table('news')->where('category_name', $categoryName)->get()->all();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getNewsById($id): mixed
    {
        foreach ($this->getNews() as $news) {
            if ($news->id === $id) {
                return $news;
            }
        }
        return '';
    }

    /**
     * @param array $news takes created news data
     * @return int news ID
     */
    public function createNews(array $news): int
    {
        $category = (new Category())->getCategory();
        $news['category_name'] = $category[$news['category_id']]->slug;

        $news['image'] = $this->pathToImage;

        if (request()->file('image')) {
            $news['image'] = $this->handleImage(request()->file('image'));
        }

        return DB::table('news')->insertGetId($news);
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
     * @return array Selected news
     */

    public function getNewsForDownload(string $category): array
    {
        if ($category === 'all') {
            return $this->getNews();
        }

        return $this->getNewsByCategory($category);
    }
}
