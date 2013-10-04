<?php

class Usetime extends CWidget
{
	public function run()
	{
		echo 'u:'.round(YII_APP_START_TIME - time(true),4);
	}
}