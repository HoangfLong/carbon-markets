<?php

namespace App\Services;

use App\Models\CreditSerial;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SerialCodeGenerator
{
    public static function generate(): string
    {
        do {
            // Lấy ngày hiện tại (YYYYMMDD)
            $date = now()->format('Ymd');
            
            // Tạo mã ngẫu nhiên ban đầu từ chữ cái và số
            $randomPart = strtoupper(Str::random(12)) . mt_rand(10000, 99999);
            
            // Lấy mã serial code trước đó (nếu có) từ cơ sở dữ liệu
            $lastSerialCode = CreditSerial::latest()->first();
            $lastCode = $lastSerialCode ? $lastSerialCode->serial_code : null;
            
            // Tạo hash của mã serial code trước đó và kết hợp với random
            $previousHash = $lastCode ? Hash::make($lastCode) : Str::random(64); // nếu không có mã trước, sử dụng chuỗi ngẫu nhiên
            
            // Kết hợp ngày, mã ngẫu nhiên, và hash trước đó
            $serialCode = "CC-{$date}-{$randomPart}-" . substr($previousHash, 0, 32); // Lấy phần hash ngắn
        
        } while (CreditSerial::where('serial_code', $serialCode)->exists());
        // Kết hợp thành serial_code
        return $serialCode;
    }
}
