<?php

namespace App\Filament\Resources\CustomRequestResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class SlotValuesRelationManager extends RelationManager
{
    protected static string $relationship = 'slotValues';

    protected static ?string $title = 'Jawaban Custom (Slot Values)';

    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('template_slot_id')
                ->relationship('slot', 'label')
                ->required()
                ->searchable()
                ->preload()
                ->label('Slot'),
            Forms\Components\TextInput::make('instance_index')
                ->numeric()
                ->default(0)
                ->label('Instance ke-'),
            Forms\Components\Textarea::make('value_text')
                ->label('Jawaban Teks')
                ->columnSpanFull(),
            Forms\Components\FileUpload::make('value_file_path')
    ->label('Jawaban Foto/File')
    ->directory('request-uploads')
    ->imageResizeMode('contain')
    ->imageResizeTargetWidth('1200')
    ->imageResizeTargetHeight('1200'),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('value_text')
            ->columns([
                Tables\Columns\TextColumn::make('slot.section.name')
                    ->label('Section'),
                Tables\Columns\TextColumn::make('slot.label')
                    ->label('Slot'),
                Tables\Columns\TextColumn::make('instance_index')
                    ->label('Ke-'),
                Tables\Columns\TextColumn::make('value_text')
                    ->label('Jawaban Teks')
                    ->limit(30),
                Tables\Columns\ImageColumn::make('value_file_path')
                    ->label('File'),
            ])
            ->defaultSort('template_slot_id')
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}