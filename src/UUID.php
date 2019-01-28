<?php

namespace UUID;

/**
 * @author Gabriel Polverini <polverini.gabriel@gmail.com>
 */
class UUID implements UUIDInterface
{
    const UUID_VERSION_4 = 4;

    /**
     * UUID constructor.
     */
    public function __construct()
    {
    }

    /**
     * @param $version
     * @return string|false
     */
    private function generate($version)
    {
        switch ($version) {
            // A Version 4 UUID is a universally unique identifier that is generated using random numbers.
            case self::UUID_VERSION_4:
                if (function_exists('com_create_guid') === true) {
                    return trim(com_create_guid(), '{}'); // @codeCoverageIgnore
                }

                $rnd = openssl_random_pseudo_bytes(16);
                assert(strlen($rnd) == 16);
                $rnd[6] = chr(ord($rnd[6]) & 0x0f | 0x40);
                $rnd[8] = chr(ord($rnd[8]) & 0x3f | 0x80);

                return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($rnd), 4));
            default:
                return false;
        }
    }

    /**
     * GUID (or UUID) is an acronym for 'Globally Unique Identifier' (or 'Universally Unique Identifier').
     * It is a 128-bit integer number used to identify resources.
     *
     * @param string|null $input
     *
     * @return string|false
     */
    public function v4($input = null)
    {
        if (empty($input)) {
            return $this->generate(self::UUID_VERSION_4);
        }

        if (strlen($input) !== 16) {
            return false;
        }

        $first4 = substr($input, 0, 4);
        $first4 = strrev($first4);

        $second2 = substr($input, 4, 2);
        $second2 = strrev($second2);

        $third2 = substr($input, 6, 2);
        $third2 = strrev($third2);

        $output = $first4.$second2.$third2.substr($input, 8, 8);

        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(strtoupper(bin2hex($output)), 4));
    }
}
