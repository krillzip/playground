<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NAssetManager
 *  The asset manager keep track of all the assets that will be used
 * or displayed at the client side. Registered assets are copied to the
 * webroot folder.
 * @author krillzip
 */
class NAssetManager extends NApplicationComponent {
    protected $_assets = array();

    protected function initialize(){}

    /**
     *  Copies resources to another destination.
     * @param <string> $path Source to copy from.
     * @param <string> $dest Destination to copy to.
     */
    protected function copy($path, $dest)
    {
        if(!file_exists($path))
            throw new Exception();
        if(!file_exists($dest) || !PRODUCTION)
            if(!copy($path, $dest))
                    throw new Exception();
    }

    /**
     *  Register a specific resource to be included in the output content.
     * @param <string> $url Url of the resource.
     * @param <type> $type Type of resource.
     */
    public function register($url, $type)
    {
        $this->_assets[$type][] = $url;
    }

    /**
     *  Registers an image to the webroot.
     * @param <string> $path Path of image.
     * @return <string> The new url to the image in the webroot.
     */
    public function registerImage($path)
    {
        $dest = WEBROOT.DS.'images'.DS.basename($path);
        $this->copy($path, $dest);
        return $dest;
    }

    /**
     *  Register RSS feed.
     * @param <string> $href The url of the RSS feed.
     * @param <string> $title The title of the RSS feed.
     */
    public function rss($href, $title)
    {
        $this->register(array('href'=>$href, 'title'=>$title), 'rss');
    }

    /**
     *  Sets the page title.
     * @param <string> $t Title for the output document.
     */
    public function title($t)
    {
        $this->register($t, 'title');
    }

    /**
     *  Description for the Metatags.
     * @param <string> $d
     */
    public function description($d)
    {
        $this->register($d, 'description');
    }

    /**
     *  Keywords for the metatags.
     * @param <string> $k The keywords.
     */
    public function keywords($k)
    {
        $this->register($k, 'keywords');
    }

    /**
     *  Favicon to be used
     * @param <string> $href
     * @param <string> $mime
     */
    public function favicon($href, $mime)
    {
        $this->register(array('href'=>$path, 'mime'=>$mime), 'favicon');
    }

    /**
     *  Registers an javascript as asset.
     * @param <string> $alias JavaScript to be used
     * @return <string> Destination path of the object.
     */
    public function js($alias)
    {
        $dest = $this->asset($alias, 'js');
        $this->register(NFramework::path2url($dest), 'js');
        return $dest;
    }

    /**
     *  Registers a stylesheet as asset.
     * @param <string> $alias StyleSheet to be used
     * @return <string> Destination path of the object.
     */
    public function css($alias)
    {
        $dest = $this->asset($alias, 'css');
        $this->register(NFramework::path2url($dest), 'css');
        return $dest;
    }

    /**
     *  Registers a Flash SWF as asset.
     * @param <string> $alias SWF to be used
     * @return <string> Destination path of the object.
     */
    public function flash($alias)
    {
        return $this->asset($alias, 'swf');
    }

    /**
     *  Registers any type of asset to be used in the webroot.
     * @param <string> $alias Alias of asset
     * @param <string> $type Type of asset
     * @return <type>  returns the new destination.
     */
    public function asset($alias, $type)
    {
        $source = NFramework::resolve($alias, $type);
        $dest = WEBROOT.DS.$type.DS.basename($source);
        $this->copy($source, $dest);
        return $dest;
    }

    /**
     *  Returns all registered assets.
     * @return <array>
     */
    public function getAssets()
    {
        return $this->_assets;
    }
}
?>