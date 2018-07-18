<?php

/**
 *    Dynamically set a specific EntityManager database connection.
 */

namespace AppBundle\Services;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ApplicationConnector implements ContainerAwareInterface
{

    /**
     * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
     */
    public function setContainer(ContainerInterface $container = NULL)
    {
        $this->container = $container;
    }

    /**
     * @param $dbName
     * @param $dbUser
     * @param $dbPassword
     * @param $dbHost
     * @param bool $reset
     *
     * @throws \Exception
     */
    public function resetConnectionchild($dbName, $dbUser, $dbPassword, $dbHost, $reset = false)
    {
	

        try {

            //establish the connection
            $connection = $this->container->get('doctrine.dbal.child_connection');

            $this->container->get('doctrine')->getManager('child')->flush();

            if ($reset && $connection->isConnected()) {
                $connection->close();
            }

            $refConn = new \ReflectionObject($connection);
            $refParams = $refConn->getProperty('_params');
            $refParams->setAccessible('public'); //we have to change it for a moment

            $params = $refParams->getValue($connection);
			
            $params['dbname'] = $dbName;
            $params['user'] = $dbUser;
            $params['password'] = $dbPassword;
            $params['host'] = $dbHost;

            $refParams->setAccessible('private');
            $refParams->setValue($connection, $params);

            if ($reset) {
                $this->container->get('doctrine')->resetManager('child');
            }
			//$params = $refParams->getValue($connection);print_r($params); die();
        }
        catch (\Exception $e) {
            throw $e;
        }

    }
	 /**
     * @param $dbNameVoip
     * @param $dbUserVoip
     * @param $dbPasswordVoip
     * @param $dbHostVoip
     * @param bool $reset
     *
     * @throws \Exception
     */
    public function resetConnectionsupport($dbNameVoip, $dbUserVoip, $dbPasswordVoip, $dbHostVoip, $reset = false)
    {

        try {

            //establish the connection
            $connection = $this->container->get('doctrine.dbal.support_connection');

            $this->container->get('doctrine')->getManager('support')->flush();

            if ($reset && $connection->isConnected()) {
                $connection->close();
            }

            $refConn = new \ReflectionObject($connection);
            $refParams = $refConn->getProperty('_params');
            $refParams->setAccessible('public'); //we have to change it for a moment

            $params = $refParams->getValue($connection);
			
            $params['dbname'] = $dbNameVoip;
            $params['user'] = $dbUserVoip;
            $params['password'] = $dbPasswordVoip;
            $params['host'] = $dbHostVoip;

            $refParams->setAccessible('private');
            $refParams->setValue($connection, $params);

            if ($reset) {
                $this->container->get('doctrine')->resetManager('support');
            }
			//$params = $refParams->getValue($connection);print_r($params); die();
        }
        catch (\Exception $e) {
            throw $e;
        }

    }
}