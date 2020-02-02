<?php

defined('BASE_PATH') or exit("Undefined constant BASE_PATH\n");

defined('NS_SYSTEM') or define('NS_SYSTEM', 'System\\');

defined('NS_SYSTEM_CORE') or define('NS_SYSTEM_CORE', NS_SYSTEM . 'Core\\');

defined('NS_SYSTEM_LIB') or define('NS_SYSTEM_LIB', NS_SYSTEM . 'Lib\\');

defined('NS_SYSTEM_LIB_CORE') or define('NS_SYSTEM_LIB_CORE', NS_SYSTEM_LIB . 'Core\\');

defined('NS_SYSTEM_ROUTE') or define('NS_SYSTEM_ROUTE', NS_SYSTEM . 'Router\\');

defined('NS_SYSTEM_DB') or define('NS_SYSTEM_DB', NS_SYSTEM . 'Database\\');

defined('NS_SYSTEM_SECURITY') or define('NS_SYSTEM_SECURITY', NS_SYSTEM . 'Security\\');

defined('NS_APP') or define('NS_APP', 'App\\');

defined('NS_APP_CORE') or define('NS_APP_CORE', NS_APP . 'Core\\');

defined('NS_APP_CONTROLLER') or define('NS_APP_CONTROLLER', NS_APP_CORE . 'Controller\\');

defined('NS_APP_MODEL') or define('NS_APP_MODEL', NS_APP_CORE . 'Model\\');

defined('NS_APP_VIEW') or define('NS_APP_VIEW', NS_APP_CORE . 'View\\');

defined('NS_APP_LIB') or define('NS_APP_LIB', NS_APP . 'Lib\\');