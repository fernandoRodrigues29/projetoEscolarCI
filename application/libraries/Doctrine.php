<?php
use Doctrine\Comon\ClassLoader,
	Doctrine\ORM\Configuration,
	Doctrine\ORM\EntityManeger,
	Doctrine\Common\Cache\ArrayCache,
	Doctrine\DBAL\Logging\EchoSQLLogger;
	class Doctrine {
		public $em = null;
		public function __construct() {
			require_once APPPATH.'config/database.php';
			require_once APPPATH.'libraries/Doctrine/Common/ClassLoader.php';
			$doctrineClassLoader = new ClassLoader('Doctrine', APPPATH.'libraries');
			$doctrineClassLoader->register();
			$doctrineClassLoader = new ClassLoader('models',rtrim(APPPATH,"/"));
			$doctrineClassLoader->register();
			$doctrineClassLoader = new ClassLoader('Proxies',APPPATH.'models/proxies');
			$doctrineClassLoader->register();
			
			$config = new Configuration;
			$cache = new ArrayCache;
			$config->setMetadataCacheImpl($cache);
			$driverImpl = $config->newDefaultAnnotationDriver(array(APPPATH.'models/Entities'));
			$config->setMetadataDriverImpl($driverImpl);
			$config->setQueryCacheImpl($cache);
			
			$config->setQueryCacheImpl($cache);

			$config->setProxyDir(APPPATH.'/models/proxies');
			$config->setProxyNamespace('Proxies');

			$logger = new EchoSQLLogger;
			$config->setSQLLogger($logger);
			
			$config->setAutoGenerateProxyClasses(TRUE);

			$connectionOptions = array(
				'driver'	=>	'pdo_mysql',
				'user'		=>	$db['default']['username'],
				'password'	=>	$db['default']['password'],
				'host'		=>	$db['default']['hostname'],
				'dbname'	=>	$db['default']['database']	
			);
			
			$this->em=EntityManager::create($connectionOption, $config);	
		}
	}
?>