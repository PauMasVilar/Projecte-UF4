<?php

use App\Models\User;

function getUserType(User $user)
{
    if ($user->is_admin && $user->is_professor) return "Administrador / Professor";
    if ($user->is_admin) return "Administrador";
    if ($user->is_professor) return "Professor";
    return "Alumne";
}
