<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StateResource\Pages;
use App\Filament\Resources\StateResource\RelationManagers;
use App\Models\Country;
use App\Models\State;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StateResource extends Resource
{
    protected static ?string $model = State::class;

    protected static ?string $navigationIcon = 'heroicon-o-globe';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->columns(1)->schema([
                    Forms\Components\TextInput::make('name_en')->required(),
                    Forms\Components\TextInput::make('name_ar')->required(),
                    Select::make('country_id')
                        ->searchable()
                        ->getSearchResultsUsing(fn (string $searchQuery) => Country::where('name_en', 'like', "%{$searchQuery}%")->orWhere('name_en', 'like', "%{$searchQuery}%")->limit(50)->pluck('name_en', 'id'))
                        ->getOptionLabelUsing(fn ($value): ?string => Country::find($value)?->name_en),
                    Forms\Components\TextInput::make('default_shipping')->required(),
                    Forms\Components\TextInput::make('extra_shipping')->required(),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name_en'),
                Tables\Columns\TextColumn::make('name_ar'),
                Tables\Columns\TextColumn::make('country.name_en'),
                Tables\Columns\TextColumn::make('default_shipping'),
                Tables\Columns\TextColumn::make('extra_shipping'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStates::route('/'),
            'create' => Pages\CreateState::route('/create'),
            'edit' => Pages\EditState::route('/{record}/edit'),
        ];
    }
}
