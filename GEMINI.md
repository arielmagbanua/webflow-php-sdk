# PHP Webflow SDK

This project is a PHP SDK for the Webflow Data API, designed to provide a clean and structured way to interact with Webflow's CMS and other resources.

## Project Overview

- **Technologies:** PHP 8.1+, GuzzleHttp.
- **Architecture:** 
    - **Base Layer:** `BaseApi` handles the Guzzle HTTP client configuration.
    - **Data API Layer:** `Api` extends `BaseApi` to manage authentication (Bearer tokens) and versioning.
    - **Contracts:** Abstract classes in `src/DataApi/Cms/.../Contracts/` define the interface for each resource.
    - **Versions:** Concrete implementations are versioned (e.g., `src/DataApi/Versions/V2/`).
- **Namespace:** `ArielMagbanua\PhpWebflowApi`

## Building and Running

### Prerequisites
- PHP 8.1 or higher
- Composer

### Key Commands
- `composer install`: Install all project dependencies.
- `composer test`: Run unit tests using PHPUnit.
- `composer phpstan`: Run static analysis to check for type errors and potential bugs.
- `composer format`: Automatically fix code style issues using PHP-CS-Fixer.
- `composer check`: Check for code style issues without fixing them.
- `make test`: A shortcut that runs style check, static analysis, and tests.
- `make clean`: A shortcut for `composer format`.

## Development Conventions

- **Strict Typing:** All PHP files must include `declare(strict_types=1);`.
- **Coding Style:** Adhere to PSR-12/PHP-CS-Fixer standards. Use `composer format` before committing.
- **Type Safety:** Use PHP 8.1+ type hinting for properties, parameters, and return types.
- **Documentation:** Provide PHPDoc blocks for all classes and public methods, including `@param`, `@return`, and `@link` to official Webflow API documentation.
- **Contracts:** When adding new API resources or versions, follow the existing pattern of defining an abstract contract and then a versioned implementation.
- **Testing:** New features should be accompanied by unit tests in the `tests/` directory. Mock HTTP responses using Guzzle's MockHandler where appropriate.
