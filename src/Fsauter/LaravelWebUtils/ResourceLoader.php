<?php namespace Fsauter\LaravelWebUtils;

use HTML;

/**
 * This ResourceLoader gives the ability to load necessary resources on-the-fly.
 *
 * Be aware of:
 * https://developers.google.com/speed/docs/best-practices/rtt#PutStylesBeforeScripts
 *
 * <p>Example:</p>
 * <code>
 *  Resources::add(public_path('/js/jquery.min.js')->add();
 *
 * </code>
 *
 * @package Fsauter\LaravelWebUtils
 */
class ResourceLoader {

    private $scripts = array();
    private $stylesheets = array();

    /**
     * Adds a local resource (have to be prefixed with .js or .css).
     *
     * @param $resource
     * @param $name (optional) The resource name or empty (resource basename will be used)
     *
     * @return ResourceLoader
     */
    public function add($resource, $name = '')
    {
        $name = empty($name) ? $this->get($resource, 'basename') : $name;

        switch( $this->get($resource, 'extension') )
        {
            case 'js':
                $this->addScript($resource, $name);
                break;
            case 'css':
                $this->addStylesheet($resource, $name);
                break;
        }

        return $this;
    }

    /**
     * Adds a script.
     *
     * @param $resource
     * @param $name
     */
    private function addScript($resource, $name)
    {
        $this->scripts[] = array(
            'name' => $name,
            'path' => $resource
        );
    }

    /**
     * Adds a stylesheet.
     *
     * @param $resource
     * @param $name
     */
    private function addStylesheet($resource, $name)
    {
        $this->stylesheets[] = array(
            'name' => $name,
            'path' => $resource
        );
    }

    /**
     * Generates the html markup for the added scripts & stylesheets.
     *
     * @return string
     */
    public function all()
    {
        return $this->styles().$this->scripts();
    }

    /**
     * Generates the html markup for the added scripts.
     *
     * @return string
     */
    public function scripts()
    {
        $markup = "\n";

        foreach($this->scripts as $script)
        {
            if( str_contains($script['path'], public_path())):
                $this->appendLocalScript($markup, $script);
            else:
                $this->appendExternalScript($markup, $script);
            endif;

        }

        return $markup;
    }

    private function appendLocalScript(&$markup, $script)
    {
        $content = str_replace("\n", ' ', file_get_contents($script['path']));
        $markup .= "    <!-- ".$script['name']." -->\n";
        $markup .= "    <script>\n".$content."</script>\n";
    }

    private function appendExternalScript(&$markup, $script)
    {
        $markup .= '    '.HTML::script($script['path']);
    }


    /**
     * Generates the html markup for the added stylesheets.
     *
     * @return string
     */
    public function styles()
    {
        $markup = "\n";

        foreach($this->stylesheets as $stylesheet)
        {

            if( str_contains($stylesheet['path'], public_path()) ):
                $this->appendLocalStylesheet($markup, $stylesheet);
            else:
                $this->appendExternalStylesheet($markup, $stylesheet);
            endif;

        }

        return $markup;
    }

    private function appendLocalStylesheet(&$markup, $stylesheet)
    {
        $content = str_replace("\n", ' ', file_get_contents($stylesheet['path']));
        $markup .= "    <!-- ".$stylesheet['name']." -->\n";
        $markup .= "    <style>\n".$content."</style>\n";
    }

    private function appendExternalStylesheet(&$markup, $stylesheet)
    {
        $markup .= '    '.HTML::style($stylesheet['path']);
    }

    private function get($file, $property)
    {
        $fileParts = pathinfo($file);
        return $fileParts[$property];
    }

    /**
     * Returns an empty string to enable using this class like the builder pattern in blade.
     *
     * {{ Resource::add(..)->add(...) }}
     *
     * @return string
     */
    public function __toString()
    {
        return '';
    }

}