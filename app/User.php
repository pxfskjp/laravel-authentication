<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable,HasApiTokens;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'login', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];

    /**
     * Laravel passport - identity custom column selection
     *
     * @var string
     * @return User
     */
    public function findForPassport($identity) {
        $columnName = filter_var($identity, FILTER_VALIDATE_EMAIL)
            ? 'email' : 'login';
        return $this->where($columnName, $identity)->first();
    }

    public function messages(){
        return $this->hasMany('App\Message');
    }

    public function chats(){
        return $this->hasMany('App\Chat');
    }

    /**
     * The attributes that should be casted to array
     *
     * @var array
     */
    protected $casts = [
        'roles' => 'array',
    ];

    /***
     * Adds a new role for the current user
     *
     * @param string $role
     * @return $this
     */
    public function addRole(string $role)
    {
        $roles = $this->getRoles();
        $roles[] = $role;
        return $this->setRoles(array_unique($roles));
    }

    /**
     * @param array $roles
     * @return $this
     */
    public function setRoles(array $roles)
    {
        $this->setAttribute('roles', $roles);
        return $this;
    }

    /***
     * Check if the current role available in user roles
     *
     * @param $role
     * @return mixed
     */
    public function hasRole($role)
    {
        return in_array($role, $this->getRoles());
    }

    /***
     * @param $roles
     * @return mixed
     */
    public function hasRoles($roles)
    {
        $currentRoles = $this->getRoles();
        foreach($roles as $role) {
            if (!in_array($role, $currentRoles)) return false;
        }
        return true;
    }

    /**
     * @return array
     */
    public function getRoles()
    {
        $roles = $this->getAttribute('roles');
        return is_null($roles) ? [] : $roles;
    }
}
