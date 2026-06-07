<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'account_type',
        'phone',
        'company_status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /* ---------------- Relationships ---------------- */

    public function companyProfile(): HasOne
    {
        return $this->hasOne(CompanyProfile::class);
    }

    public function designs(): HasMany
    {
        return $this->hasMany(Design::class);
    }

    public function cartItems(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    /* ---------------- Role helpers ---------------- */

    public function isAdmin(): bool
    {
        return $this->account_type === 'admin';
    }

    public function isCompany(): bool
    {
        return $this->account_type === 'company';
    }

    /** Approved companies (and admins) see wholesale prices. */
    public function seesWholesale(): bool
    {
        return $this->isAdmin()
            || ($this->isCompany() && $this->company_status === 'approved');
    }

    public function pricingTier(): string
    {
        return $this->seesWholesale() ? 'wholesale' : 'retail';
    }
}
