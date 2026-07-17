<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;
    protected static ?string $navigationGroup = 'Katalog';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
{
    return $form
        ->schema([
            Forms\Components\Select::make('category_id')
                ->relationship('category', 'name')
                ->required()
                ->searchable()
                ->preload(),
            Forms\Components\TextInput::make('name')
                ->required()
                ->live(onBlur: true)
                ->afterStateUpdated(fn (string $context, $state, callable $set) =>
                    $context === 'create' ? $set('slug', \Illuminate\Support\Str::slug($state)) : null
                ),
            Forms\Components\TextInput::make('slug')
                ->required()
                ->unique(ignoreRecord: true),
            Forms\Components\Textarea::make('description')
                ->columnSpanFull(),
                Forms\Components\TextInput::make('price')
                ->label('Harga (Estimasi Mulai Dari)')
                ->numeric()
                ->prefix('Rp')
                ->minValue(0)
                ->nullable(),
            Forms\Components\Select::make('request_type')
    ->options([
        'simple' => 'Simple - Produk Digital (Form Standar)',
        'template' => 'Template - Produk Fisik (Section & Slot Custom)',
    ])
                ->required()
                ->default('simple')
                ->live(),
            Forms\Components\Toggle::make('is_active')
                ->default(true),

            Forms\Components\Repeater::make('templateSections')
                ->relationship()
                ->label('Section & Slot Custom')
                ->visible(fn (Forms\Get $get) => $get('request_type') === 'template')
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->label('Nama Section')
                        ->required()
                        ->placeholder('Contoh: Tampak Depan'),

                    Forms\Components\Repeater::make('slots')
                        ->relationship()
                        ->label('Slot dalam section ini')
                        ->schema([
                            Forms\Components\TextInput::make('label')
                                ->required()
                                ->placeholder('Contoh: Photo Object size story IG'),
                            Forms\Components\Select::make('type')
                                ->options([
                                    'photo' => 'Foto',
                                    'text' => 'Teks',
                                    'qr_code' => 'QR Code',
                                ])
                                ->required()
                                ->live(),
                            Forms\Components\TextInput::make('quantity')
                                ->numeric()
                                ->default(1)
                                ->required(),
                            Forms\Components\TextInput::make('size_spec')
                                ->label('Spesifikasi Ukuran')
                                ->visible(fn (Forms\Get $get) => $get('type') === 'photo')
                                ->placeholder('Contoh: story_instagram, kotak, bulat'),
                            Forms\Components\TextInput::make('char_limit')
                                ->label('Batas Karakter')
                                ->numeric()
                                ->visible(fn (Forms\Get $get) => $get('type') === 'text'),
                            Forms\Components\Textarea::make('instructions')
                                ->label('Instruksi Tambahan')
                                ->columnSpanFull(),
                        ])
                        ->columns(2)
                        ->orderColumn('sort_order')
                        ->collapsible()
                        ->itemLabel(fn (array $state): ?string => $state['label'] ?? 'Slot baru'),
                ])
                ->orderColumn('sort_order')
                ->collapsible()
                ->itemLabel(fn (array $state): ?string => $state['name'] ?? 'Section baru')
                ->columnSpanFull(),
        ]);
}

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('category.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->label('Harga')
                    ->money('IDR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('request_type'),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
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
                Tables\Actions\EditAction::make(),
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
        RelationManagers\ImagesRelationManager::class,
    ];
}

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
