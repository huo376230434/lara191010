<?php
// @formatter:off
namespace Laravel\Dusk;

class Browser{

    /**
     * @param $selector
     * @param float $pause
     * @return Browser
     */
    public function clickAndDelay($selector, $pause=0.5)
    {


    }

    /**
     * @param $selector
     * @param float $pause
     *
     * @return Browser
     */
    public function clickAndAssertDownload($selector, $pause=0.5)
    {

    }

    /**
     * @param $url
     * @param float $pause
     * @return Browser
     */
    public function visitAndDelay($url, $pause=0.5)
    {


    }

    /**
     * @param float $pause
     * @return Browser
     */
    public function delay( $pause=0.5)
    {


    }

    /**
     * @return Browser
     */
    public function ensureJquery()
    {

    }

    /**
     * @return array
     */
    public function getBatchAttr($selector,$attr_name)
    {

    }
    /**
     * @return array
     */
    public function getBatchContent($selector,$type='html')
    {

    }


    /**
     * @param $selector
     * @return string
     */
    public function html($selector,$content='')
    {

    }

    /**
     * @param $url
     * @param $download_dir
     * @param array $hide_arr
     * @param int $pause
     */
    public function print($url, $download_dir, $hide_arr=[], $pause=6)
    {

    }

    /**
     * @param $selector
     * @param array $url_arr
     */
    public function joinHtmlsAndWaitToPrint($selector, $url_arr=[])
    {
        return '';

    }

    /**
     * @return Browser
     */
    public function select2($name,$value)
    {

    }

    /**
     * @return string
     */
    public function currentFullUrl()
    {

        return '';
    }

    /**
     * @return Browser
     */
    public function assertTrue($bool)
    {

    }

    /**
     * @return Browser
     */
    public function switchToNewWindow()
    {

    }

    /**
     * @return Browser
     */
    public function switchToBackWindow()
    {

    }

}
