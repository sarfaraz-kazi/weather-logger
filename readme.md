# Weather Logger Plugin

The Weather Logger is a robust, object-oriented WordPress plugin designed to seamlessly log, manage, and display meteorological data. Built with modern WordPress development standards, it leverages the Gutenberg block editor, React, and custom REST API endpoints to provide a frictionless experience for both end-users and third-party developers.

## 🚀 Key Features

* **Custom Post Type Registration:** Automatically registers a robust `weather` post type to handle data natively within WordPress.
* **Interactive Form Block:** Provides a dedicated WordPress block to insert a weather submission form on any page.
    * Captures `date`, `location`, and `weather` information via frontend AJAX submission.
    * Restricts submissions to authenticated users and includes strict data validation with immediate UI feedback.
* **Dynamic Weather Display Block:**
    * A customizable editor block that displays chronological weather data entries.
    * Supports dynamic filtering via query parameters (e.g., date, location, weather conditions) to tailor data to site visitors.
* **Custom REST API Integration:** Includes dedicated endpoints for both inserting and retrieving weather data, ensuring extensibility for third-party applications.

## 🛠️ System Requirements

* **PHP:** 8.1 or higher.
* **WordPress:** Latest version.

## 📂 Project Structure

The codebase strictly follows Object-Oriented Programming (OOP) principles and specific class-naming conventions.

    ├── docs/                   # Plugin documentation
    ├── src/
    │   ├── admin-views/        # Administrative templates
    │   ├── assets/
    │   │   ├── css/            # Stylesheets (current-weather.css, style.css)
    │   │   └── js/             # Scripts (blocks.js, weather.js)
    │   ├── views/              # Frontend templates (weather-form.php)
    │   └── Weather/            # Core PHP Logic
    │       ├── Endpoints/      # API Endpoint handlers
    │       ├── REST/           # REST API routing and logic
    │       ├── Assets.php      # Enqueueing scripts/styles
    │       ├── Blocks.php      # Block registration and rendering
    │       ├── Current_Weather.php 
    │       ├── Plugin.php      # Main plugin bootstrap
    │       └── Post_Type.php   # Custom Post Type registration
    ├── tests/                  # Automated testing suites
    ├── composer.json           # PHP dependencies and tooling scripts
    ├── phpstan.neon.dist       # PHPStan configuration
    └── weather.php             # Main plugin file
    
**

## 🔌 REST API Documentation

The plugin exposes custom REST API endpoints designed for standard WordPress authentication (e.g., Application Passwords, OAuth).

### 1. Save Weather Data
* **Method:** `POST`
* **Description:** Programmatically insert new weather data. 
* **Payload Requirements:** Must include `date`, `location`, and `weather` fields. Data is securely stored as post meta.
* **Response:** Returns a success message or specific validation errors.

### 2. Retrieve Weather Data
* **Method:** `GET`
* **Description:** Fetch a list of weather data entries.
* **Sorting & Pagination:** Data is returned sorted ascendingly by date, then by location. Supports pagination parameters to limit records per page.

## 🧑‍💻 Development & Testing

This project includes advanced tooling to ensure code quality and maintainability:

* **Static Analysis:** PHPStan is configured and can be executed using `composer run test:analysis`.
* **Testing Suites:** * **PHP Tests:** Codeception tests can be run using the StellarWP `slic` CLI tool via the `wpunit` suite.
    * **JS/React Tests:** Set up Jest to validate the integrity of the custom Gutenberg blocks and React components.