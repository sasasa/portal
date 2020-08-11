<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CSVLoader extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'csv:load';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '市区町村CSV Loading...';

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
        $fp = new \SplFileObject('KEN_ALL.CSV', 'rb');
        $fp->setFlags(
            \SplFileObject::READ_CSV | //CSV列として行読み込み
            \SplFileObject::READ_AHEAD | //先読み/巻き戻し
            \SplFileObject::SKIP_EMPTY | //空行読み飛ばし
            \SplFileObject::DROP_NEW_LINE //行末の改行読み飛ばし
        );
        $district_hash = [];
        foreach ($fp as $line) {
            if (!$fp->eof()) {
                // $this->line($line[7], $line[6]);
                $district_hash[$line[7]] = $line[6];
            }
        }
        foreach ($district_hash as $district => $pref) {
            \DB::table('places')->insert([
                'prefecture' => $pref,
                'district' => $district,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return 0;
    }
}
