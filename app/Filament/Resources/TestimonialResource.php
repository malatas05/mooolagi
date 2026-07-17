<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestimonialResource\Pages;
use App\Filament\Resources\TestimonialResource\RelationManagers;
use App\Models\Testimonial;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TestimonialResource extends Resource
{
    protected static ?string $model = Testimonial::class;
    protected static ?string $navigationGroup = 'Konten';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
{
    return $form
        ->schema([
            Forms\Components\TextInput::make('customer_name')
                ->label('Nama Customer')
                ->required(),
            Forms\Components\FileUpload::make('customer_photo')
    ->label('Foto Customer (opsional)')
    ->image()
    ->directory('testimonials')
    ->imageResizeMode('contain')
    ->imageResizeTargetWidth('600')
    ->imageResizeTargetHeight('600')
    ->avatar(),
            Forms\Components\Select::make('rating')
                ->options([1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5'])
                ->default(5)
                ->required(),
            Forms\Components\Textarea::make('content')
                ->label('Isi Testimoni')
                ->required()
                ->columnSpanFull(),
            Forms\Components\Toggle::make('is_featured')
                ->label('Tampilkan di Homepage'),
        ]);
}

    public static function table(Table $table): Table
{
    return $table
        ->columns([
            Tables\Columns\ImageColumn::make('customer_photo')
                ->label('Foto')
                ->circular(),
            Tables\Columns\TextColumn::make('customer_name')
                ->searchable(),
            Tables\Columns\TextColumn::make('rating')
                ->badge()
                ->color('warning'),
            Tables\Columns\IconColumn::make('is_featured')
                ->label('Featured')
                ->boolean(),
        ])
        ->defaultSort('created_at', 'desc');
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
            'index' => Pages\ListTestimonials::route('/'),
            'create' => Pages\CreateTestimonial::route('/create'),
            'edit' => Pages\EditTestimonial::route('/{record}/edit'),
        ];
    }
}
