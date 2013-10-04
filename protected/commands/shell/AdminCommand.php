<?php
class AdminCommand extends CConsoleCommand
{
	public $templatePath;

	private $_schema;
	private $_relations; // where we keep table relations
	private $_tables;
	private $_classes;

	/**
	 * @return string the help information for the shell command
	 */
	public function getHelp()
	{
		return <<<EOD
USAGE
  model <url-alias>

DESCRIPTION
  This command generates a basic manage system on your project by yii.

EOD;
	}

	/**
	 * Execute the action.
	 * @param array command line parameters specific for this command
	 */
	public function run($args)
	{
		if(!isset($args[0]))
		{
			echo "---------------------------------------\n";
			echo "Error: url-alias name is required.\n";
			echo "---------------------------------------\n";
			echo $this->getHelp();
			return;
		}
		$urlAlias = $args[0];

		if(($db=Yii::app()->getDb())===null)
		{
			echo "---------------------------------------\n";
			echo "Error: an active 'db' connection is required.\n";
			echo "If you already added 'db' component in application configuration,\n";
			echo "please quit and re-enter the yiic shell.\n";
			echo "---------------------------------------\n";
			return;
		}

		$db->active=true;
		$this->_schema=$db->schema;

		var_dump($this->_schema);
		$this->generateClassNames($this->_schema);

		if (in_array('users',$this->_tables)) {
			echo "users tables is exist!\n";
			echo "\nDo you want to overwrited it? [Yes|No] ";
			if(strncasecmp(trim(fgets(STDIN)),'y',1)) {
				return; 
			}

			// drop users table
			$Drop_users_table = "drop table Users;";
			$command = $db->createCommand($Drop_users_table);
			$command->execute();
		}

		// create users table
		$Create_users_table = <<<EOD
			CREATE TABLE Users
			(
				`id` INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
				`username` VARCHAR(128) NOT NULL,
				`password` VARCHAR(128) NOT NULL,
				`email` VARCHAR(128) NOT NULL,
				`profile` TEXT
			);
EOD;
		$command = $db->createCommand($Create_users_table);
		$command->execute();

		$Insert_user_record = "INSERT INTO Users (username, password, email) VALUES ('admin','fe01ce2a7fbac8fafaed7c982a04e229','webmaster@example.com');";
		$command = $db->createCommand($Insert_user_record);
		$command->execute();

		echo "users tables is Created and 'admin' user is Inserted. \n";

		var_dump($this->_tables);


		$module=Yii::app();

		$controllerID=$args[0];
		if(($pos=strrpos($controllerID,'/'))===false)
		{
			$controllerClass=ucfirst($controllerID).'Controller';
			$controllerFile=$module->controllerPath.DIRECTORY_SEPARATOR.$controllerClass.'.php';
			$controllerID[0]=strtolower($controllerID[0]);
		}
		else
		{
			$last=substr($controllerID,$pos+1);
			$last[0]=strtolower($last);
			$pos2=strpos($controllerID,'/');
			$first=substr($controllerID,0,$pos2);
			$middle=$pos===$pos2?'':substr($controllerID,$pos2+1,$pos-$pos2);

			$controllerClass=ucfirst($last).'Controller';
			$controllerFile=($middle===''?'':$middle.'/').$controllerClass.'.php';
			$controllerID=$middle===''?$last:$middle.'/'.$last;
			if(($m=Yii::app()->getModule($first))!==null)
				$module=$m;
			else
			{
				$controllerFile=$first.'/'.$controllerFile;
				$controllerID=$first.'/'.$controllerID;
			}

			$controllerFile=$module->controllerPath.DIRECTORY_SEPARATOR.str_replace('/',DIRECTORY_SEPARATOR,$controllerFile);
		}

		echo $controllerFile;
		echo "\n";
		$templatePath=(dirname($module->controllerPath).'/commands/shell/view/');
		$viewPath=$module->viewPath.DIRECTORY_SEPARATOR.str_replace('.',DIRECTORY_SEPARATOR,$controllerID);

		echo "\n";
		echo $templatePath;
		echo "\n";
		echo $viewPath;
	}

	/**
	 * Generates model class name based on a table name
	 * @param string the table name
	 * @return string the generated model class name
	 */
	protected function generateClassName($tableName)
	{
		return str_replace(' ','',
				trim(
					strtolower(
						str_replace(array('-','_'),' ',
							preg_replace('/(?<![A-Z])[A-Z]/', ' \0', $tableName)))));
	}

	/**
	 * Generates the mapping table between table names and class names.
	 * @param CDbSchema the database schema
	 * @param string a regular expression that may be used to filter table names
	 */
	protected function generateClassNames($schema,$pattern=null)
	{
		$this->_tables=array();
		foreach($schema->getTableNames() as $name)
		{
			if($pattern===null)
				$this->_tables[$name]=$this->generateClassName($name);
			else if(preg_match($pattern,$name,$matches))
			{
				if(count($matches)>1 && !empty($matches[1]))
					$className=$this->generateClassName($matches[1]);
				else
					$className=$this->generateClassName($matches[0]);
				$this->_tables[$name]=empty($className) ? $name : $className;
			}
		}
	}



}