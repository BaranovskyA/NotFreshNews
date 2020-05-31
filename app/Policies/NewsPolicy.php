<?php

namespace App\Policies;

use App\News;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class NewsPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, News $news)
    {
        return true;
    }

    public function create(User $user)
    {
        return $user->name == 'admin';
    }

    public function update(User $user, News $news)
    {
        return $user->name == 'admin';
    }

    public function delete(User $user, News $news)
    {
        return $user->name == 'admin';
    }
}
