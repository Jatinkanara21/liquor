<?php
$src = __DIR__;
$build = __DIR__ . '/build';
$zipFile = __DIR__ . '/infinity_deploy.zip';

echo "Cleaning build directory...\n";
if (is_dir($build)) {
    shell_exec("rmdir /s /q \"$build\"");
}
mkdir($build);

echo "Copying folders...\n";
$folders = ['app', 'bootstrap', 'config', 'database', 'resources', 'routes', 'storage', 'tests', 'vendor'];
foreach ($folders as $f) {
    $target = $build . DIRECTORY_SEPARATOR . $f;
    shell_exec("xcopy \"$src\\$f\" \"$target\\\" /E /H /C /I /Y > NUL");
}

echo "Copying files...\n";
$files = ['.env', 'artisan', 'composer.json'];
foreach ($files as $f) {
    copy("$src/$f", "$build/$f");
}

echo "Copying public contents to root...\n";
shell_exec("xcopy \"$src\\public\" \"$build\\\" /E /H /C /I /Y > NUL");

echo "Updating index.php paths...\n";
$index = file_get_contents("$build/index.php");
$index = str_replace("__DIR__.'/../", "__DIR__.'/", $index);
file_put_contents("$build/index.php", $index);

echo "Updating security rules in .htaccess...\n";
$htaccess = file_get_contents("$build/.htaccess");
$htaccess .= "\n\n# Prevent access to sensitive files and directories (.env, .git, etc.)\n";
$htaccess .= "RewriteRule ^\\.|/\\. - [F]\n";
$htaccess .= "# Block direct access to core Laravel directories\n";
$htaccess .= "RewriteRule ^(app|bootstrap|config|database|resources|routes|tests|vendor)(/.*)?$ - [F,L]\n";
$htaccess .= "# Secure internal storage directories but allow public storage access\n";
$htaccess .= "RewriteRule ^storage/(framework|logs|app/private)(/.*)?$ - [F,L]\n";
$htaccess .= "RewriteRule \\.(env|log|sqlite|xml|json|lock|yaml|yml|md|bak|sql)$ - [F,L]\n";
file_put_contents("$build/.htaccess", $htaccess);

echo "Zipping build folder...\n";
if (file_exists($zipFile)) {
    unlink($zipFile);
}

$zip = new ZipArchive();
if ($zip->open($zipFile, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($build));
    foreach ($iterator as $file) {
        if (!$file->isDir()) {
            $filePath = $file->getPathname();
            $relativePath = substr($filePath, strlen($build) + 1);
            $zip->addFile($filePath, $relativePath);
        }
    }
    $zip->close();
    echo "Successfully created infinity_deploy.zip!\n";
} else {
    echo "Failed to create zip file!\n";
}

// Clean up build dir
shell_exec("rmdir /s /q \"$build\"");
echo "Done.\n";
