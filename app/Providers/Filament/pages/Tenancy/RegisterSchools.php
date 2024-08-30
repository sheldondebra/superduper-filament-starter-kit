<?php

namespace App\Providers\Filament\pages\Tenancy;

use App\Models\School;
use Filament\Forms\Form;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Tenancy\RegisterTenant;

class RegisterSchools extends RegisterTenant
{
    public static function getLabel(): string
    {
        return "Register School";
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
            ]);
    }

    public function handleRegistration(array $data): School
    {
        $school = School::create($data);

        $school->members()->attach(Auth::user());

        return $school;
    }
}