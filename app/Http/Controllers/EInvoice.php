<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EInvoice extends Controller
{

    // from dec to hex must 2 digital in output
    public function toHex(int $value): string
    {
        $str =  dechex($value);
        if (strlen($str) == 2){
            return $str ;
        }else{
            return '0'.$str ;
        }
    }

    // from hex to ASCII
    public function convertHex($str): string
    {
        return bin2hex($str);
    }

    public function base64Encode($value): string
    {
        return base64_encode($value);
    }

    public function invoice()
    {
        $companyName = "Firoz Ashraf";
        $vat_number = "1234567891";
        $time = "2021-11-17 08:30:00";
        $invoice_total = "100.00";
        $vat_total = "15.00";


        // tag and length and value
        return
            $this->base64Encode(
                $this->convertHex("01").$this->convertHex($this->toHex(strlen($companyName))).$companyName.
                $this->convertHex("02").$this->convertHex($this->toHex(strlen($vat_number))).$vat_number.
                $this->convertHex("03").$this->convertHex($this->toHex(strlen($time))).$time.
                $this->convertHex("04").$this->convertHex($this->toHex(strlen($invoice_total))).$invoice_total.
                $this->convertHex("05").$this->convertHex($this->toHex(strlen($vat_total))).$vat_total
            );
    }
}
