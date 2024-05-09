<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class InStock implements Rule
{
    private $msg;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(private $model, private $columns = [])
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
    public function passes($attribute, $param)
    {
        $query = (new $this->model)->query();

        foreach ($this->columns as $key => $value) {
            $query->where($key, $value);
        }

        $child = $query->where("id", $param)->first();


        if (!$child) {
            $this->msg = "invalid $attribute";
            return false;
        }

        if ($child->stock < 1) {
            $this->msg = "$attribute out of stocks";
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->msg;
    }
}
