<?php 
namespace Exchange\Controller\Factories;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Exchange\Helper\Factories\HelperFactory;

class IndexControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $helper = new HelperFactory($container, $requestedName);
        return $helper->init();
    }

}
