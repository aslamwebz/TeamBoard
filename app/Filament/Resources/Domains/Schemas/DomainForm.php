<?php

declare(strict_types=1);

namespace App\Filament\Resources\Domains\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

final class DomainForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('domain')
                    ->required(),
                TextInput::make('tenant_id')
                    ->required(),
            ]);
    }
}
