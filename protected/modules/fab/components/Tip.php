<?php

class Tip extends CWidget
{
    public $message = 'TipTop Message';
    public $className = '';

    public function run()
    {
        $this->render('Tip', array('message' => CHtml::encode($this->message), 'class' => $this->className));
    }
}