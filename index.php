<?php
/**
 * InfinityFree Shared Hosting Passthrough
 * Routes requests from the root index directly to the Laravel public directory.
 * This satisfies InfinityFree's requirement for a root index file.
 */
require_once __DIR__.'/public/index.php';
