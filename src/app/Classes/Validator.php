<?php 

namespace App\Classes;

use Respect\Validation\Exceptions\NestedValidationException;

class Validator 
{
    protected $errors = [];

    public function validate(array $request, array $rules)
    {
        foreach ($rules as $field => $rule) {
            try {
                $rule->setName(ucfirst($field))->assert($request[$field]);
            } catch (NestedValidationException $e) {
                $this->errors[$field] = $e->getMessages();
            }
        }

        return $this;
    }

    public function fails()
    {
        return !empty($this->errors);
    }
}