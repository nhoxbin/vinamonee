<?php

namespace App\Policies;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CustomerPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Customer $customer) {

    }

    public function update(User $user, Customer $customer) {

    }

    public function delete(User $user, Customer $customer) {
        return $user->hasRole('admin');
    }

    public function forceDelete(User $user, Customer $customer) {
        return $user->hasRole('admin');
    }
}
