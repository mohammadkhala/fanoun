<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'delivery_zone_id', 'reference', 'status', 'pricing_tier',
        'subtotal', 'delivery_fee', 'total',
        'contact_name', 'contact_phone', 'contact_email',
        'shipping_city', 'shipping_address', 'shipping_neighborhood', 'shipping_building',
        'payment_method', 'notes', 'admin_notes',
    ];

    protected $casts = [
        'subtotal'      => 'decimal:2',
        'delivery_fee'  => 'decimal:2',
        'total'         => 'decimal:2',
    ];

    public const STATUSES = [
        'pending_review' => 'قيد المراجعة',
        'approved' => 'تمت الموافقة',
        'in_production' => 'قيد التصنيع',
        'ready' => 'جاهز للتسليم',
        'delivered' => 'تم التسليم',
        'cancelled' => 'ملغي',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function deliveryZone(): BelongsTo
    {
        return $this->belongsTo(DeliveryZone::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function statusLabel(): string
    {
        return self::STATUSES[$this->status] ?? $this->status;
    }
}
