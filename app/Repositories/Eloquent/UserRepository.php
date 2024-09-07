<?php

namespace App\Repositories\Eloquent;

use App\Models\User;

class UserRepository extends AbstractRepository
{
    public function __construct(User $model){
        parent::__construct($model);
    }
}
