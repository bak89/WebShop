<?php

// Returns a certain GET parameter or $default if the parameter does not exist.
// TODO in request class
function get_param($name, $default)
{
    if (isset($_GET[$name]))
        return urldecode($_GET[$name]);
    else
        return $default;
}

// Adds a GET parameter to the url. The url is passed by reference.
function add_param(&$url, $name, $value)
{
    $sep = strpos($url, '?') !== false ? '&' : '?';
    $url .= $sep . $name . "=" . urlencode($value);
    return $url;
}

// Renders the page content for a certain page ID.
// TODO in view class?
function render_content($page)
{
    echo t('content') . " $page";
}

// Renders the navigation for the passed language and page ID.
// TODO in controller?
function render_navigation($language, $page)
{
    $urlBase = $_SERVER['PHP_SELF'];
    add_param($urlBase, "lang", $language);

    $navs = array('Home', 'Man', 'Woman', 'Gift');
    foreach ($navs as $nav) {
        $url = $urlBase;
        add_param($url, "id", $nav);
        $class = $page == $nav ? 'active' : 'inactive';
        echo "<a class=\"$class\" href=\"$url\">" . t($nav) . "</a>";
    }
}