<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CategoryTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/laravel.loc/admin/category')
                ->type('category_name', 'testing')
                ->press('Изменить')
                ->assertPathIs('/laravel.loc/admin/category');
        });    }
}
