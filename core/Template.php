<?php
function render_template($template_file, $variables = false)
{
    $template_folder = "output/";
    $path = $template_folder . $template_file;
    try
    {
        if(!file_exists($path)) throw new Exception("No template found in following path: " . $template_folder);
        if($variables !== false) 
        {
            extract($variables);
        }
        ob_start();
        include($path);
        return ob_get_clean();
    }
    catch(Exception $e)
    {
        die($e->getMessage() . "</br>");
    }
}