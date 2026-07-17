<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomRequestResource\Pages;
use App\Filament\Resources\CustomRequestResource\RelationManagers;
use App\Models\CustomRequest;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CustomRequestResource extends Resource
{
    protected static ?string $model = CustomRequest::class;
    protected static ?string $navigationGroup = 'Pesanan';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
{
    return $form
        ->schema([
            Forms\Components\Select::make('user_id')
                ->relationship('user', 'name')
                ->required()
                ->searchable()
                ->preload()
                ->disabled(fn (string $operation): bool => $operation === 'edit')
                ->label('Customer'),
            Forms\Components\Select::make('product_id')
                ->relationship('product', 'name')
                ->required()
                ->searchable()
                ->preload()
                ->disabled(fn (string $operation): bool => $operation === 'edit')
                ->label('Produk'),
            Forms\Components\TextInput::make('delivery_email')
                ->label('Email Pengiriman')
                ->disabled(fn (string $operation): bool => $operation === 'edit'),
            Forms\Components\TextInput::make('quantity')
                ->numeric()
                ->disabled(fn (string $operation): bool => $operation === 'edit'),
            Forms\Components\FileUpload::make('payment_proof')
    ->label('Bukti Transfer')
    ->image()
    ->directory('payment-proofs')
    ->imageResizeMode('contain')
    ->imageResizeTargetWidth('1200')
    ->imageResizeTargetHeight('1200')
    ->visible(fn (string $operation): bool => $operation === 'create')
    ->columnSpanFull(),

Forms\Components\Placeholder::make('payment_proof_preview')
    ->label('Bukti Transfer')
    ->content(function ($record) {
        if (! $record?->payment_proof) {
            return 'Belum ada bukti transfer.';
        }

        $url = asset('storage/' . $record->payment_proof);

        return new \Illuminate\Support\HtmlString(
            '<div class="pswp-gallery-admin"><a href="' . $url . '" data-pswp-width="1200" data-pswp-height="1200" class="inline-block"><img src="' . $url . '" class="w-20 h-20 rounded-xl object-cover border-2 border-gray-200 cursor-zoom-in" loading="lazy"></a></div>'
        );
    })
    ->visible(fn (string $operation): bool => $operation === 'edit')
    ->columnSpanFull(),
            Forms\Components\Textarea::make('customer_notes')
                ->disabled(fn (string $operation): bool => $operation === 'edit')
                ->columnSpanFull(),

            Forms\Components\Select::make('status')
                ->options([
                    'pending' => 'Pending',
                    'reviewed' => 'Reviewed',
                    'quoted' => 'Quoted',
                    'confirmed' => 'Confirmed',
                    'in_progress' => 'In Progress',
                    'completed' => 'Completed',
                    'cancelled' => 'Cancelled',
                ])
                ->required(),
            Forms\Components\Textarea::make('admin_notes')
                ->label('Catatan Internal Admin')
                ->columnSpanFull(),
        ]);
}

    public static function table(Table $table): Table
{
    return $table
        ->columns([
            Tables\Columns\TextColumn::make('user.name')
                ->label('Customer')
                ->searchable(),
            Tables\Columns\TextColumn::make('product.name')
                ->label('Produk')
                ->searchable(),
            Tables\Columns\TextColumn::make('delivery_email')
                ->label('Email Tujuan')
                ->copyable()
                ->searchable(),
            Tables\Columns\TextColumn::make('payment_proof')
    ->label('Bukti Transfer')
    ->formatStateUsing(function (?string $state) {
        if (! $state) {
            return '-';
        }

        $url = asset('storage/' . $state);

        return '<div class="pswp-gallery-admin"><a href="' . $url . '" data-pswp-width="1200" data-pswp-height="1200" class="inline-block"><img src="' . $url . '" class="w-12 h-12 rounded-lg object-cover cursor-zoom-in" loading="lazy"></a></div>';
    })
    ->html(),
            Tables\Columns\TextColumn::make('status')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'pending' => 'gray',
                    'reviewed' => 'info',
                    'quoted' => 'warning',
                    'confirmed', 'completed' => 'success',
                    'in_progress' => 'primary',
                    'cancelled' => 'danger',
                }),
            Tables\Columns\TextColumn::make('created_at')
                ->dateTime()
                ->label('Masuk Pada')
                ->sortable(),
        ])
        ->filters([
            Tables\Filters\SelectFilter::make('status')
                ->options([
                    'pending' => 'Pending',
                    'reviewed' => 'Reviewed',
                    'quoted' => 'Quoted',
                    'confirmed' => 'Confirmed',
                    'in_progress' => 'In Progress',
                    'completed' => 'Completed',
                    'cancelled' => 'Cancelled',
                ]),
        ])
        ->defaultSort('created_at', 'desc');
}

    public static function getRelations(): array
    {
    return [
        RelationManagers\SlotValuesRelationManager::class,
    ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCustomRequests::route('/'),
            'create' => Pages\CreateCustomRequest::route('/create'),
            'edit' => Pages\EditCustomRequest::route('/{record}/edit'),
        ];
    }
    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
    return parent::getEloquentQuery()->with(['user', 'product']);
    }
    public static function getNavigationBadge(): ?string
{
    $count = static::getModel()::where('status', 'pending')->count();

    return $count > 0 ? (string) $count : null;
}

public static function getNavigationBadgeColor(): ?string
{
    return 'warning';
}
}