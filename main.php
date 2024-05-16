<?php
$date = date(DATE_ATOM);
$url = "https://cdn.jsdelivr.net/npm/@fawazahmed0/currency-api@latest/v1/currencies/eur.json";
$json    = file_get_contents( $url );
$data    = json_decode( $json, true );

$userCurrencyFrom = readline("Write in the amount and currency you'd like to change: ");
$userCurrencyTo = readline("Write in the currency you'd like to change to: ");
$splitCurrency = preg_split('/(?<=[0-9])(?=[a-z]+)/i',preg_replace('/\s+/', '', $userCurrencyFrom));

$amount = $splitCurrency[0];
$currency = strtolower($splitCurrency[1]);
$userCurrencyTo = strtolower($userCurrencyTo);

$found = false;
$result = 0;

    if ($currency === "eur") {
        if (isset($data["eur"][$userCurrencyTo])) {
            $result = $amount * $data["eur"][$userCurrencyTo];
            $result = round($result, 2);
            echo "Conversion from $amount " .strtoupper($currency). " to ". strtoupper($userCurrencyTo). " is $result.\n";

        }else{
            echo "Error: ".strtoupper($userCurrencyTo)." currency was not found.\n";
        }
    }elseif(isset($data["eur"][$currency])){
        $result = $amount / $data["eur"][$currency];
        $result = $result * $data["eur"][$userCurrencyTo];
        $result = round($result,2);
        echo "Conversion from $amount " .strtoupper($currency). " to ". strtoupper($userCurrencyTo). " is $result.\n";

    }else{
        echo "Error: ".strtoupper($currency)." currency was not found.\n";
    }



