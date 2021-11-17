<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    /**
     * @return array
     */
    public function getCategory(): array
    {
        return DB::table('category')->get()->all();
    }

    /**
     * @param string $categoryName
     * @return string
     */
    public function getCategorySlug(string $categoryName): string
    {
        return DB::table('category')->where('category', $categoryName)->first()->slug;
    }
}
