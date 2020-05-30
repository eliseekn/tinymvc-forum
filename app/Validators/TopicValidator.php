<?php

namespace App\Validators;

use Framework\Http\Request;
use GUMP;

/**
 * TopicValidator
 * 
 * Validate topic inputs
 */
class TopicValidator extends Request
{
    /**
     * rules
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'title' => 'required',
            'content' => 'required'
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
            'title' => [
                'required' => 'Vous n\'avez pas renseigné le titre de votre sujet.',
            ],
            'content' => [
                'required' => 'Vous n\'avez pas renseigné le contenu de votre message.'
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