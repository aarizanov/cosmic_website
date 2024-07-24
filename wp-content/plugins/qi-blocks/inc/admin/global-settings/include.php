<?php

foreach ( glob( QI_BLOCKS_ADMIN_PATH . '/global-settings/*/include.php' ) as $module ) {
	require_once $module;
}
