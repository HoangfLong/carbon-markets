<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarbonCredit extends Model
{
    
    protected $table = 'carbon_credits';
    //protected $table Xác định bảng carbon_credits trong database mà model này tương ứng
    protected $fillable = [
        //$fillable liệt kê các cột được phép gán giá trị bằng phương thức create() or fill()
        'project_id',
        'serial_number',
        'value',
        'status',
    ];


    public function projects() {
        return $this->belongsTo(Project::class,'project_id');
        /*Bảng carbon_credits có trường project_id làm khóa ngoại trỏ tới bảng carbon_projects, 
        vì vậy trong model CarbonCredit, ta sẽ định nghĩa quan hệ belongsTo*/
        //cho phép mỗi CarbonCredit liên kết với một CarbonProject thông qua project_id
    }
}
