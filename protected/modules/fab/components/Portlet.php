<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Portlet
 *
 * @author wugangqiang
 */
class Portlet extends CWidget
{
    public $title; // the portlet title
    public $visible = true; // whether the portlet is visible

    public function init()
    {
        if ($this->visible) {
            // 开始渲染这个展示点
            // 渲染Title
        }
    }

    public function run()
    {
        if ($this->visible) {
            $this->renderContent();
            // 最终渲染这个视图
        }
    }

    protected function renderContent()
    {
        // 子类应当覆盖整个方法
        // 使得可以渲染html
    }
}
