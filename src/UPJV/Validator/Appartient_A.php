<?php

/**
 * Fichier qui définit la classe Appartient_A.
 *
 * PHP version 7.4
 *
 * @category Validation
 * @package  UPJV\Validator
 * @author   Votre Nom <votre-email@example.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://example.com
 */

namespace UPJV\Validator;

/**
 * Classe Appartient_A qui implémente l'interface ValidatorInterface.
 *
 * @category Validation
 * @package  UPJV\Validator
 * @author   Votre Nom <votre-email@example.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://example.com
 */
class Appartient_A implements ValidatorInterface
{
    protected string $pattern;

    /**
     * Construit l'instance avec les paramètres donnés.
     *
     * @param array $param Les paramètres de construction.
     *
     * @return object L'instance construite.
     */
    public function build(array $param):object
    {
        if (!isset($param['pattern'])) {
            throw new \InvalidArgumentException(
                'Le pattern est nécessaire pour cette validation'
            );
        }

        $this->pattern = $param['pattern'];
        return $this;
    }

    /**
     * Vérifie si la valeur donnée correspond au pattern.
     *
     * @param mixed $value La valeur à vérifier.
     *
     * @return bool True si la valeur correspond, false sinon.
     */
    public function check($value): bool
    {
        return preg_match('/' . $this->pattern . '/', $value) === 1;
    }
}
