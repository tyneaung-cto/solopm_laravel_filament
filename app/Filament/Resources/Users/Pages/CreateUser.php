<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use Filament\Resources\Pages\CreateRecord;

use Illuminate\Support\Facades\Mail;
use App\Mail\UserWelcomeMail;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function afterCreate(): void
    {
        $user = $this->record;

        // Mail::to($user->email)
        //     ->send(new UserWelcomeMail($user));
        Mail::to($user->email)->queue(new UserWelcomeMail($user));
    }
}
