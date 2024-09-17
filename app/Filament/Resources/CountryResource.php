<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CountryResource\Pages;
use App\Filament\Resources\CountryResource\RelationManagers;
use App\Filament\Resources\CountryResource\RelationManagers\CitiesRelationManager;
use App\Filament\Resources\CountryResource\RelationManagers\EmployeesRelationManager;
use App\Filament\Resources\CountryResource\RelationManagers\StatesRelationManager;
use App\Models\Country;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CountryResource extends Resource
{
    protected static ?string $model = Country::class;

    protected static ?string $navigationIcon = 'heroicon-o-flag';
    protected static ?string $navigationLabel = 'Country';
    protected static ?string $modelLabel = 'Employees Country';
    protected static ?string $navigationGroup = 'System Management';
    
    protected static ?string $slug = 'employees-Country';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Contry Details')->schema([
                    Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
              Forms\Components\TextInput::make('code')
              ->required()
              ->default('123')
              ->maxLength(3),
              Forms\Components\TextInput::make('phonecode')
              ->required()
              ->default('+20')
              ->maxLength(50),
        
                   ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('name')
            ->searchable()
            ->sortable(),

            Tables\Columns\TextColumn::make('code')
            ->searchable()
            ->sortable(),

            Tables\Columns\TextColumn::make('phonecode')
            ->searchable()
            ->numeric()
            ->sortable(),

            Tables\Columns\TextColumn::make('created_at')
            ->dateTime()
            ->sortable()
            ->toggleable(isToggledHiddenByDefault: true),
        Tables\Columns\TextColumn::make('updated_at')
            ->dateTime()
            ->sortable()
            ->toggleable(isToggledHiddenByDefault: true),
            
        ])
             
            
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
           StatesRelationManager::class,
           EmployeesRelationManager::class,
 
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCountries::route('/'),
            'create' => Pages\CreateCountry::route('/create'),
            'edit' => Pages\EditCountry::route('/{record}/edit'),
        ];
    }
}
