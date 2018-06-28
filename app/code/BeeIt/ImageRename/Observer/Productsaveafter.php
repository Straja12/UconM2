<?php

namespace BeeIt\ImageRename\Observer;

use Magento\Framework\Event\ObserverInterface;

class Productsaveafter implements ObserverInterface
{

    public function __construct(\Psr\Log\LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $_product = $observer->getEvent()->getProduct();  // you will get product object
        $images=$_product->getMediaGalleryImages(); // for media gallery
        $helper = 0;

    /*    foreach($images as $image){

            $label = $image->getLabel();


            $image->setLabel("Ucon_acrobatics_" . $_product->getName() . "_". $helper );

            $test = 123;
            $helper++;
        }
    */

    }
}