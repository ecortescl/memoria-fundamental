<?php

namespace App\Policies;

use App\Models\Producto;
use App\Models\User;

/**
 * Policy para Producto
 * 
 * Las Policies encapsulan la lógica de autorización.
 * Mantienen los controladores limpios y la lógica centralizada.
 * 
 * Se pueden usar con:
 * - $this->authorize('update', $producto) en controllers
 * - @can('update', $producto) en Blade
 * - Gate::allows('update', $producto) en código
 */
class ProductoPolicy
{
    /**
     * Determina si el usuario puede ver cualquier producto
     */
    public function viewAny(User $user): bool
    {
        // Todos los usuarios autenticados pueden ver productos
        return true;
    }

    /**
     * Determina si el usuario puede ver un producto específico
     */
    public function view(User $user, Producto $producto): bool
    {
        // Puede ver si está activo o si es admin
        return $producto->activo || $user->isAdmin();
    }

    /**
     * Determina si el usuario puede crear productos
     */
    public function create(User $user): bool
    {
        // Solo admins y managers pueden crear
        return $user->isAdmin() || $user->isManager();
    }

    /**
     * Determina si el usuario puede actualizar el producto
     */
    public function update(User $user, Producto $producto): bool
    {
        // Admins pueden actualizar cualquier producto
        if ($user->isAdmin()) {
            return true;
        }

        // Managers solo pueden actualizar productos activos
        if ($user->isManager()) {
            return $producto->activo;
        }

        return false;
    }

    /**
     * Determina si el usuario puede eliminar el producto
     */
    public function delete(User $user, Producto $producto): bool
    {
        // Solo admins pueden eliminar
        // Y solo si no tiene ventas asociadas
        return $user->isAdmin() && !$producto->tieneVentas();
    }

    /**
     * Determina si el usuario puede restaurar el producto
     */
    public function restore(User $user, Producto $producto): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determina si el usuario puede eliminar permanentemente
     */
    public function forceDelete(User $user, Producto $producto): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determina si el usuario puede cambiar el precio
     */
    public function updatePrice(User $user, Producto $producto): bool
    {
        // Solo admins pueden cambiar precios
        return $user->isAdmin();
    }

    /**
     * Determina si el usuario puede ver productos inactivos
     */
    public function viewInactive(User $user): bool
    {
        return $user->isAdmin() || $user->isManager();
    }
}
