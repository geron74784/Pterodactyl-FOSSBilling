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
}
