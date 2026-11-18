# jouwhoesje-api (Composer package)

Package `keihartonline/jouwhoesje-api` (namespace `KeihartOnline\JouwHoesjeApi\`, Laravel 12, PHP 8.2+). Het contract tussen de backend en de website: DTO's, enums, HTTP-client, vertalingen. Geen eigen app, geen tests, geen database.

## Gerelateerde repo's

Drie repo's onder `~/Git/keihartonline/`:

| Repo | Rol |
| --- | --- |
| `jouwhoesje-api` (deze) | DTO's, enums, `ApiClient`/`ApiService`, vertalingen |
| `jouwhoesje-backend` | Server van de API (api.jouwhoesje.nl) en beheer. Push naar `main` is daar direct een deploy via Laravel Forge |
| `jouwhoesje-website` | Consumeert het package om de API aan te roepen |

- Beide apps halen dit package binnen als VCS-dependency (`repositories` in hun `composer.json`, GitHub `keihartonline/jouwhoesje-api`) en pinnen op een git-tag via `composer.lock`. Een commit hier doet dus niets voor de apps tot er getagd is en `composer update keihartonline/jouwhoesje-api` is gedraaid.
- De **backend** bouwt de JSON die de DTO's hier lezen (`app/Http/Controllers/Api`, `app/Http/Resources/Api`). De **website** gebruikt de DTO's. Een DTO-wijziging raakt daarom altijd beide kanten.

## Werkwijze bij een wijziging

1. Pas hier de DTO/enum/`ApiService`-methode aan en commit (direct op `main`, `CHG: <lowercase samenvatting>`).
2. De gebruiker pusht en tagt zelf (`vX.Y.Z`, patchnummer loopt elke release op, nu rond `v1.1.32x`). Niet zelf pushen of taggen.
3. Backend: `composer update keihartonline/jouwhoesje-api`, API-response aanpassen zodat hij bij de nieuwe DTO past. Website: package updaten en gebruiken.
4. Deploy-volgorde bij breaking changes (veld hernoemd/verwijderd): backend eerst, website direct erna. `fromArray` leest met `$data['x']` (kan breken bij ontbrekende sleutel); voor nieuwe velden dus `?? default` gebruiken zolang de backend nog niet live is, of backend eerst deployen.
5. Check `git log` in alle drie de repo's: wijzigingen worden soms teruggedraaid (revert-commits) om performance te testen, en de apps kunnen op een oudere tag staan dan de nieuwste.

## Structuur

- `src/Dto/` — `final class ...Dto` met publieke constructor-properties en een `static fromArray(array $data): self`. Sleutels in de JSON zijn snake_case, properties camelCase (`suggested_retail_price` -> `suggestedRetailPrice`). Kleine afgeleide helpers op de DTO (`firstMediaUrl()`, `isSellable()`) mogen, maar geen API-calls of cache.
- Geneste DTO's en enums worden in `fromArray` omgezet (`array_map(fn ($row) => XDto::fromArray($row), ...)`, `Enum::from()`; `tryFrom()` bij optionele enums). Array-types documenteer je met `@param Dto[] $x` op de constructor, dat is de plek waar docblocks wel nuttig zijn.
- `src/Enums/` — backed enums; waarde = string die de backend stuurt. Houd waarden synchroon met de enums in de backend (`app/Enums`).
- `src/ApiService.php` — één publieke methode per endpoint, geeft DTO('s) terug. Paginering als `LengthAwarePaginator`. Zet cart/order-token vanuit cookies (`cart_token`, `order_token`).
- `src/ApiClient.php` — dunne `Http`-wrapper: base URL uit `config('jouwhoesje-api.base_url')` (env `JOUWHOESJE_API_BASE_URL`), Bearer-token via `TokenResolverInterface`, throwt `ApiException`. Timeouts laat het package aan de applicatie (`Http::globalOptions` in de website); `setTimeout` geldt voor één request. Een call die langer mag duren (bv. btw-validatie, add-to-cart van een custom design) krijgt een expliciete timeout in `ApiService`.
- `src/Contracts/TokenResolverInterface.php` — de app implementeert hem (website: `DomainBaseTokenResolver`, token per domein).
- `src/Providers/JouwHoesjeApiServiceProvider.php` — auto-discovery via `composer.json` `extra.laravel.providers`; merge config en laadt JSON-vertalingen.
- `src/lang/<locale>.json` — vertalingen voor enum-labels en retourredenen. Key is de **Nederlandse bronzin** (er is geen `nl_NL.json`), waarde per locale: `de_DE`, `es_ES`, `fr_FR`, `nl_BE`. Nieuwe tekst/enum-label altijd in alle vier toevoegen.

## Stijl

- Zo min mogelijk poespas: geen docblocks die de methode herhalen, geen "wat"-comments. `@throws Throwable` op `ApiService`-methoden en `@param`/`@return` voor array-types volgen de bestaande stijl.
- Laravel Pint (`vendor/bin/pint --dirty`), 4 spaties, LF. Geen eigen test- of CI-setup.
- Bedragen zijn integers in centen (`price`, `suggestedRetailPrice`); formatteren doet de website.
- Veld hernoemen of verwijderen is breaking: liever eerst toevoegen, apps laten migreren, daarna oude veld weghalen (zo ging het bij `express_credit` -> `suggested_retail_price`).
