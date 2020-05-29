<?php

namespace App\Validators;

use Framework\Http\Request;
use GUMP;

/**
 * LoginValidator
 */
class LoginValidator extends Request
{
    /**
     * rules
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'email' => 'required|valid_email',
            'password' => 'required'
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
            'email' => [
                'required' => 'Vous n\'avez pas renseigné votre adresse email.',
                'valid_email' => 'Votre adresse email n\'est pas valide.'
            ],
            'password' => ['required' => 'Vous n\'avez pas renseigné votre mot de passe.']
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