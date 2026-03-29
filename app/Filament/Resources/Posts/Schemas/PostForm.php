<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DateTimePicker;
use Filament\Schemas\Components\Section;
use Filament\Support\Icons\Heroicon;
use Filament\Schemas\Components\Group;


class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make("Post Details")
                    ->description("Fill in the details of the post")
                    ->icon(Heroicon::RocketLaunch)
                    ->schema([
                        Group::make([
                            TextInput::make("title")
                                ->minLength(5),
                            TextInput::make("slug")
                                ->unique(),
                            Select::make("category_id")
                                ->relationship("category", "name")
                                ->preload()
                                ->searchable(),
                            ColorPicker::make("color"),
                        ])->columns(2),
                        
                        MarkdownEditor::make("content"),
                    ])->columnSpan(2),

                    Group::make([
                        Section::make("Image Upload")
                        ->icon(Heroicon::Camera)
                        ->schema([
                            FileUpload::make("image")
                                ->disk("public")
                                ->directory("posts"),
                        ]),

                        Section::make("Meta Information")
                        ->icon(Heroicon::DocumentArrowDown)
                        ->schema([
                            TagsInput::make("tags"),
                            Checkbox::make("published"),
                            DateTimePicker::make("published_at"),
                        ]),                        
                    ])->columnSpan(1),
                    
            ])->columns(3);
    }
}
