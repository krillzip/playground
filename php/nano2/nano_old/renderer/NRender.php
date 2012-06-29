<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NRenderer
 *  Base class of possible renderers.
 *  A renderer renders the output content based on parameters and options.
 * @author krillzip
 */
abstract class NRender {
    const XHTML = 'xhtml';
    const RSS = 'rss';
    const JSON = 'json';

    /**
     *  Constructor fo a renderer to be initialized.
     * @param <array> $params Array of parameters that are the actual content.
     * @param <array> $options Array of options that influence the rendering process.
     */
    public abstract function __construct(array $params, array $options = NULL);

    /**
     * Renders the output.
     */
    public abstract function render();

    /**
     *  Factory method to initialize an instance of an NRenderer.
     * @param <string> $type See constants for pissible renderers.
     * @param <array> $params See constructor parameter.
     * @param <type> $options See constructor parameter.
     * @return <mixed> Returns instance of NRenderer or false on failure.
     */
    public static function factory($type, array $params, array $options = NULL)
    {
        switch($type)
        {
            case NRender::XHTML:
                return new NXhtmlRender($params, $options);
            case NRender::RSS:
                return new NRssRender($params, $options);
            case NRender::JSON:
                return new NJsonRender($params, $options);
            default:
                return false;
        }
    }
}
?>