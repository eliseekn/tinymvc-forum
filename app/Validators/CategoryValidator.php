<?php

namespace App\Validators;

use Framework\Http\Request;
use GUMP;

/**
 * CategoryValidator
 * 
 * Validate category inputs
 */
class CategoryValidator extends Request
{
    /**
     * rules
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'description' => 'required'
        ];
    }
    
    /**
     * messages
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'name' => [
                'required' => 'Vous n\'avez pas renseigné le nom du forum.',
            ],
            'description' => [
                'required' => 'Vous n\'avez pas renseigné la description du forum.'
            ]
        ];
    }
    
    /**
     * validate
     *
     * @return void
     */
    public function validate()
    {
        $is_valid = GUMP::is_valid($this->getInput(), $this->rules(), $this->messages());
        return $is_valid === true ? '' : $is_valid;
    } 
}