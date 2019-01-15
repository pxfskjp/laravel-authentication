<?php

namespace App\Role;


class UserRole
{
    const ROLE_ADMIN = 'ROLE_ADMIN';
    const ROLE_MODERATOR = 'ROLE_MODERATOR';
    const ROLE_SUPPORT = 'ROLE_SUPPORT';

    /**
     * @var array
     */
    protected static $roleHierarchy = [
        self::ROLE_ADMIN => ['*'],
        self::ROLE_MODERATOR => [],
        self::ROLE_SUPPORT => []
    ];

    /**
     * @param string $role
     * @return array
     */
    public static function getAllowedRoles(string $role)
    {
        return isset(self::$roleHierarchy[$role]) ? self::$roleHierarchy[$role] : [];
    }

    /***
     * @return array
     */
    public static function getRoleList()
    {
        return [
            static::ROLE_ADMIN =>'Admin',
            static::ROLE_MODERATOR => 'Moderator',
            static::ROLE_SUPPORT => 'Support'
        ];
    }
}
