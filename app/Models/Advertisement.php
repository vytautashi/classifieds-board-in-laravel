<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class Advertisement extends Model
{
    use HasFactory;
    protected $fillable = [
        'description',
        'price',
    ];

    public function delete()
    {
        File::delete(public_path($this->image_url));
        return parent::delete();
    }

    public function updateImage($image)
    {
        if ($this->image_url != '') {
            File::delete(public_path($this->image_url));
        }

        $imageName = $this->id . '.' . $image->extension();
        $image->move(public_path('images'), $imageName);
        $this->image_url = '/images/' . $imageName;

        return parent::save();
    }
}
