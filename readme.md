# Handy dandy weather logger - a trial project

Hi! This is a small project where you can show your knowledge of React, JavaScript, PHP, WordPress, and Object Oriented development. Ultimately, this is a plugin that does some simple things but in an OOP way. There are probably simpler ways to whip this together, but this is a trial on some specific things, so please keep that in mind. :)

* [Things we are looking for](#things-we-are-looking-for)
* [Plugin overview](#plugin-overview)
  * [Requirements](#requirements)
  * [Features](#features)
      * [User Stories](#user-stories) 
  * [Nice to haves](#nice-to-haves)
  * [Make this your own](#make-this-your-own)
* [Tooling](#tooling)
* [Testing](#testing)

## Things we are looking for

Before diving into the project, you should keep the following in mind:

1. You should **understand the project** fully before starting.
2. **Communication is key**! If there is something you don't understand or need clarification on, please ask.
3. Produce **clean and well-organized code**.
4. Follow the **[WordPress Coding Standards](https://developer.wordpress.org/coding-standards/)** with a couple of exceptions:
   1. Use short array syntax (`[]` instead of `array()`).
   2. Follow the naming convention that we've put in place in this project (where the file is named after the class, interface, trait, etc) rather than the `class-` prefixing from the WP standards.
5. Deliver the completed project within the agreed-upon timeline.
6. **Deliver the minimum requirements.** If there's something else you'd also like to showcase, feel free to do so!

## Plugin overview

**Handy Dandy Weather Logger Plugin for WordPress**

### Requirements

* Assume this will be running on a server using PHP 8.1 and the latest WordPress version.
* Use the blocks editor for any customization.
* Use OOP
* Localize all strings.
* Provide hooks for reasonable customization by 3rd party developers.
* Document (in a `.md` file) how to install and use the plugin.

### Features

This plugin should do the following:

* Register a post type called `weather`.
* Provide a block on the front end of the site  (initial structure in [`src/views/weather-form.php`](/src/views/weather-form.php)) that: 
  * Displays a form for AJAX submission of weather data.
  * Display a chronological list of submitted data by date.
  * Only allows for submissions of weather data from the front end by authenticated users.
  * The submissions should be AJAX driven and submit to a REST API endpoint. (js for this is in [`src/assets/js/weather.js`](/src/assets/js/weather.js))
* Provide a block in the editor that:
  * Allows for the display of weather data.
  * Allows for filtering of the data by date and location.
  * The data should be fetched via a REST API endpoint.
  * The block should be dynamic and update based on the selected filters.
* Provide REST endpoints for saving and fetching weather data.
  * When saving weather data, the date and weather should be stored as post meta.
* Fix any bugs you find in the existing code.
* Place documentation in the `/docs` folder.

#### User Stories

We have detailed a few requirements as user stories, which can be found in the following documents:

- [User Stories - Rest API](requirements/rest-api.md)
- [User Stories - Blocks](requirements/blocks.md)

We did not include _all_ features as user stories to give you leeway in blazing your own trail.

### Nice to haves

If you are looking for some potential areas to showcase your skills, here are some ideas:

* **Permissions:** Restrict submissions based on a param stored in the block, but default to logged-in users.
* **Unique entries:** Prevent duplicate entries.
* **Testing:** Provide automated tests for your code using Codeception, WP-Browser and Jest. See the [Testing](#testing) section for more details.

### Make this your own

In order to assist you in completing this project within the deadline, we have included some existing code that you may find helpful. This code can be used as a starting point or a reference for your development process. You may modify, refactor or remove this code as needed to fit the specific requirements of the project and your coding style.

We've placed some bugs and some things that may not be ideal within the provided code (on purpose). We've added a bunch of `@todo` lines. Change whatever you want. Restructure things, fix stuff, whatever! Make this your own.

Your primary goal should be to deliver a working plugin that meets all the user stories and adheres to the best practices outlined in the [Things we are looking for](#things-we-are-looking-for) section and your feel like delivers on showing what you are capable of given the deadline associated with the project.

Good luck with your development process, and please feel free to reach out if you have any questions or concerns!

## Tooling

For your convenience, we've included PHPStan via composer, which can be executed via `composer run test:analysis`. Feel free to include any other tooling that you wish. If you add anything, be sure to document it in the `/docs` directory!

## Testing

To ensure the quality and reliability of the Meteorological Events Plugin, it is important to test your code. We recommend using the [StellarWP slic](https://github.com/stellarwp/slic) CLI tool to run Codeception tests in your plugin.

The `slic` project is already initialized for this plugin, you should only need to include your tests to the `wpunit` test suite.

The Jest tests should be setup by you and should be responsible for testing the React components in the plugin.
