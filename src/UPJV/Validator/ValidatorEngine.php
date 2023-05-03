<?php

/**
 * Moteur de chargement des validateurs.
 */

namespace UPJV\Validator;

/**
 * Gére une liste de validateurs.
 * Un objet ValidatorEngine est capable de vérifier une donnée
 * à partir de sa liste. La validation est déclenchée par l'envoi
 * du message run( data ) et return si la donnée est valide ou non.
 */

class ValidatorEngine
{
    protected array $setOfValidator;

    public function __construct($json)
    {
        $json = json_decode($json, true);
        foreach ($json as $name => $contraintes) {
            foreach ($contraintes as $class => $params) {
                include_once __DIR__ . "/ValidatorInterface.php";
                include_once __DIR__ . "/$class.php";
                $className = '\UPJV\Validator\\' . $class;
                foreach ($params as $param) {
                    $validator = new $className();
                    $this->setOfValidator[$name][] = $validator->build($param);
                }
            }
        }
    }

    public function run(array $inputs): bool
    {
        foreach ($inputs as $name => $val) {
            if ("contrainte" === $name) {
                continue;
            }
            if (!array_key_exists($name, $this->setOfValidator)) {
                return false;
            }
            foreach ($this->setOfValidator[$name] as $validator) {
                if (!$validator->check($val)) {
                    return false;
                }
            }
        }

        return true;
    }
}

