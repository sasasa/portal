<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class PageTest extends DuskTestCase
{
    // public function testTopPage()
    // {
    //     $this->browse(function (Browser $browser) {
    //         // TOPページにアクセスできるか
    //         $browser->visit('/')
    //                 ->assertSee('日本全国の整体院、一覧')
    //                 ->assertSee('北海道')
    //                 ->assertSee('沖縄県')
    //                 ->assertSee('整体院に関する記事一覧');
    //     });
    // }

    // public function testSecondPage()
    // {
    //     $this->browse(function (Browser $browser) {
    //         // Secondページにアクセスできるか
    //         $browser->visit('/')
    //                 ->assertSee('日本全国の整体院、一覧')
    //                 ->clickLink('北海道')
    //                 ->assertSee('北海道の整体院、一覧');
    //     });
    // }

    // public function testThirdPage()
    // {
    //     $this->browse(function (Browser $browser) {
    //         // Thirdページにアクセスできるか
    //         $browser->visit('/')
    //                 ->assertSee('日本全国の整体院、一覧')
    //                 ->clickLink('北海道')
    //                 ->assertSee('北海道の整体院、一覧')
    //                 ->clickLink('札幌市中央区')
    //                 ->assertSee('北海道札幌市中央区の整体院、一覧');
    //     });
    // }

    // public function testFourthPage()
    // {
    //     $this->browse(function (Browser $browser) {
    //         // Fourtページにアクセスできるか
    //         $browser->visit('/')
    //                 ->assertSee('日本全国の整体院、一覧')
    //                 ->clickLink('北海道')
    //                 ->assertSee('北海道の整体院、一覧')
    //                 ->clickLink('札幌市中央区')
    //                 ->assertSee('北海道札幌市中央区の整体院、一覧')
    //                 ->clickLink('大湊厚生療院')
    //                 ->assertSee('大湊厚生療院');
    //     });
    // }

    public function testEvaluation()
    {
        $this->browse(function (Browser $browser) {
            // 口コミで何も入力しないとバリデーションエラーになるか
            // 何か入力すると書き込みできるか
            $browser->visit('/')
                    ->assertSee('日本全国の整体院、一覧')
                    ->clickLink('北海道')
                    ->assertSee('北海道の整体院、一覧')
                    ->clickLink('札幌市中央区')
                    ->assertSee('北海道札幌市中央区の整体院、一覧')
                    ->clickLink('円山中央鍼灸整骨院')
                    ->assertSee('円山中央鍼灸整骨院')
                    ->assertSee('オーナー様はこちら')
                    ->assertSee('口コミは存在しません。')
                    // ->type('word_of_mouth', '')
                    ->press('.btn.btn-primary')
                    ->assertSee('内容は必ず指定してください。')
                    // ->type('word_of_mouth', 'テストの口コミをします')
                    ->value('textarea[name="word_of_mouth"]','テストの口コミをします')
                    ->press('.btn.btn-primary')
                    ->assertSee('テストの口コミをします');
        });
    }
}
