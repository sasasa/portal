<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ShopLoader extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shop:load';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '整体院を読み込む';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        setlocale(LC_CTYPE, "ja.UTF8");
        $fp = new \SplFileObject('urizo-整体院-全国リスト.csv', 'rb');
        $fp->setFlags(
            \SplFileObject::READ_CSV | //CSV列として行読み込み
            \SplFileObject::READ_AHEAD | //先読み/巻き戻し
            \SplFileObject::SKIP_EMPTY | //空行読み飛ばし
            \SplFileObject::DROP_NEW_LINE //行末の改行読み飛ばし
        );

        foreach ($fp as $line) {
            if ($fp->key() > 0 && !$fp->eof()) {

                \DB::table('shops')->insert([
                    'shop_name' => $line[0],
                    'location' => $line[2],
                    'phone_number' => $line[3],
                    'shop_mail' => $line[5],
                    'url' => $line[6],
                    'description' => '',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // 店名
                // $this->line($line[0]);
                // 郵便番号
                // $this->line($line[1]);
                // 住所
                // $this->line($line[2]);
                // 電話番号
                // $this->line($line[3]);
                // Fax
                // $this->line($line[4]);
                // メールアドレス
                // $this->line($line[5]);
                // URL
                // $this->line($line[6]);

                // 店舗名 shop_name
                // 所在地 location
                // 電話番号 phone_number
                // メールアドレス shop_mail
                // URL url
                // 説明文 description
            }
        }
        return 0;
    }
}
