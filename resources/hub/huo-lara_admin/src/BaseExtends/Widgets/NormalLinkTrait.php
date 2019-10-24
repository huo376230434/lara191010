<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/26
 * Time: 9:27
 */

namespace Huojunhao\LaraAdmin\BaseExtends\Widgets;
use Illuminate\Support\Traits\Macroable;

trait NormalLinkTrait  {
    use Macroable;


    protected $url;

    protected $title;

    protected $color_type;

    protected $pull_right;
    protected $addon_class;

    protected $blank = 0;

    protected $is_btn;

    protected $margin_x = 0;

    protected $margin_y = 0;


    /**
     * @param bool $is_btn
     */
    public function isNormalLink()
    {
        $this->is_btn = false;
        return $this;
    }

    public function isBtn()
    {
        $this->is_btn = true;
        return $this;
    }

    public function gridRowDelete()
    {
        $this->addon_class .= " grid-row-delete ";
        $this->setColorType('danger');
        return $this;
    }


    public function gridRowEdit()
    {
        $this->addon_class .= " grid-row-edit ";
        return $this;
    }

    public function gridRowView()
    {
        $this->addon_class .= " grid-row-view ";
        return $this;
    }


    /**
     * @param string $margin_x
     * @return NormalLinkTrait
     */
    public function setMarginX(string $margin_x="5px")
    {
        $this->margin_x = $margin_x;
        return $this;
    }

    /**
     * @param string $margin_y
     * @return NormalLinkTrait
     */
    public function setMarginY(string $margin_y="5px")
    {
        $this->margin_y = $margin_y;
        return $this;
    }


    public function setMargin()
    {
        $this->setMarginX();
        $this->setMarginY();
        return $this;
    }
    /**
     * @param string $color_type
     */
    public function setColorType(string $color_type)
    {
        $this->color_type = $color_type;
        return $this;
    }


    /**
     * @param bool $pull_right
     */
    public function pullRight()
    {
        $this->pull_right = true;
        return $this;
    }

    /**
     * @param string $addon_class
     */
    public function setAddonClass(string $addon_class)
    {
        $this->addon_class = $addon_class;
        return $this;
    }


    /**
     * @param bool $blank
     */
    public function blank()
    {
        $this->blank = 1;
        return $this;
    }


}
