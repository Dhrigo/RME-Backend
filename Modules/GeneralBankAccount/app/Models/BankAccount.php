<?php

namespace Modules\GeneralBankAccount\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\GeneralBankAccount\Database\Factories\BankAccountFactory;

class BankAccount extends Model
{
    use HasFactory;

    protected $fillable = ['bank_name', 'account_number', 'account_holder', 'account_type', 'is_active'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    protected static function newFactory(): BankAccountFactory
    {
        return BankAccountFactory::new();
    }
}
