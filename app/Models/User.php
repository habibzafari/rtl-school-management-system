<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Request;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    static public function getEamilSingle($email)
    {
        return User::where('email', '=', $email)->first();
    }

    static public function getTokenSingle($remember_token)
    {
        return User::where('remember_token', '=', $remember_token)->first();
    }

    static public function getAdmin()
    {
        $return =  self::select('users.*')
            ->where('user_type', '=', 1)
            ->where('is_delete', '=', 0);
        if (!empty(Request::get('name'))) {
            $return = $return->where('name', 'like', '%' . Request::get('name') . '%');
        }
        if (!empty(Request::get('email'))) {
            $return = $return->where('email', 'like', '%' . Request::get('email') . '%');
        }

        $return =  $return->orderBy('id', 'desc')->paginate(3);
        return $return;
    }

    static public function getParent()
    {
        $return =  self::select('users.*')
            ->where('user_type', '=', 4)
            ->where('is_delete', '=', 0);
        if (!empty(Request::get('name'))) {
            $return = $return->where('name', 'like', '%' . Request::get('name') . '%');
        }
        // if(!empty(Request::get('email'))){ 
        //     $return = $return->where('email', 'like', '%'.Request::get('email').'%');
        // }

        $return =  $return->orderBy('id', 'desc')->paginate(3);
        return $return;
    }

    static public function getStudent()
    {
        $return =  self::select('users.*', 'class.name as class_name', 'parent.name as parent_name')
            ->join('users as parent', 'parent.id', '=', 'users.parent_id', 'left')
            ->join('class', 'class.id', '=', 'users.class_id', 'left')
            ->where('users.user_type', '=', 3)
            ->where('users.is_delete', '=', 0);
        if (!empty(Request::get('name'))) {
            $return = $return->where('users.name', 'like', '%' . Request::get('name') . '%');
        }
        if (!empty(Request::get('roll_number'))) {
            $return = $return->where('users.roll_number', 'like', '%' . Request::get('roll_number') . '%');
        }
        if (!empty(Request::get('admission_number'))) {
            $return = $return->where('users.admission_number', 'like', '%' . Request::get('admission_number') . '%');
        }
        if (!empty(Request::get('email'))) {
            $return = $return->where('users.email', 'like', '%' . Request::get('email') . '%');
        }

        $return =  $return->orderBy('users.id', 'desc')->paginate(3);
        return $return;
    }

    static public function getTeacher(){
        $return =  self::select('users.*')
            ->where('users.user_type', '=', 2)
            ->where('users.is_delete', '=', 0);
        if (!empty(Request::get('name'))) {
            $return = $return->where('users.name', 'like', '%' . Request::get('name') . '%');
        }
        if (!empty(Request::get('email'))) {
            $return = $return->where('users.email', 'like', '%' . Request::get('email') . '%');
        }
        $return =  $return->orderBy('users.id', 'desc')->paginate(3);
        return $return;
    }
    static public function getTeacherClass(){
        $return =  self::select('users.*')
            ->where('users.user_type', '=', 2)
            ->where('users.is_delete', '=', 0);
        // if (!empty(Request::get('name'))) {
        //     $return = $return->where('users.name', 'like', '%' . Request::get('name') . '%');
        // }
        // if (!empty(Request::get('email'))) {
        //     $return = $return->where('users.email', 'like', '%' . Request::get('email') . '%');
        // }
        $return =  $return->orderBy('users.id', 'desc')->get();
        return $return;
    }
    
    static public function getSearchStudent()
    {
        if (!empty(Request::get('id')) || !empty(Request::get('name')) || !empty(Request::get('roll_number'))) {
            $return =  self::select('users.*', 'class.name as class_name', 'parent.name as parent_name')
                ->join('users as parent', 'parent.id', '=', 'users.parent_id', 'left')
                ->join('class', 'class.id', '=', 'users.class_id', 'left')
                ->where('users.user_type', '=', 3)
                ->where('users.is_delete', '=', 0);
            if (!empty(Request::get('id'))) {
                $return = $return->where('users.id', '=', Request::get('id'));
            }
            if (!empty(Request::get('name'))) {
                $return = $return->where('users.name', 'like', '%' . Request::get('name') . '%');
            }
            if (!empty(Request::get('roll_number'))) {
                $return = $return->where('users.roll_number', 'like', '%' . Request::get('roll_number') . '%');
            }

            $return =  $return->orderBy('users.id', 'desc')
                ->limit(50)
                ->get();
            return $return;
        }
    }

    static public function getMyStudent($parent_id)
    {
            $return =  self::select('users.*', 'class.name as class_name', 'parent.name as parent_name')
                ->join('users as parent', 'parent.id', '=', 'users.parent_id')
                // ->join('users as parent', 'parent.id', '=', 'users.parent_id', 'left')
                ->join('class', 'class.id', '=', 'users.class_id', 'left')
                ->where('users.user_type', '=', 3)
                ->where('users.parent_id', '=', $parent_id)
                ->where('users.is_delete', '=', 0)
                ->orderBy('users.id', 'desc')
                ->get();
            return $return;
    }

    static public function getSingle($id)
    {
        return self::find($id);
    }

    public function getProfile()
    {
        $filePath = public_path('upload/profile/' . $this->profile_pic);

        if (!empty($this->profile_pic) && file_exists($filePath)) {
            return url('upload/profile/' . $this->profile_pic);
        }

        return null;
    }

    static public function getTeacherStudent($teacher_id)
    {
        $return =  self::select('users.*', 'class.name as class_name',)
            // ->join('users as parent', 'parent.id', '=', 'users.parent_id', 'left')
            ->join('class', 'class.id', '=', 'users.class_id')
            ->join('assign_class_teacher', 'assign_class_teacher.class_id', '=', 'users.class_id')
            ->where('assign_class_teacher.teacher_id', '=', $teacher_id)
            ->where('assign_class_teacher.status', '=', 0)
            ->where('assign_class_teacher.is_delete', '=', 0)
            ->where('users.is_delete', '=', 0)
            ->where('users.user_type', '=', 3)
            ->where('users.is_delete', '=', 0);
        // if (!empty(Request::get('name'))) {
        //     $return = $return->where('users.name', 'like', '%' . Request::get('name') . '%');
        // }
        // if (!empty(Request::get('roll_number'))) {
        //     $return = $return->where('users.roll_number', 'like', '%' . Request::get('roll_number') . '%');
        // }
        // if (!empty(Request::get('admission_number'))) {
        //     $return = $return->where('users.admission_number', 'like', '%' . Request::get('admission_number') . '%');
        // }
        // if (!empty(Request::get('email'))) {
        //     $return = $return->where('users.email', 'like', '%' . Request::get('email') . '%');
        // }

        $return =  $return->orderBy('users.id', 'desc')
        ->groupBy('users.id')
        ->paginate(3);
        return $return;
    }
}
