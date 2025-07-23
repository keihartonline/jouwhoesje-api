<?php

namespace KeihartOnline\JouwHoesjeApi\Contracts;

interface TokenResolverInterface
{
    /**
     * Determines which token to use for the current API request.
     *
     * @return string|null The token, or null if none is available.
     */
    public function resolveToken(): ?string;
}
