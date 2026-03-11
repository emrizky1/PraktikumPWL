<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                //
                TextInput::make('name')
                    ->required()
                    ->maxlength(255),
                TextInput::make('email')
                    ->email()
                    ->unique()
                    ->required()
                    ->maxlength(255),
                TextInput::make('password')
                    ->password()
                    ->required()
                    ->minLength(6)
            ]);
    }
}
