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
function render_content($pageId)
{
    echo t('content') . " $pageId";
}

// Renders the navigation for the passed language and page ID.
// TODO in controller?
function render_navigation($language, $pageId)
{
    $urlBase = $_SERVER['PHP_SELF'];
    add_param($urlBase, "lang", $language);

    $navs = array('Home', 'Man', 'Woman', 'Gift');
    foreach ($navs as $nav) {
        $url = $urlBase;
        add_param($url, "id", $nav);
        $class = $pageId == $nav ? 'active' : 'inactive';
        echo "<a class=\"$class\" href=\"$url\">" . t($nav) . "</a>";
    }
}

// Renders the language navigation.
// TODO in controller?
function render_languages($language, $pageId)
{
    $languages = array('en', 'de', 'it');
    $urlBase = $_SERVER['PHP_SELF'];
    add_param($urlBase, 'id', $pageId);
    foreach ($languages as $lang) {
        $url = $urlBase;
        $class = $language == $lang ? 'active' : 'inactive';
        echo "<a class=\"$class\" href=\"" . add_param($url, 'lang', $lang) . "\">" . strtoupper($lang) . "</a>";
    }
}

// The translation function.
function t($key)
{
    global $messages;
    if (isset($messages[$key])) {
        return $messages[$key];
    } else {
        return "[$key]";
    }
}

// Set langauage and page ID as global variables.
$pageId = get_param('id', 0);
$language = get_param('lang', 'en');
$messages = array();
$fn = "messages/messages_$language.txt";
$file = file($fn);
foreach ($file as $line) {
    list($key, $val) = explode('=', $line);
    $messages[$key] = $val;
}
