<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;

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
    protected $description = "Updates currencies from address in env variable: CURRENCY_API_URI";

    private $httpClient;

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        DB::table('currencies')->truncate();

        $this->httpClient = new Client();

        $currencyAPIURI = env('CURRENCY_API_URI');
        $englishCurrencyAPIURI = env('CURRENCY_ENG_API_URI');

        $currencies = $this->getCurrencies($currencyAPIURI);
        $engCurrencies = $this->getCurrencies($englishCurrencyAPIURI);

        foreach ($currencies as $currency) {
            $currencyEng = $engCurrencies->where('NumCode', $currency['NumCode'])->first();
            $this->seedCurrency($currency, $currencyEng['Name']);
        }
    }

    private function getCurrencies($uri)
    {
        $currencies = simplexml_load_string($this->fetchCurrencies($uri));

        $currenciesArray = json_decode(json_encode((array) $currencies), TRUE);

        return collect($currenciesArray['Valute']);
    }

    private function fetchCurrencies($uri)
    {
        $response = $this->httpClient->request('GET', $uri);

        return $response->getBody();
    }

    private function seedCurrency($currency, $englishCurrencyName)
    {
        $newCurrency = [
            'name' => $currency['Name'],
            'english_name' => $englishCurrencyName,
            'alphabetic_code' => $currency['CharCode'],
            'digit_code' => $currency['NumCode'],
            'rate' => (int) $currency['Nominal'] / (float) $currency['Value'],
        ];

        DB::table('currencies')->insert($newCurrency);
    }
}
