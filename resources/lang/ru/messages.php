<?php

return [
    'create_success' => ':name успешно создан!',
    'update_success' => ':name успешно обновлён!',
    'delete_success' => ':name успешно удалён!',
    'create_failed' => 'Не удалось создать :name.',
    'update_failed' => 'Не удалось обновить :name.',
    'delete_failed' => 'Не удалось удалить :name!',

    'user_not_found' => 'Пользователь не найден.',
    'not_found' => ':name не найден(а).',
    'access_denied' => 'Доступ запрещён.',
    'unauthenticated' => 'Необходимо войти в систему для доступа к этой странице.',

    'login_success' => 'Вы успешно вошли в систему.',
    'logout_success' => 'Вы успешно вышли из системы.',

    'category_id_required' => 'Поле ":attribute" обязательно для заполнения.',
    'category_id_exists' => 'Выбранное значение ":attribute" не существует.',

    'name_required' => 'Поле ":attribute" обязательно для заполнения.',
    'name_string' => 'Поле ":attribute" должно быть строкой.',
    'name_max' => 'Поле ":attribute" не должно превышать 255 символов.',

    'alias_required' => 'Поле ":attribute" обязательно для заполнения.',
    'alias_string' => 'Поле ":attribute" должно быть строкой.',
    'alias_max' => 'Поле ":attribute" не должно превышать 255 символов.',
    'alias_unique' => 'Значение поля ":attribute" уже занято.',

    'description_required' => 'Поле ":attribute" обязательно для заполнения.',
    'description_string' => 'Поле ":attribute" должно быть строкой.',
    'description_max' => 'Поле ":attribute" не должно превышать 1000 символов.',

    'producer_id_required' => 'Поле ":attribute" обязательно для заполнения.',
    'producer_id_exists' => 'Выбранный ":attribute" не существует.',

    'production_date' => 'Поле ":attribute" должно быть корректной датой.',
    'target_date' => 'Поле ":attribute" должно быть корректной датой.',

    'price_numeric' => 'Поле ":attribute" должно быть числом.',
    'price_min' => 'Поле ":attribute" должно быть не менее 0.',

    'email_required' => 'Поле ":attribute" обязательно для заполнения.',
    'email_invalid' => 'Поле ":attribute" должно быть корректным email-адресом.',
    'email_unique' => 'Email уже зарегистрирован.',
    'password_required' => 'Поле ":attribute" обязательно для заполнения.',
    'password_min' => 'Поле ":attribute" должно содержать минимум :min символов.',
    'password_confirmation' => 'Подтверждение пароля не совпадает.',
    'role_required' => 'Поле ":attribute" обязательно для заполнения.',
    'role_exists' => 'Значение поля ":attribute" недопустимо.',

    'currency_updated_success' => 'Курсы валют успешно обновлены!',
    'currency_updated_fail' => 'Не удалось обновить курсы валют. Повторите попытку позже.',
    'currency_update_exception_log' => 'Ошибка обновления курсов валют: :message',
    'currency_not_found' => 'Валюта :currency не найдена в курсах.',
    'currency_rate_update_error' => 'Произошла ошибка при обновлении валютных курсов.',

    'missing_filials' => 'Отсутствуют филиалы в курсах валют.',
    'skipped_currency' => 'Пропущена запись о валюте: :currency',

    'request_failed' => 'Запрос не удался: :status',
    'invalid_xml' => 'Неверный XML ответ.',

    'auth_failed' => 'Ошибка авторизации: проверьте введённые данные.',
    'registration_success' => 'Регистрация прошла успешно. Пожалуйста, войдите.',

    'no_products' => 'Товары не найдены.',
    'no_services' => 'Нет доступных услуг.',

    'rabbitmq_connection_failed' => 'Не удалось подключиться к RabbitMQ: :error',
    'rabbitmq_publish_failed' => 'Не удалось отправить сообщение в RabbitMQ: :error',
    'rabbitmq_handle_error' => 'Ошибка при обработке сообщения RabbitMQ: :message',
    'rabbitmq_process_error' => 'Ошибка при обработке сообщения: :message',
    'rabbitmq_cleanup_error' => 'Ошибка при очистке: :message',

    'queue_listening' => 'Ожидание очереди ":queue"...',
    'processing_duration' => 'Время обработки: :time сек.',

    'export_success' => 'Каталог товаров успешно экспортирован и отправлен в очередь.',
    'export_subject' => 'Экспорт товаров завершен',
    'export_failed' => 'Ошибка обработки экспорта: :error',
    'export_completed' => 'Экспорт завершён, файл доступен по ссылке: :link',
    'export_products_failed' => 'Ошибка задачи экспорта товаров',

    'download_url_generated' => 'Ссылка для скачивания файла: :url',
];
