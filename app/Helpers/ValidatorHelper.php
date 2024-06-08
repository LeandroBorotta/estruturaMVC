<?php

namespace App\Helpers;
class ValidatorHelper
{
    protected $data;
    protected $rules;
    protected $errors = [];

    public function __construct($data, $rules)
    {
        $this->data = $data;
        $this->rules = $rules;
    }

    public function validate()
    {
        foreach ($this->rules as $field => $rule) {
            $rules = explode('|', $rule);
            foreach ($rules as $singleRule) {
                $this->applyRule($field, $singleRule);
            }
        }
        return empty($this->errors);
    }

    protected function applyRule($field, $rule)
    {
        $parameters = [];
        if (strpos($rule, ':') !== false) {
            list($rule, $parameters) = explode(':', $rule, 2);

            $parameters = explode(',', $parameters);
        }
        $value = $this->data[$field] ?? null;
        switch ($rule) {
            case 'required':
                if (empty($value)) {
                    $this->addError($field, 'O campo é obrigatório.');
                }
                break;
            case 'email':
                if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->addError($field, 'O campo deve ser um endereço de e-mail válido.');
                }
                break;
            case 'min':
                if (strlen($value) < $parameters[0]) {
                    $this->addError($field, 'O campo deve ter pelo menos ' . $parameters[0] . ' caracteres.');
                }
                break;

        }
    }

    protected function addError($field, $message)
    {
        $this->errors[$field][] = $message;
    }

    public function errors()
    {
        return $this->errors;
    }
}

