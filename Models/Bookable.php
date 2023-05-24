<?php

namespace Modules\Bookable\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Modules\Bookable\Models\BookableState;
use Modules\Bookable\Contracts\Bookable as BookableContract;
use Konekt\Enum\Eloquent\CastsEnums;
use Vanilo\Contracts\Buyable;
use Vanilo\Support\Traits\BuyableModel;
use Vanilo\Support\Traits\HasImagesFromMediaLibrary;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Bookable extends Model implements BookableContract, Buyable, HasMedia {

    use HasImagesFromMediaLibrary;
    use InteractsWithMedia;
    use BuyableModel;
    use CastsEnums;
    use Sluggable;
    use SluggableScopeHelpers;

    protected $product_type = 'Modules\Bookable\Models\Bookable';
    protected $fillable = [
        'name',
        'slug',
        'sku',
        'price',
        'original_price',
        'excerpt',
        'description',
        'state',
        'ext_title',
        'meta_keywords',
        'meta_description',
    ];
    protected $casts = [
        'price' => 'float',
        'original_price' => 'float',
    ];
    protected $enums = [
        'state' => 'BookableStateProxy@enumClass'
    ];

    public function morphTypeName(): string {
        return static::class;
    }

    public static function findBySku(string $sku) {
        return static::where('sku', $sku)->first();
    }

    public function isActive(): bool {
        return $this->state->isActive();
    }

    public function getIsActiveAttribute(): bool {
        return $this->isActive();
    }

    public function isOnStock(): bool {
        return $this->stock > 0;
    }

    public function title(): string {
        return $this->ext_title ?? $this->name;
    }

    public function getTitleAttribute(): string {
        return $this->title();
    }

    public function scopeActives(Builder $query): Builder {
        return $query->whereIn('state', BookableState::getActiveStates());
    }

    public function scopeInactives(Builder $query): Builder {
        return $query->whereIn('state', array_diff(BookableState::values(), BookableState::getActiveStates()));
    }

    public function sluggable(): array {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public static function findBySlug(string $slug) {
        return static::where('slug', $slug)->first();
    }

    public function registerMediaCollections(): void {
        $this
                ->addMediaCollection('default')
                ->useDisk('bookable')
                ->singleFile()
                ->registerMediaConversions(function (Media $media) {
                    $this
                    ->addMediaConversion('thumbnail')
                    ->width(100)
                    ->height(100);
                });
    }

}
