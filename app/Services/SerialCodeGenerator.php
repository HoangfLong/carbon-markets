<?php

namespace App\Services;

use App\Models\CreditSerial;
use Illuminate\Support\Str;

class SerialCodeGenerator
{
    public static function generate(): string
    {
        do {
            // Lấy ngày hiện tại (YYYYMMDD)
            $date = now()->format('Ymd');
            // Sinh mã ngẫu nhiên 6 ký tự
            $random = strtoupper(Str::random(6));
            $serialCode = "CC-{$date}-{$random}";
        } while (CreditSerial::where('serial_code', $serialCode)->exists());
        // Kết hợp thành serial_code
        return $serialCode;
    }
}
