# Weather Logger

Weather Logger is a WordPress plugin for collecting and displaying weather entries.
It stores submissions in a custom `weather` post type, exposes custom REST endpoints,
and provides Gutenberg blocks for submitting and listing entries.

## Features

- Registers a private `weather` custom post type with an admin UI.
- Provides a `weather/form` block for submitting weather entries.
- Provides a `weather/list` block for rendering saved entries.
- Saves and retrieves entries through custom REST API routes.
- Loads a simple frontend script for Ajax form submission and list refresh.
- Displays a current forecast panel sourced from `api.weather.gov`.

## Requirements

- PHP 8.1+
- WordPress
- Composer for installing development dependencies and generating `vendor/autoload.php`

## Installation

1. Copy this plugin into your WordPress plugins directory, for example:

```text
wp-content/plugins/weather-logger
```

2. Install dependencies:

```bash
composer install
```

3. Activate the plugin from the WordPress admin.

## How It Works

### Data Storage

Weather entries are stored as `weather` posts with the following post meta:

- `date`
- `location`
- `weather`

When a new entry is submitted for the same date and location, the plugin updates the
existing record instead of creating a duplicate.

### Gutenberg Blocks

The plugin registers two server-rendered blocks:

- `weather/form`
  - Renders the frontend submission form.
  - Supports a `requireLogin` attribute.
  - Defaults to requiring a logged-in user for form access.
- `weather/list`
  - Renders a list of saved weather entries.
  - Supports `location`, `date_from`, and `date_to` attributes.
  - Includes a refresh button that reloads entries through the REST API.

### Frontend Behavior

The form submits data asynchronously to the REST API using the localized endpoints in
`src/assets/js/weather.js`. The rendered form also shows:

- A "Current Weather in Monowi, Nebraska" section fetched from `https://api.weather.gov/gridpoints/TOP/31,80/forecast`
- A list of recent submissions

## REST API

Namespace: `weather/v1`

### `POST /wp-json/weather/v1/save`

Creates or updates a weather entry.

- Authentication: required
- Permission check: user must have `edit_posts`
- Required fields:
  - `date`
  - `location`
  - `weather`

Example:

```bash
curl -X POST http://example.com/wp-json/weather/v1/save \
  -H "X-WP-Nonce: <nonce>" \
  -d "date=2026-05-11" \
  -d "location=Chicago" \
  -d "weather=rain"
```

### `GET /wp-json/weather/v1/get`

Returns weather entries.

- Authentication: public
- Query parameters:
  - `date_from`
  - `date_to`
  - `location`
  - `page`
  - `per_page`

Example:

```bash
curl "http://example.com/wp-json/weather/v1/get?location=Chicago&per_page=5"
```

Response shape:

```json
{
  "dates": [
    {
      "date": "2026-05-11",
      "location": "Chicago",
      "weather": "rain"
    }
  ]
}
```

### `GET /wp-json/weather/v1/group`

Returns all saved entries grouped by date.

- Authentication: public

Example:

```bash
curl "http://example.com/wp-json/weather/v1/group"
```

## Development

### Project Layout

```text
weather-logger/
├── docs/
├── src/
│   ├── admin-views/
│   ├── assets/
│   │   ├── css/
│   │   └── js/
│   ├── views/
│   └── Weather/
│       ├── Endpoints/
│       ├── REST/
│       ├── Assets.php
│       ├── Blocks.php
│       ├── Current_Weather.php
│       ├── Plugin.php
│       └── Post_Type.php
├── tests/
├── composer.json
├── phpstan.neon.dist
├── readme.md
└── weather.php
```

### Useful Commands

Install dependencies:

```bash
composer install
```

Run static analysis:

```bash
composer run test:analysis
```

### Testing

The repository includes Codeception/wp-browser test scaffolding under `tests/`.
The current test suite covers plugin bootstrap and REST route registration.

The `wpunit` suite expects WordPress test environment variables, including:

- `WP_ROOT_FOLDER`
- `WP_TEST_DB_NAME`
- `WP_TEST_DB_HOST`
- `WP_TEST_DB_USER`
- `WP_TEST_DB_PASSWORD`
- `WP_TABLE_PREFIX`
- `WP_DOMAIN`

## Notes

- The main plugin file is `weather.php`.
- Composer autoloading maps the `Weather\\` namespace to `src/Weather/`.
- The current weather panel uses a hard-coded Weather.gov forecast endpoint.
