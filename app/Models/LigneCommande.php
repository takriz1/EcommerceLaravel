<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LigneCommande extends Model
{
    use HasFactory;
    public function products(){
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    public function commande(){
        return $this->belongsTo(Commande::class, 'command_id', 'id');
    }

}
