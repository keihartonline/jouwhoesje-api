# JouwHoesje API Package

Dit pakket biedt een eenvoudige manier om te communiceren met de JouwHoesje API.

---

## Vereisten

### Stel in je `.env` bestand de basis URL van de API in:

```env
JOUWHOESJE_BASE_URL=https://api.jouwhoesje.nl
```

---

### Token Resolver Interface 

Om de API te gebruiken moet je zelf een implementatie maken van de `TokenResolverInterface`. Deze interface bepaalt welke API-token wordt gebruikt voor de huidige API-aanroep.

Maak een eigen class die deze interface implementeert, bijvoorbeeld:

```php
<?php
namespace App\Services;

use KeihartOnline\JouwHoesjeApi\Contracts\TokenResolverInterface;

class TokenResolver implements TokenResolverInterface
{
    public function resolveToken(): ?string
    {
        // Hier je eigen logica om de juiste token te bepalen,
        // bijvoorbeeld op basis van de huidige domain, gebruiker, etc.
        return 'jouw-api-token-hier';
    }
}
```

**Registreren in de service container** 

Registreer je implementatie zodat de package deze kan gebruiken, bijvoorbeeld in een Laravel Service Provider:

```php
$this->app->bind(
    \KeihartOnline\JouwHoesjeApi\Contracts\TokenResolverInterface::class,
    \App\Services\TokenResolver::class
);
```

---

### Timeouts

Het pakket stelt zelf geen connect- of totale timeout in. Stel die in de applicatie
in voor alle uitgaande Http-calls, bijvoorbeeld in een service provider:

```php
Http::globalOptions([
    'connect_timeout' => 2,
    'timeout' => 5,
]);
```

Een enkele call kan dit overschrijven met `ApiClient::setTimeout()` (geldt alleen voor de
eerstvolgende request, bijvoorbeeld bij uploads).
