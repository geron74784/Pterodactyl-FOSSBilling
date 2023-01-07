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
}
