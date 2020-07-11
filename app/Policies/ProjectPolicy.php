<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\User;
use App\Project;
use App\UserProject;
use Auth;

class ProjectPolicy
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

    public function update(User $user, Project $project)
    {
        $ownProject = $this->checkOwnProject($user->id);

        return ($ownProject == 1) || ($user->is_admin == $this->admin);
    }

    public function delete(User $user, Project $project)
    {
        $ownProject = $this->checkOwnProject($user->id);

        return ($ownProject == 1) || ($user->is_admin == $this->admin);
    }

    private function checkOwnProject($userId)
    {
        return UserProject::where([
            'user_id' => $userId,
            'project_id' => request('id')]
        )->count();
    }
}
