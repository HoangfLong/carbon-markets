<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Credit extends Model
{
    protected $table = 'credits';
    //protected $table Xác định bảng carbon_credits trong database mà model này tương ứng
    protected $fillable = [
        //$fillable liệt kê các cột được phép gán giá trị bằng phương thức create() or fill()
        'project_ID',
        'price_per_ton', 
        'quantity_available', 
        'minimum_purchase', 
        'standard_id',
        'validator',
        'status', 
        'start_date', 
        'end_date'
    ];


    public function project()
    {
        return $this->belongsTo(Project::class,'project_ID');
        /*Bảng credits có trường project_id làm khóa ngoại trỏ tới bảng projects, 
        vì vậy trong model Credit, sẽ định nghĩa quan hệ belongsTo*/
        //cho phép mỗi Credit liên kết với một Project thông qua project_id
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'carbon_credit_ID');
    }
    public function standard()
    {
        return $this->belongsTo(Standard::class, 'standard_id');
    }
    public function creditSerials()
    {
        return $this->hasMany(CreditSerial::class, 'carbon_credit_ID');
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
}
