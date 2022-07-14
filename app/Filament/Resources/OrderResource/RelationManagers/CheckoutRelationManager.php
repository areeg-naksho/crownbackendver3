<?php

namespace App\Filament\Resources\OrderResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CheckoutRelationManager extends RelationManager
{
    protected static string $relationship = 'checkout';

    protected static ?string $recordTitleAttribute = 'first_name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('first_name'),
                Tables\Columns\TextColumn::make('last_name'),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('phone'),
                Tables\Columns\TextColumn::make('address'),
                Tables\Columns\TextColumn::make('address2'),
                Tables\Columns\TextColumn::make('country.name_en'),
                Tables\Columns\TextColumn::make('city.name_en'),
                Tables\Columns\TextColumn::make('state.name_en'),
                Tables\Columns\TextColumn::make('zip_code'),
                Tables\Columns\TextColumn::make('po_box'),
            ]);
    }
}
