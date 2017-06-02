<?php

namespace App\Policies;

use App\User;
use App\Robot;
use Illuminate\Auth\Access\HandlesAuthorization;

class RobotPolicy
{
    use HandlesAuthorization;

    /**
     * Determine the user status
     *
     * @param \App\User $user
     * @param $ability
     * @return boolean
    */
    public function before(User $user, $ability)
    {
        if($user->isAdmin()) return true;
    }

    /**
     * Determine whether the user can view the robot.
     *
     * @param  \App\User  $user
     * @param  \App\Robot  $robot
     * @return mixed
     */
    public function view(User $user, Robot $robot)
    {
        //
    }

    /**
     * Determine whether the user can create robots.
     * 
     * Everyone can create robots.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the robot.
     *
     * Editors can not update the robots they have not made.
     *
     * @param  \App\User  $user
     * @param  \App\Robot  $robot
     * @return mixed
     */
    public function update(User $user, Robot $robot)
    {
        return $user->id === $robot->user_id;
    }

    /**
     * Determine whether the user can delete the robot.
     *
     * Editors can only destroy the robots they have made.
     *
     * @param  \App\User  $user
     * @param  \App\Robot  $robot
     * @return mixed
     */
    public function delete(User $user, Robot $robot)
    {
        return $user->id === $robot->user_id;
    }
}
