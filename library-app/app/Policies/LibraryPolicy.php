<?php

namespace App\Policies;

use App\Models\Library;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class LibraryPolicy
{
    public function addLibrary(User $user) {
        return $user->role === 'admin';
    } 
}
