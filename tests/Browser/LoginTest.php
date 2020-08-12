<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testLoginAdmin()
    {
        $this->browse(function (Browser $browser) {
            // 管理者としてログインしてログアウトするまで
            $browser->visit('/login_admin')
                    ->type('email', 'masaakisaeki@gmail.com')
                    ->type('password', 'hogehoge')
                    ->press('ログイン')
                    ->assertPathIs('/home_admin')
                    ->clickLink('admin')
                    ->clickLink('ログアウト')
                    ->assertPathIs('/p');
        });
    }

    public function testLoginShop()
    {
        $this->browse(function (Browser $browser) {
            // 店舗ユーザーとしてログインしてログアウトするまで
            $browser->visit('/login_shop')
                    ->type('email', 'masaakisaeki2@gmail.com')
                    ->type('password', 'hogehoge')
                    ->press('ログイン')
                    ->assertPathIs('/home_shop')
                    ->clickLink('店舗ユーザー')
                    ->clickLink('ログアウト')
                    ->assertPathIs('/p');
        });
    }
}
