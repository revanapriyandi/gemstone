<?php

namespace App\Helpers;

use Illuminate\Support\Arr;

class Helper
{
    public static function localizedMarkdownPath($name)
    {
        $localName = preg_replace('#(\.md)$#i', '.' . app()->getLocale() . '$1', $name);

        return Arr::first([
            resource_path('markdown/' . $localName),
            resource_path('markdown/' . $name),
        ], function ($path) {
            return file_exists($path);
        });
    }

    public static function formatPhoneNumberIndonesia($phoneNumber)
    {
        $phoneNumber = preg_replace('/[^0-9]/', '', $phoneNumber);
        if (strlen($phoneNumber) < 10) {
            return $phoneNumber;
        }
        if (substr($phoneNumber, 0, 1) === '0') {
            $phoneNumber = '62' . substr($phoneNumber, 1);
        }
        $formattedPhoneNumber = preg_replace('/(\d{4})(\d{4})(\d{1,4})$/', '$1-$2-$3', $phoneNumber);

        return $formattedPhoneNumber;
    }

    public static function formatRupiah($angka)
    {
        $rupiah = number_format($angka, 0, ',', '.');
        return 'Rp. ' . $rupiah;
    }

    //format persen
    public static function formatPersen($angka)
    {
        $persen = number_format($angka, 0, ',', '.');
        return $persen . '%';
    }

    public static function getPercentage($number, $total)
    {
        if ($total > 0) {
            return round(($number / $total) * 100, 2);
        }

        return 0;
    }

    public static function cleanAndFormatType($type)
    {
        // Hapus simbol dan karakter khusus
        $cleanType = preg_replace('/[^a-zA-Z ]/', ' ', $type);

        // Ubah simbol menjadi spasi
        $cleanType = str_replace('-', ' ', $cleanType);

        return $cleanType;
    }

    public static function getFirstWord($string)
    {
        $words = explode(' ', $string);
        $firstWord = $words[0];

        return $firstWord;
    }

    public static function checkItemName($itemName)
    {
        $jsonString = file_get_contents(public_path('json/ListItem.json'));

        $data = json_decode($jsonString, true);

        if (isset($data['items']) && is_array($data['items'])) {
            foreach ($data['items'] as $item) {
                if (str_contains($itemName, $item)) {
                    return $item;
                }
            }
        }

        return false;
    }

    public static function isVoucher($item)
    {
        $lowercaseItem = strtolower($item);

        $typesToCheck = [
            'voucher', 'vouchers', 'token', 'tokens', 'diskon', 'diskons', 'promo', 'promos', 'potongan', 'potongans', 'kupon', 'kupons',
        ];

        foreach ($typesToCheck as $type) {
            if (str_contains($lowercaseItem, $type)) {
                return $type;
            }
        }

        return false;
    }

    public static function generateOrderId($length = 8)
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        $orderId = date('YmdHis');
        $characterCount = strlen($characters);

        for ($i = 0; $i < $length - strlen($orderId); $i++) {
            $orderId .= $characters[rand(0, $characterCount - 1)];
        }

        return $orderId;
    }
}
