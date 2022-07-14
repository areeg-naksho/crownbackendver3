<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Category;
use App\Models\Product;
use Faker\Core\File;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MultiSelect;
use Filament\Forms\Components\Select;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->columns(1)->schema([
                    Forms\Components\TextInput::make('name_en')->required(),
                    Forms\Components\TextInput::make('name_ar')->required(),
                    Forms\Components\TextInput::make('description_en')->required(),
                    Forms\Components\TextInput::make('description_ar')->required(),
                    Forms\Components\TextInput::make('price')->required()->numeric(),
                    Forms\Components\TextInput::make('discount_price')->required()->numeric(),
                    Forms\Components\TextInput::make('quantity')->required()->numeric(),
                    Forms\Components\Checkbox::make('featured')->inline(false),

                    Select::make('category_id')
                        ->searchable()
                        ->getSearchResultsUsing(fn (string $searchQuery) => Category::where('name_ar', 'like', "%{$searchQuery}%")->orWhere('name_en', 'like', "%{$searchQuery}%")->limit(50)->pluck('name_en', 'id'))
                        ->getOptionLabelUsing(fn ($value): ?string => Category::find($value)?->name_en),
                    FileUpload::make('image')->multiple()->image()->directory('productImages')->required(),

                ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name_en'),
                Tables\Columns\TextColumn::make('name_ar'),
                Tables\Columns\TextColumn::make('description_en'),
                Tables\Columns\TextColumn::make('description_ar'),
                Tables\Columns\TextColumn::make('price'),
                Tables\Columns\TextColumn::make('discount_price'),
                Tables\Columns\TextColumn::make('quantity'),
                Tables\Columns\BooleanColumn::make('featured'),
                // Tables\Columns\ImageColumn::make('image'),

            ])
            ->filters([
                //
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'view' => Pages\ViewProduct::route('/{record}'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
