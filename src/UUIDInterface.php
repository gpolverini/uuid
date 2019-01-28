<?php

namespace UUID;

/**
 * @author Gabriel Polverini <polverini.gabriel@gmail.com>
 */
interface UUIDInterface
{
    /**
     * GUID (or UUID) is an acronym for 'Globally Unique Identifier' (or 'Universally Unique Identifier').
     * It is a 128-bit integer number used to identify resources.
     *
     * @param string|null $input
     *
     * @return string|false
     */
    public function v4($input = null);
}
