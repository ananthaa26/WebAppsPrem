<?php

namespace App\Filament\Resources\Transactions\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class TransactionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('invoice_number')
                    ->required(),
                TextInput::make('user_id')
                    ->numeric()
                    ->default(null),
                TextInput::make('product_id')
                    ->numeric()
                    ->default(null),
                TextInput::make('variant_id')
                    ->numeric()
                    ->default(null),
                TextInput::make('customer_contact')
                    ->required(),
                TextInput::make('quantity')
                    ->required()
                    ->numeric()
                    ->default(1),
                TextInput::make('price_per_item')
                    ->required()
                    ->numeric(),
                TextInput::make('total_price')
                    ->required()
                    ->numeric()
                    ->prefix('$'),
                Select::make('status')
                    ->options([
            'pending' => 'Pending',
            'paid' => 'Paid',
            'processing' => 'Processing',
            'completed' => 'Completed',
            'failed' => 'Failed',
            'refunded' => 'Refunded',
        ])
                    ->default('pending')
                    ->required(),
                Select::make('payment_method')
                    ->options(['qris' => 'Qris', 'saldo' => 'Saldo'])
                    ->default(null),
                TextInput::make('payment_proof')
                    ->default(null),
                Textarea::make('description_detail')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('telegram_message_id')
                    ->tel()
                    ->default(null),
                DateTimePicker::make('paid_at'),
                DateTimePicker::make('completed_at'),
            ]);
    }
}
