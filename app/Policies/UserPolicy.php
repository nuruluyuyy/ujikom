<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->is_admin || $user->is_super_admin;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): bool
    {
        // Admin atau super admin bisa melihat detail user
        // User biasa hanya bisa melihat profil sendiri
        return $user->is_admin || 
               $user->is_super_admin || 
               $user->id === $model->id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Hanya super admin yang bisa membuat user admin baru
        return $user->is_super_admin;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): bool
    {
        // Super admin bisa mengupdate semua user
        if ($user->is_super_admin) {
            return true;
        }

        // Admin biasa hanya bisa mengupdate profil sendiri
        if ($user->is_admin) {
            return $user->id === $model->id;
        }

        // User biasa hanya bisa mengupdate profil sendiri
        return $user->id === $model->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        // Tidak bisa menghapus akun sendiri
        if ($user->id === $model->id) {
            return false;
        }

        // Hanya super admin yang bisa menghapus user
        // Tidak bisa menghapus super admin lain
        return $user->is_super_admin && !$model->is_super_admin;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
        return $user->is_super_admin;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        // Hanya super admin yang bisa menghapus permanen
        // Tidak bisa menghapus akun sendiri
        return $user->is_super_admin && $user->id !== $model->id;
    }

    /**
     * Determine whether the user can change admin status.
     */
    public function changeAdminStatus(User $user, User $model): bool
    {
        // Hanya super admin yang bisa mengubah status admin
        // Tidak bisa mengubah status sendiri
        return $user->is_super_admin && $user->id !== $model->id;
    }

    /**
     * Determine whether the user can change super admin status.
     */
    public function changeSuperAdminStatus(User $user, User $model): bool
    {
        // Hanya super admin yang bisa mengubah status super admin
        // Tidak bisa mengubah status sendiri
        return $user->is_super_admin && $user->id !== $model->id;
    }
}