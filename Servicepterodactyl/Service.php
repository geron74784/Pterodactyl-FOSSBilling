<?php
namespace Box\Mod\Servicepterodactyl;

class Service implements \Box\InjectionAwareInterface
{
  	protected $di;

    /**
     * @param mixed $di
     */
    public function setDi($di)
    {
        $this->di = $di;
    }

    /**
     * @return mixed
     */
    public function getDi()
    {
        return $this->di;
    }
  
    /**
     * Method to install module. In most cases you will provide your own
     * database table or tables to store extension related data.
     *
     * If your extension is not very complicated then extension_meta
     * database table might be enough.
     *
     * @return bool
     * @throws \Box_Exception
     */
    public function install()
    {
	$sql = "
        CREATE TABLE IF NOT EXISTS `service_pterodactyl` (
            `id` bigint(20) NOT NULL AUTO_INCREMENT,
	    `client_id` bigint(20) DEFAULT NULL,
	    `order_id` bigint(20) DEFAULT NULL,
            `created_at` varchar(35) DEFAULT NULL,
            `updated_at` varchar(35) DEFAULT NULL,
            PRIMARY KEY (`id`),
	    KEY `client_id_idx` (`client_id`)
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
        $this->di['db']->exec($sql);

        //throw new \Box_Exception("Throw exception to terminate module installation process with a message", array(), 123);
        return true;
    }
	
    /**
     * Method to uninstall module.
     *
     * @return bool
     * @throws \Box_Exception
     */
	    public function uninstall()
    {
		$this->di['db']->exec("DROP TABLE IF EXISTS `service_pterodactyl`");
		$this->di['db']->exec("DROP TABLE IF EXISTS `service_pterodactyl_server`");
        //throw new \Box_Exception("Throw exception to terminate module uninstallation process with a message", array(), 124);
        return true;
    }

    /**
     * @param \Model_ClientOrder $order
     * @return void
     */
    public function create($order)
    {
	$config = json_decode($order->config, 1);

		
        $product = $this->di['db']->getExistingModelById('Product', $order->product_id, 'Product not found');

        $model                	= $this->di['db']->dispense('service_pterodactyl');
        $model->client_id     	= $order->client_id;
	$model->order_id     	= $order->id;
        $model->created_at    	= date('Y-m-d H:i:s');
        $model->updated_at    	= date('Y-m-d H:i:s');
        $this->di['db']->store($model);

        return $model;
    }
	
}
