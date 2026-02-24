# Inserting new weather data using Form Block

## User Story:

As a user the weather plugin, I want a new block in the WordPress block editor that allows me to insert new weather data, so that my users can submit weather data using the form on any page. 

## Acceptance Criteria:

1. **Form Block Creation:** The plugin should include a new Form Block within the WordPress block editor specifically designed for submitting weather data.
2. **Editor Visibility:** The Form Block must be visible and accessible within the blocks editor on the WordPress admin interface, allowing users to preview it on the editor.
3. **Duplicated block:** The Form block should only be able to be added once per post/page. 
4. **Field Inclusion:** The Form Block must contain fields for users to input the required weather data, including `date`, `location`, and `weather` information.
5. **Data Validation:** The Form Block should validate the input data to ensure it meets the expected format and required fields are not left blank.
6. **Submission Mechanism:** Users should be able to submit the weather data through the Form Block, and this data should be correctly transmitted to the plugin's database or designated storage mechanism.
7. **User Feedback:** Upon submission, users should receive immediate feedback indicating whether the submission was successful or if there were any errors (e.g., validation errors).
8. **Accessibility and Usability:** The Form Block should be accessible and user-friendly, ensuring compatibility with various devices and compliance with web accessibility standards.
9. **Documentation:** Provide documentation within the plugin that guides end users on how to use the Form Block to submit weather data, including any specific instructions or limitations.

## Definition of Done:

- The user story is considered complete when the plugin includes a fully functional Form Block in the WordPress block editor that allows end users to submit weather data.
- The Form Block is tested to ensure it properly collects data, validates user input, and provides appropriate feedback to users.
- All acceptance criteria have been met, and the functionality aligns with the specified user needs and plugin standards.

# Displaying weather data using Weather Block

## User Story:

As a user the weather plugin, I want a new block in the WordPress block editor that allows me to display weather data entries on my site. This block should enable me to use query parameters to filter which weather entries are displayed, so that I can tailor the information shown to my site visitors based on specific criteria like date, location, or weather conditions.

## Acceptance Criteria:

1. **Block Creation:** The plugin should include a new block within the WordPress block editor that is designed to display weather data entries.
2. **Query Parameter Functionality:** The block should allow the input of query parameters to filter the displayed weather entries based on attributes such as date, location, and weather conditions.
3. **Dynamic Display:** The block should dynamically update the displayed data based on the specified query parameters, showing the relevant weather entries.
4. **User Interface:** The block should provide a user-friendly interface within the block editor for setting and modifying the query parameters.
5. **Data Presentation:** The block should present the filtered weather data in a clear, readable format, with considerations for layout and design to enhance user experience.
6. **Data Fetching:** The block should fetch weather data using a custom REST API endpoint that needs to be created, ensuring data is retrieved dynamically and efficiently.
7. **Error Handling:** The block should handle errors gracefully, displaying appropriate messages if no data matches the query parameters or if there's an issue with data retrieval.
8. **Documentation:** Provide comprehensive documentation within the plugin that explains how to add and configure the block, set query parameters, and interpret the displayed data, including details on the data fetching mechanism.

## Definition of Done:

- The user story is considered complete when there's a functional block in the WordPress block editor that allows users to display and filter weather data entries using query parameters.
- All acceptance criteria have been met, ensuring that the block is ready for deployment and use within the plugin.
