<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $fillable = ['name', 'price'];

    public function getImageAttribute() {
        if (empty($this->attributes['image'])) {
            return 'image/product1.png';
        }

        return $this->attributes['image'];
    }

    public function getCreatedAtAttribute() {
        return Carbon::parse($this->attributes['created_at'])->format('d M Y');
    }

    public function getPriceAttribute() {
        return number_format($this->attributes['price'], 0, ',', '.');
    }

    public function setPriceAttribute($value) {
        $this->attributes['price'] = preg_replace("/[^0-9]/", "", $value);
    }
}
