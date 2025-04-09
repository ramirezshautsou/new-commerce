<?php

return [
    'create_success' => ':name successfully created!',
    'update_success' => ':name successfully updated!',
    'delete_success' => ':name successfully deleted!',
    'create_failed' => 'Failed to create :name.',
    'update_failed' => 'Failed to update :name.',
    'delete_failed' => ':name failed to delete!',

    'user_not_found' => 'User not found.',
    'not_found' => ':name not found.',
    'access_denied' => 'Access denied.',
    'unauthenticated' => 'You must be logged in to access this page.',

    'login_success' => 'Successfully logged in.',
    'logout_success' => 'Successfully logged out.',

    'category_id_required' => ':attribute is required.',
    'category_id_exists' => 'The selected :attribute does not exist.',

    'name_required' => ':attribute is required.',
    'name_string' => ':attribute must be a string.',
    'name_max' => ':attribute may not be greater than 255 characters.',

    'alias_required' => ':attribute is required.',
    'alias_string' => ':attribute must be a string.',
    'alias_max' => ':attribute may not be greater than 255 characters.',
    'alias_unique' => ':attribute has already been taken.',

    'description_required' => ':attribute is required.',
    'description_string' => ':attribute must be a string.',
    'description_max' => ':attribute may not be greater than 1000 characters.',

    'producer_id_required' => ':attribute is required.',
    'producer_id_exists' => 'The selected :attribute does not exist.',

    'production_date' => ':attribute must be a valid date.',
    'target_date' => ':attribute must be a valid date.',

    'price_numeric' => ':attribute must be a number.',
    'price_min' => ':attribute must be at least 0.',

    'email_required' => ':attribute is required.',
    'email_invalid' => ':attribute must be a valid email address.',
    'email_unique' => ':attribute has already been taken.',
    'password_required' => ':attribute is required.',
    'password_min' => ':attribute must be at least :min characters.',
    'password_confirmation' => ':attribute confirmation does not match.',
    'role_required' => ':attribute is required.',
    'role_exists' => ':attribute is not valid.',

    'currency_updated_success' => 'Currency successfully updated!',
    'currency_updated_fail' => 'Currency Failed to update currency rates. Please try again later.',
    'currency_not_found' => 'Currency :currency not found in rates.',
    'currency_rate_update_error' => 'An error occurred while updating currency rates.',

    'missing_filials' => 'Missing filials in currency rates.',
    'skipped_currency' => 'Skipped currency entry: :currency',

    'request_failed' => 'Request failed: :status',
    'invalid_xml' => 'Invalid XML response.',

    'auth_failed' => 'Authentication failed, please check your credentials.',
    'registration_success' => 'Registration successful, please log in.',

    'no_products' => 'No products found.',
    'no_services' => 'No services available.',

    'rabbitmq_connection_failed' => 'Failed to connect to RabbitMQ: :error',
    'rabbitmq_publish_failed' => 'Failed to publish message to RabbitMQ: :error',
    'rabbitmq_handle_error' => 'Error handling RabbitMQ message: :message',
    'rabbitmq_process_error' => 'Error processing message: :message',
    'rabbitmq_cleanup_error' => 'Error during cleanup: :message',

    'export_success' => 'Product catalog has been successfully exported and queued.',
    'export_subject' => 'Your product export is complete',
    'export_failed' => 'Export processing failed: :error',
    'export_completed' => 'Export completed, the file is available at the link: :link',
    'export_products_failed' => 'Export products job failed',

    'download_url_generated' => 'The download URL for the file is: :url',
    'target_date_required_with_price' => 'Target date is required with the price of the product.',
];

