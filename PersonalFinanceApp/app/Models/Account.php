<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Account extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function bank(): HasOne
    {
        return $this->hasOne(BankType::class, 'id', 'bank_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }


    public function type(): BelongsTo
    {
        return $this->belongsTo(AccountType::class, 'account_type_id');
    }


    public function scopeAmount($query)
    {
        $query->withSum('transactions', 'amount');
    }

    public function scopeUser($query, $id)
    {
        $query->where('user_id', $id);
    }

    public function scopeAmountAt($query, $date)
    {
        $query->withSum(['transactions as amountAt' => function ($query) use ($date) {
            $query->where('completed_date', '<=', $date);
        }], 'amount');
    }


    public function scopeMonthlyCheck($query){
        $query->withSum(['transactions as month_ago' => function ($query){
            $query->where('completed_date', '<=', Carbon::now()->subMonth()->format('Y-m-d'));
        }], 'amount');    }

    public function scopeWeeklyCheck($query){
        $query->withSum(['transactions as week_ago' => function ($query){
            $query->where('completed_date', '<=', Carbon::now()->subWeek()->format('Y-m-d'));
        }], 'amount');    }

    public function scopeDailyCheck($query){
        $query->withSum(['transactions as day_ago' => function ($query){
            $query->where('completed_date', '<=', Carbon::now()->subDay()->format('Y-m-d'));
        }], 'amount');
    }
//    protected function comparison(): Attribute
//    {
//        return new Attribute(
//            get: fn() => 'month',
//        );
//    }

}
