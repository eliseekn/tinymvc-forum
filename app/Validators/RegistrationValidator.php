<?php

namespace App\Validators;

use Framework\Http\Request;
use GUMP;

/**
 * RegistrationValidator
 * 
 * Validate registration inputs
 */
class RegistrationValidator extends Request
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
            'email' => 'required|valid_email',
            'department' => 'required|alpha_space',
            'password' => 'required|alpha_numeric|min_len,8'
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
                'required' => 'Vous n\'avez pas renseigné vos nom et prénoms.'
            ],
            'email' => [
                'required' => 'Vous n\'avez pas renseigné votre adresse email.',
                'valid_email' => 'Votre adresse email n\'est pas valide.'
            ],
            'department' => [
                'required' => 'Vous n\'avez pas renseigné votre filière d\'étude.',
                'alpha_space' => 'Votre filère d\'étude est incorecte.'
            ],
            'password' => [
                'required' => 'Vous n\'avez pas renseigné votre mot de passe.',
                'alpha_numeric' => 'Votre de mot de passe ne doit contenir que des chiffres et des lettres.',
                'min_len' => 'Votre mot de passe doit comprendre au moins 8 caractères.'
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