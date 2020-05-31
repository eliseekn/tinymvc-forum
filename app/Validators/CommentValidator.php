<?php

namespace App\Validators;

use Framework\Http\Request;
use GUMP;

/**
 * CommentValidator
 * 
 * Validate comment inputs
 */
class CommentValidator extends Request
{
    /**
     * rules
     *
     * @return array
     */
    public function rules(): array
    {
        return [
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
            'content' => [
                'required' => 'Vous n\'avez pas renseigné le contenu de votre réponse.'
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