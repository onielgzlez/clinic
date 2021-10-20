<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'price',
        'quantity',
        'minimium',
        'photo',
        'description',
        'provider_id',
        'classificator_id',
    ];

    /**
     * Get the providers for the product.
     */
    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }
    
    /**
     * Get the classificator for the product.
     */
    public function classificator()
    {
        return $this->belongsTo(Classificator::class);
    }

    public function organizations() {
        return $this
            ->belongsToMany(Organization::class,'organization_products');
    }
}
