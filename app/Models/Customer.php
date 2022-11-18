<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'dpi', 'phone', 'address',  'foto1','foto2','foto3', 'referencia'];


    // accesor
    public function getImgAttribute()
    {
        if ($this->avatar != null)
            if (file_exists('storage/customers/' . $this->avatar)) {
                return 'storage/customers/' . $this->avatar;
            } else {
                return 'storage/customers/noimage.png';
            }
        else {
            return 'storage/customers/noimage.png';
        }
    }

   
}
