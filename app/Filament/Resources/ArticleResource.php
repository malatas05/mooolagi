<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArticleResource\Pages;
use App\Filament\Resources\ArticleResource\RelationManagers;
use App\Models\Article;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;
    protected static ?string $navigationGroup = 'Konten';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
{
    return $form
        ->schema([
            Forms\Components\Hidden::make('user_id')
                ->default(fn () => auth()->id()),
            Forms\Components\TextInput::make('title')
                ->required()
                ->live(onBlur: true)
                ->afterStateUpdated(fn (string $context, $state, callable $set) =>
                    $context === 'create' ? $set('slug', \Illuminate\Support\Str::slug($state)) : null
                ),
            Forms\Components\TextInput::make('slug')
                ->required()
                ->unique(ignoreRecord: true),
            Forms\Components\Textarea::make('excerpt')
                ->label('Ringkasan Singkat')
                ->maxLength(255)
                ->columnSpanFull(),
            Forms\Components\FileUpload::make('cover_image')
                ->image()
                ->directory('articles'),
            Forms\Components\RichEditor::make('content')
                ->required()
                ->columnSpanFull(),
            Forms\Components\Toggle::make('is_published')
                ->live(),
            Forms\Components\DateTimePicker::make('published_at')
                ->visible(fn (Forms\Get $get) => $get('is_published')),
        ]);
}

    public static function table(Table $table): Table
{
    return $table
        ->columns([
            Tables\Columns\ImageColumn::make('cover_image'),
            Tables\Columns\TextColumn::make('title')
                ->searchable(),
            Tables\Columns\IconColumn::make('is_published')
                ->label('Terbit')
                ->boolean(),
            Tables\Columns\TextColumn::make('published_at')
                ->dateTime()
                ->sortable(),
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
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }
}
