<?php
class TryCommand extends CConsoleCommand
{
    public function run($args)
    {
        $receiver=$args[0];
	echo $receiver;
        // send email to $receiver
    }
}


?>
