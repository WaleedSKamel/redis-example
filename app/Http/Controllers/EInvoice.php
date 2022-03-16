<?php

namespace App\Http\Controllers;

class EInvoice extends Controller
{

    // from dec to hex must 2 digital in output
    public function hex_to_ascii($hex): string
    {
        $str = '';
        $str .= chr(hexdec($hex));
        return $str;
    }

    // from hex to ASCII
    public function ascii_to_base64($ascii): string
    {
        return base64_encode($ascii);
    }

    public function prepareInvoiceQRCode($data): string
    {
        $string = '';
        $number1 = '01';
        $string .= $this->hex_to_ascii($number1);
        $string1 = dechex(strlen($data['name']));
        $string1 = strlen($string1) == 1 ? $this->hex_to_ascii('0' . $string1) : $this->hex_to_ascii($string1);
        $string .= $string1;
        $string .= $data['name'];

        $number2 = '02';
        $string .= $this->hex_to_ascii($number2);
        $string2 = dechex(strlen($data['vat_number']));
        $string2 = strlen($string2) == 1 ? $this->hex_to_ascii('0' . $string2) : $this->hex_to_ascii($string2);
        $string .= $string2;
        $string .= $data['vat_number'];

        $number3 = '03';
        $string .= $this->hex_to_ascii($number3);
        $string3 = dechex(strlen($data['date']));
        $string3 = strlen($string3) == 1 ? $this->hex_to_ascii('0' . $string3) : $this->hex_to_ascii($string3);
        $string .= $string3;
        $string .= $data['date'];

        $number4 = '04';
        $string .= $this->hex_to_ascii($number4);
        $string4 = dechex(strlen($data['total']));
        $string4 = strlen($string4) == 1 ? $this->hex_to_ascii('0' . $string4) : $this->hex_to_ascii($string4);
        $string .= $string4;
        $string .= $data['total'];

        $number5 = '05';
        $string .= $this->hex_to_ascii($number5);
        $string5 = dechex(strlen($data['vat']));
        $string5 = strlen($string5) == 1 ? $this->hex_to_ascii('0' . $string5) : $this->hex_to_ascii($string5);
        $string .= $string5;
        $string .= $data['vat'];

        return $this->ascii_to_base64((string)$string);
    }

    public function invoice()
    {
        $data = [];
        $data['name'] = 'Firoz Ashraf';
        $data['vat_number'] = '1234567891';
        $data['date'] = '2021-11-17 08:30:00';
        $data['total'] = '100';
        $data['vat'] = '15';
        $this->prepareInvoiceQRCode($data);
        dd($this->prepareInvoiceQRCode($data));

    }
}
