<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    // use DatabaseMigrations;

    // public function setUp(): void
    // {
    //     parent::setUp();
    //     $this->artisan('db:seed');
    // }

    /**
     * A Dusk test example.
     *
     * @return void
     */
    // public function testLoginAdmin()
    // {
    //     $this->browse(function (Browser $browser) {
    //         // 管理者としてログインしてログアウトするまで
    //         $browser->visit('/login_admin')
    //                 ->type('email', 'masaakisaeki@gmail.com')
    //                 ->type('password', 'hogehoge')
    //                 ->press('ログイン')
    //                 ->assertPathIs('/home_admin')
    //                 ->clickLink('admin')
    //                 ->clickLink('ログアウト')
    //                 ->assertPathIs('/p');
    //     });
    // }

    // public function testLoginShop()
    // {
    //     $this->browse(function (Browser $browser) {
    //         // 店舗ユーザーとしてログインしてログアウトするまで
    //         $browser->visit('/login_shop')
    //                 ->type('email', 'masaakisaeki2@gmail.com')
    //                 ->type('password', 'hogehoge')
    //                 ->press('ログイン')
    //                 ->assertPathIs('/home_shop')
    //                 ->clickLink('店舗ユーザー')
    //                 ->clickLink('ログアウト')
    //                 ->assertPathIs('/p');
    //     });
    // }

    // public function testLoginShopAndAddShopForNotPayingMember()
    // {
    //     $this->browse(function (Browser $browser) {
    //         // 店舗ユーザーとしてログインして店舗を新規登録するまで
    //         $browser->visit('/login_shop')
    //                 // 非課金ユーザー
    //                 ->type('email', 'masaakisaeki2@gmail.com')
    //                 ->type('password', 'hogehoge')
    //                 ->press('ログイン')
    //                 ->assertPathIs('/home_shop')
    //                 ->clickLink('店舗を新規登録する')
    //                 ->assertPathIs('/shops/create')
    //                 ->value('input[name="shop_name"]','佐伯整骨院')
    //                 ->select('prefecture', '北海道')
    //                 ->pause(1000)
    //                 ->select('district', '札幌市中央区')
    //                 ->type('location', '北島５－６－７')
    //                 ->type('phone_number', '090-123-4567')
    //                 ->press('登録する')
    //                 ->assertSee('佐伯整骨院')
    //                 ->assertSee('北海道札幌市中央区北島５－６－７')
    //                 ->assertSee('090-123-4567')
    //                 // 非課金ユーザーがその後、編集できないこと
    //                 ->clickLink('編集する')
    //                 ->assertSee('有料会員になれば以下の事が出来るようになります')
    //                 ->back()
    //                 // 非課金ユーザーがその後、ブログを書けないこと
    //                 ->clickLink('記事を書く')
    //                 ->assertSee('有料会員になれば以下の事が出来るようになります')
    //                 ->back()
    //                 // 非課金ユーザーがその後、口コミを書けないこと
    //                 ->value('textarea[name="word_of_mouth"]','テストの口コミをします')
    //                 ->press('.btn.btn-primary')
    //                 ->assertSee('有料会員になれば以下の事が出来るようになります')
    //                 // ログアウト
    //                 ->clickLink('店舗ユーザー')
    //                 ->clickLink('ログアウト')
    //                 ->assertPathIs('/p');
    //     });
    // }

    public function testLoginShopAndAddShopForPayingMember()
    {
        $this->browse(function (Browser $browser) {
            // 店舗ユーザーとしてログインして店舗を新規登録するまで
            $browser->visit('/login_shop')
                    // 課金ユーザー
                    ->type('email', 'masaakisaeki2-1@gmail.com')
                    ->type('password', 'hogehoge')
                    ->press('ログイン')
                    ->assertPathIs('/home_shop')
                    ->clickLink('店舗を新規登録する')
                    ->assertPathIs('/shops/create')
                    ->value('input[name="shop_name"]','佐伯整骨院')
                    ->select('prefecture', '北海道')
                    ->pause(1000)
                    ->select('district', '札幌市中央区')
                    ->type('location', '北島５－６－７')
                    ->type('phone_number', '090-123-4567')
                    ->press('登録する')
                    ->assertSee('佐伯整骨院')
                    ->assertSee('北海道札幌市中央区北島５－６－７')
                    ->assertSee('090-123-4567')
                    
                    // 課金ユーザーがその後、編集できること
                    ->clickLink('編集する')
                    ->value('textarea[name="description"]','丁寧にやっています。')
                    ->press('.btn.btn-sm.btn-primary')//編集する
                    ->pause(1000)
                    ->assertSee('丁寧にやっています。')
                    
                    // 課金ユーザーがその後、ブログを書いて消せること
                    ->clickLink('記事を書く')
                    ->value('input[name="blog_title"]','ブログタイトルその１')
                    ->attach('upfile', 'licence.png')
                    ->value('textarea[name="blog_content"]','ブログコンテンツその１ブログコンテンツその１。')
                    ->press('.btn.btn-primary')
                    // ->press('投稿')
                    ->pause(1000)

                    ->assertSee('ブログタイトルその１')
                    ->assertSee('ブログコンテンツその１ブログコンテンツその１。')
                    ->clickLink('店舗を見る')
                    ->assertSee('ブログタイトルその１')
                    ->clickLink('ブログタイトルその１')
                    ->pause(1000)
                    ->press('.btn.btn-sm.btn-danger')
                    ->pause(1000)
                    ->assertSee('ブログは存在しません。')

                    // 課金ユーザーがその後、口コミを書けること
                    ->value('textarea[name="word_of_mouth"]','自作自演投稿する。')
                    ->press('.btn.btn-primary')
                    ->pause(1000)
                    ->assertSee('自作自演投稿する。')

                    // ログアウト
                    ->clickLink('店舗ユーザー')
                    ->clickLink('ログアウト')
                    ->assertPathIs('/p');
        });
    }


    // public function testLoginShopAndLinkRequest()
    // {
    //     $this->browse(function (Browser $browser) {
    //         // 店舗ユーザーとしてログインして店舗をオーナー申請するまで
    //         $browser->visit('/login_shop')
    //                 ->type('email', 'masaakisaeki2@gmail.com')
    //                 ->type('password', 'hogehoge')
    //                 ->press('ログイン')
    //                 ->assertPathIs('/home_shop')
    //                 ->visit('/shops/450')
    //                 ->clickLink('オーナー様はこちら')
    //                 ->assertPathIs('/shops/450/link_requests/create')

    //                 ->attach('upfile', 'licence.png')
    //                 ->press('申請する')
    //                 ->assertSee('申請中です。もうしばらくお待ちください。');
    //     });
    // }
}
