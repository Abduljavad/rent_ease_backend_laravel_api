<?php

namespace App\Policies;

use App\Entities\Property;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class PropertyPolicy
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        return $user->isSuperAdmin() ?: null;
    }
    /**
     * Determine whether the user can access the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Model  $model
     * @return bool
     */
    public function accessProperty(User $user, Property $model)
    {
        return $user->id === $model->user_id
            ? Response::allow()
            : Response::deny('Forbidden');
    }

    public function store(User $user)
    {
        return $user->hasRole('land_lord')
            ? Response::allow()
            : Response::deny('Forbidden');
    }
}
