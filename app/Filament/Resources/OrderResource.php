<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Http\Controllers\OrderController;
use App\Models\Order;
use App\Models\OrderProduct;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Pages\Actions\DeleteAction;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->columns(1)->schema([
                    Forms\Components\TextInput::make('id')->disabled(),
                    Forms\Components\TextInput::make('subtotal')->disabled(),
                    Forms\Components\TextInput::make('shipping')->disabled(),
                    Forms\Components\TextInput::make('tax')->disabled(),
                    Forms\Components\TextInput::make('total')->disabled(),
                    Forms\Components\TextInput::make('currency')->disabled(),
                    Select::make('order_status')
                        ->options([
                            '1' => 'On-Hold',
                            '2' => 'Shipped',
                            '3' => 'Processed',
                            '4' => 'Completed',
                        ])
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('Order Code'),
                TextColumn::make('orderproduct_count')->counts('orderproduct')->label('Num Product'),
                Tables\Columns\TextColumn::make('checkout.first_name')->label('Cumstomer'),
                Tables\Columns\TextColumn::make('total')->label('Amount'),
                Tables\Columns\TextColumn::make('products.name_en')->label('Products Name'),
                Tables\Columns\TextColumn::make('orderproduct.quantity')->label('Products Quantity'),
                Tables\Columns\TextColumn::make('order_status')->enum([
                    '1' => 'On-Hold',
                    '2' => 'Shipped',
                    '3' => 'Processed',
                    '4' => 'Completed',
                ]),
            ])
            ->filters([
                //
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // RelationManagers\UserRelationManager::class,
            RelationManagers\ProductRelationManager::class,
            // RelationManagers\ProfileRelationManager::class,
            // RelationManagers\TransactionsRelationManager::class,
            // RelationManagers\OrderproductRelationManager::class,
            // RelationManagers\PaymentMethodRelationManager::class,
            // RelationManagers\ShippingCompanyRelationManager::class,
            RelationManagers\CheckoutRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'view' => Pages\ViewOrder::route('/{record}'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('product_id'),
        ];
    }
}
