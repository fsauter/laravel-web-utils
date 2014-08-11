<?php


/**
 * Checks for the active route.
 *
 * @param string $routeName
 * @return boolean true if the current route is active.
 */
function containsCurrentRoute($routeName)
{
    return strpos(Route::currentRouteName(), $routeName) !== false;
}

/**
 * Checks for the active route.
 *
 * @param $route
 * @return boolean true if the current route is active.
 */
function isCurrentRoute($route)
{
    return strpos(Route::currentRouteName(), $route) !== false;
}

/**
 * Checks whether a menu item is active (based on the current url).
 *
 * @param $search
 *
 * @return string 'active' or an empty string
 */
function isActive($search)
{
    return Request::is($search) ? 'active' : '';
}

/**
 * Checks the current environment.
 *
 * Available envs can be found under /app/config
 *
 * @param $environment
 * @return bool
 */
function env($environment)
{
    return App::environment() === $environment;
}

/**
 * Get either a Gravatar URL or complete image tag for a specified email address.
 *
 * @param mixed $identifier The email address or a supported object.
 * @param int $s Size in pixels, defaults to 80px [ 1 - 2048 ]
 * @param string $d Default imageset to use [ 404 | mm | identicon | monsterid | wavatar ]
 * @param string $r Maximum rating (inclusive) [ g | pg | r | x ]
 * @return String containing either just a URL or a complete image tag
 * @source http://gravatar.com/site/implement/images/php/
 */
function gravatar($identifier = 'user', $s = 50, $d = 'identicon', $r = 'g')
{
    if(filter_var($identifier, FILTER_VALIDATE_EMAIL)):
        $email = $identifier;
    else:
        $email = 'null@null.com';
        $d = 'mm';
    endif;
    $url = 'http://www.gravatar.com/avatar/';
    $url .= md5( strtolower( trim( $email ) ) );
    $url .= "?s=$s&d=$d&r=$r";
    return $url;
}

/**
 * Creates a new date for now or a given timestamp
 *
 * @param string $timestamp
 * @return bool|string
 */
function timestamp($timestamp = '')
{
    return date('Y-m-d H:i:s', empty($timestamp) ? time() : $timestamp);
}

/**
 * Converts e.g. 23.02.2013 into 2013-02-23 00:00:00
 *
 * @param $date
 * @return string
 */
function dateToMysqlTimestamp($date)
{
    return date('Y-m-d H:i:s', strtotime($date));
}

/**
 * Converts e.g. 2013-02-23 00:00:00 into 23.02.2013 using the current locale.
 *
 * @param $mysqlTimestamp
 * @return string
 */
function mysqlTimestampToDate($mysqlTimestamp)
{
    return date(dateFormat(), strtotime($mysqlTimestamp));
}

/**
 * Converts e.g. 2013-02-23 00:00:00 into 23.02.2013 using the current locale.
 *
 * @param $format
 * @param $date
 * @return string
 */
function convertDate($format, $date)
{
    return date($format, strtotime($date));
}

/**
 * Returns back to the previous url.
 *
 * @return Illuminate\Http\RedirectResponse
 */
function goBack()
{
    return Redirect::to(URL::previous());
}

/**
 * Shortcut function for authenticated user.
 *
 * @param string $property (optional)
 * @return \User
 */
function user($property = '')
{
    return empty($property) ? Auth::user() : Auth::user()->$property;
}

/**
 * @return string
 */
function locale()
{
    return Config::get('app.locale');
}

/**
 * Debug function.
 *
 * @param $object
 */
function pre($object)
{
    echo "<pre>";
    print_r($object);
    echo "</pre>";
}

/**
 * Debug function with die code.
 *
 * @param $object
 */
function pred($object)
{
    pre($object);
    die;
}