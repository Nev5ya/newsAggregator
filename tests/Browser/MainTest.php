<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Throwable;

class MainTest extends DuskTestCase
{
    /**
     * Checking the availability of all menu links
     *
     * @return void
     * @throws Throwable
     */
    public function testMenuButtons()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertTitleContains('Главная')
                ->assertSee('Агрегатор новостей')
                ->clickLink('Войти')
                ->assertUrlIs('*/auth')
                ->assertTitle('Авторизация')
                ->clickLink('Напишите нам')
                ->assertUrlIs('*/contact')
                ->assertTitle('Контакты')
                ->clickLink('Админка')
                ->assertUrlIs('*/admin/news')
                ->assertTitleContains('Админка')
                ->assertSee('Список новостей');
        });
    }

    /**
     * @throws Throwable
     */
    public function testAddingNews()
    {
        $this->browse(function (Browser $browser) {
           $browser->visitRoute('admin.news.create')
               ->assertSee('Добавить новость')
               ->type('title', 'Testing title field')
               ->type('author', 'Testing author field')
               ->select('category_id')
               ->type('description', 'Testing description field')
               ->attach('image', __DIR__ . '/files/test.jpg')
               ->press('@addNews');
        });
    }

    /**
     * @throws Throwable
     */
    public function testValidationNews()
    {
        $this->browse(function (Browser $browser) {
            $browser->visitRoute('admin.news.create')
                ->type('title', '42')
                ->type('author', '42')
                ->type('description', '42')
                ->attach('image', __DIR__ . '/files/test1.jar')
                ->press('@addNews')
                ->assertSee('Количество символов в поле заголовок должно быть не меньше 3')
                ->assertSee('Количество символов в поле автор должно быть не меньше 4')
                ->assertSee('Количество символов в поле описание должно быть не меньше 10')
                ->assertSee('Поле изображение должно быть файлом одного из следующих типов: jpeg, png, bmp, jpg');
        });
    }

    /**
     * @throws Throwable
     */
    public function testAddingCategory()
    {
        $this->browse(function (Browser $browser) {
            $browser->visitRoute('admin.category.create')
                ->type('category', 'Testing Category')
                ->type('slug', 'Тестовая категория')
                ->press('@addCategory')
                ->assertSee('Категория добавлена!');
        });
    }

    /**
     * @throws Throwable
     */
    public function testValidateCategories()
    {
        $this->browse(function (Browser $browser) {
            $browser->visitRoute('admin.category.create')
                ->type('category', '42')
                ->type('slug', '42')
                ->press('@addCategory')
                ->assertSee('Количество символов в поле название категории должно быть не меньше 3')
                ->assertSee('Количество символов в поле slug категории должно быть не меньше 3');
        });
    }
}
