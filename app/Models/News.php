<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class News extends Model
{
    use HasFactory;

    private Category $category;

    private string $pathToJsonFile = '/app/public/newsJSON/news.json';

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
        return json_decode(File::get(storage_path() . $this->pathToJsonFile), true);
    }

    /**
     * @param string $categoryName
     * @return array
     */
    public function getNewsByCategory(string $categoryName): array
    {
        $news = $this->getNews();

        $categoryId = $this->category->getCategoryIdByName($categoryName);

        return array_filter($news , function ($item) use ($categoryId) {
            return $item['category_id'] === $categoryId;
        }, ARRAY_FILTER_USE_BOTH);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getNewsById($id): mixed
    {
        foreach ($this->getNews() as $news) {
            if ($news['id'] === $id) {
                return $news;
            }
        }
        return '';
    }

    /**
     * @param array $news takes created news data
     * @return int news ID's
     */
    public function createNews(array $news): int
    {
        $tempArray = $this->getNews();
        $news['id'] = rand(0, 1000);
        $news['created_at'] = date(now());
        array_push($tempArray, $news);
        $jsonData = json_encode($tempArray, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        File::put(storage_path() . $this->pathToJsonFile, $jsonData);
        return $news['id'];
    }

    /**
     * @param string $category Category name
     * @return string Path to created file
     */
    public function createNewsForDownload(string $category): string
    {
        $tempPath = storage_path() . $this->pathToTemp . $category . '.json';
        $data = json_encode(
            $this->getNewsByCategory($category),
            JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
        );

        File::put($tempPath, $data);
        return $tempPath;
    }
}
