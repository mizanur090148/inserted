<?php

namespace App\Http\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\UserProject;

class UserWiseUniqueProject implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $value = strtoupper($value);

        $user_project = UserProject::where([
            $attribute => $value,
            'user_id' => request('user_id')
        ]);          

        if (request()->route('id')) {
            $user_project = $user_project->where('id', '!=', request()->route('id'));
        }

        $user_project = $user_project->first();

        return $user_project ? false : true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'This project already assignrd for this user.';
    }
}
