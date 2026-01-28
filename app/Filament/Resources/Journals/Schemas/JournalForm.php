<?php

namespace App\Filament\Resources\Journals\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class JournalForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->schema([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->unique(
                        table: 'journals',
                        column: 'title',
                        ignoreRecord: true
                    ),

                FileUpload::make('image')
                    ->image()
                    ->directory('journals')
                    ->disk('public')
                    ->imageEditor()
                    ->imagePreviewHeight('200')
                    ->required(),

                Textarea::make('summary')
                    ->required()
                    ->rows(3)
                    ->columnSpanFull(),

                RichEditor::make('content')
                    ->required()
                    ->columnSpanFull(),
            ])
            ->columns(2);
    }
}
