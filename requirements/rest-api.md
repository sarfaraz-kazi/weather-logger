# Save weather data

## User Story:

As a Third-Party Developer, I want to integrate with the plugin using the WordPress REST API so that I can programmatically insert weather data, allowing for seamless data management and integration with external applications.

## Acceptance Criteria:

1. The plugin should provide a custom REST API endpoint for inserting weather data.
2. The custom REST API endpoint should allow me to authenticate using standard WordPress authentication mechanisms (e.g., OAuth or Application Passwords).
3. The custom REST API endpoint should support creating new weather data with the required fields: `date`, `location`, and `weather`.
4. The custom REST API endpoint should return appropriate success or error messages, including any validation errors for the provided data.
5. The inserted weather data should be properly saved.
6. The plugin should provide clear documentation on how to interact with the custom REST API endpoint, including authentication, data format, and any limitations or restrictions.

## Definition of Done:

- The user story is considered complete when the plugin provides a custom REST API endpoint that allows me, as a Third-Party Developer, to programmatically save weather data within the plugin.
- The plugin should provide clear and concise documentation for third-party developers to integrate with the custom REST API endpoint and effectively retrieve the relevant data.

# Retrieving simple weather data

As a Third-Party Developer, I want to integrate with the plugin using the WordPress REST API to retrieve weather data that is sorted by date and location so that I can efficiently display weather data within my external applications.

## Acceptance Criteria:

1. The plugin should provide a custom REST API endpoint for retrieving weather data.
2. The custom REST API endpoint should allow me to authenticate using standard WordPress authentication mechanisms (e.g., OAuth or Application Passwords).
3. The custom REST API endpoint should return the weather data sorted by date (ascending) and then by location (ascending).
4. The custom REST API endpoint should support pagination, allowing me to retrieve a specified number of records per page and navigate through the data.
5. The plugin should provide clear documentation on how to interact with the custom REST API endpoint, including authentication, data format, and any limitations or restrictions.

## Definition of Done:

- The user story is considered complete when the plugin provides a custom REST API endpoint that allows me, as a Third-Party Developer, to programmatically fetch sorted weather data into the custom table within the plugin.
- The plugin should provide clear and concise documentation for third-party developers to integrate with the custom REST API endpoint and effectively retrieve the relevant data.
