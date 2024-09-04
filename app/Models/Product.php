<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;

class Product extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'description',
        'slug',
        'sku',
        'security_stock',
        'requires_shipping',
        'is_visible',
        'price',
        'unit_id',
    ];

    protected $hidden = [];

    protected $casts = [
        'requires_shipping' => 'boolean',
        'is_visible' => 'boolean',
        'price' => 'decimal:2',
        'security_stock' => 'integer',
    ];

    /**
     * Define o relacionamento com a unidade.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_products', 'product_id', 'category_id');
    }
}
