<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['fname','mname','lname','gender','birthdate', 'email', 'password','addr1','addr2',
            'city','state','country','zip','phone','mobile','accesslevel'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];


        public function courses(){
            
            return $this->hasMany('App\Course');
            
        }
        
        public function degrees(){
            return $this->hasMany('App\Degree');
        }
        
       public function interests(){
            return $this->hasMany('App\Interest');
        }

        public function requirements(){
            return $this->hasMany('\App\Requirement');
        }
        
        public function studentInfos(){
            
            return $this->hasMany('\App\StudentInfo');
        }
       }
