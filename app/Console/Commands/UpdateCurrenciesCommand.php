<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;


class UpdateCurrenciesCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = "update:currencies";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Updates currencies from http://www.cbr.ru/scripts/XML_daily.asp";


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        echo "sdsdfsdf" . PHP_EOL;
    }
}
