<?php
    error_log("Running Auto-Registering ServiceProvider Script");
    
    $file = dirname(__FILE__).'/../../../../config/app.php';
    
    // Check if /config/app.php exists
    if (!file_exists($file))
        return;
    
    $content = file_get_contents($file);
    
    // Check if VoxelsInjectServiceProvider is already injected
    if (strpos($content, 'VoxelsInject') !== false)
        return;
    
    $content_new    = '';
    foreach(explode("\n", $content) as $line => $text)
    {
        if (strpos($text, 'TinkerServiceProvider') !== false)
            $text .= PHP_EOL.'        Voxels\VoxelsInject\VoxelsInjectServiceProvider::class,';
        
        $content_new .= $text.PHP_EOL;
    }
    
    if (strlen($content_new) > strlen($content))
        file_put_contents($file, $content_new);
?>
