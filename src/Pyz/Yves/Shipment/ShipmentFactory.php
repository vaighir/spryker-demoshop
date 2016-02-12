<?php

namespace Pyz\Yves\Shipment;

use Pyz\Yves\Shipment\Form\DataProvider\ShipmentDataProvider;
use Pyz\Yves\Shipment\Form\ShipmentSubForm;
use Pyz\Yves\Shipment\Handler\ShipmentHandler;
use Spryker\Shared\Kernel\Store;
use Spryker\Shared\Library\Currency\CurrencyManager;
use Spryker\Yves\Kernel\AbstractFactory;

class ShipmentFactory extends AbstractFactory
{

    /**
     * @return \Pyz\Yves\Checkout\Dependency\SubFormInterface
     */
    public function createShipmentForm()
    {
        return new ShipmentSubForm();
    }

    /**
     * @return \Pyz\Yves\Shipment\Form\DataProvider\ShipmentDataProvider
     */
    public function createShipmentDataProvider()
    {
        return new ShipmentDataProvider(
            $this->getShipmentClient(),
            $this->getGlossaryClient(),
            $this->getStore(),
            $this->getCurrencyManager()
        );
    }

    /**
     * @return \Pyz\Yves\Shipment\Handler\ShipmentHandler
     */
    public function createShipmentHandler()
    {
        return new ShipmentHandler($this->getShipmentClient());
    }

    /**
     * @return \Spryker\Client\Shipment\ShipmentClientInterface
     */
    public function getShipmentClient()
    {
        return $this->getLocator()->shipment()->client();
    }

    /**
     * @return \Spryker\Client\Glossary\GlossaryClientInterface
     */
    public function getGlossaryClient()
    {
        return $this->getLocator()->glossary()->client();
    }

    /**
     * @return \Spryker\Shared\Kernel\Store
     */
    protected function getStore()
    {
        return Store::getInstance();
    }

    /**
     * @return \Spryker\Shared\Library\Currency\CurrencyManager
     */
    protected function getCurrencyManager()
    {
        return CurrencyManager::getInstance();
    }

}
