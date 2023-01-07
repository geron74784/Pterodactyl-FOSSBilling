<?php
namespace Box\Mod\Pterodactyl\Controller;

class Admin implements \Box\InjectionAwareInterface
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
  
  	public function fetchNavigation()
    {
        return array(
            'group'  =>  array(
                'index'     => 1600,                // menu sort order
                'location'  => 'pterodactyl',           // menu group identificator for subitems
                'label'     => 'Pterodactyl Module',    // menu group title
                'class'     => 'pterodactyl',           // used for css styling menu item
            ),
            'subpages'=> array(
                array(
                    'location'  => 'pterodactyl',       // place this module in extensions group
                    'label'     => 'Pterodactyl Configuration',
                    'index'     => 1500,
                    'uri'       => $this->di['url']->adminLink('pterodactyl'),
                    'class'     => '',
                ),
            ),
        );
    }
  
  	public function register(\Box_App &$app)
    {
        $app->get('/pterodactyl',             'get_index', array(), get_class($this));
    }
  
  	public function get_index(\Box_App $app)
    {
        $this->di['is_admin_logged'];
        return $app->render('mod_pterodactyl_index');
    }
}
