<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\User;

class UserPolicy
{
    use HandlesAuthorization;

    private $admin;
    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->admin = 1;
    }

    public function store(User $user)
    {
        return $user->is_admin == $this->admin;
    }

    public function delete(User $user)
    {
        return $user->is_admin == $this->admin;
    }
}
