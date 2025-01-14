<?php

namespace App\Services;

use App\Models\Credit;
use Illuminate\Support\Str;

class SerialNumberGenerator
{
    public static function generate(): string
    {
        do {
            // Lấy ngày hiện tại (YYYYMMDD)
            $date = now()->format('Ymd');
            // Sinh mã ngẫu nhiên 6 ký tự
            $random = strtoupper(Str::random(6));
            $serialNumber = "CC-{$date}-{$random}";
        } while (Credit::where('serial_number', $serialNumber)->exists());

        // Kết hợp thành serial_number
        return $serialNumber;
    }
}
