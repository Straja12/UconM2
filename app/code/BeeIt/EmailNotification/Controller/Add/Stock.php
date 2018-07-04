<?php

namespace BeeIt\EmailNotification\Controller\Add;

class Stock extends \Magento\ProductAlert\Controller\Add\Stock {



    public function execute()
    {
        $backUrl = $this->getRequest()->getParam(Action::PARAM_NAME_URL_ENCODED);
        $productId = (int)$this->getRequest()->getParam('product_id');
        /** @var \Magento\Framework\Controller\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        if (!$backUrl || !$productId) {
            $resultRedirect->setPath('/');
            return $resultRedirect;
        }

        try {
            /* @var $product \Magento\Catalog\Model\Product */
            $product = $this->productRepository->getById($productId);
            $post = $this->getRequest()->getPost();
            $email= $post['email'];

            if(!empty($email)){
                /** @var \Magento\ProductAlert\Model\Stock $model */
                $model = $this->_objectManager->create(\Magento\ProductAlert\Model\Stock::class)
                    ->setCustomerEmail($email)
                    ->setProductId($product->getId())
                    ->setWebsiteId(
                        $this->_objectManager->get(\Magento\Store\Model\StoreManagerInterface::class)
                            ->getStore()
                            ->getWebsiteId()
                    );
                $model->save();
            } else {
                /** @var \Magento\ProductAlert\Model\Stock $model */
                $model = $this->_objectManager->create(\Magento\ProductAlert\Model\Stock::class)
                    ->setCustomerId($this->customerSession->getCustomerId())
                    ->setProductId($product->getId())
                    ->setWebsiteId(
                        $this->_objectManager->get(\Magento\Store\Model\StoreManagerInterface::class)
                            ->getStore()
                            ->getWebsiteId()
                    );
                $model->save();
            }

            $this->messageManager->addSuccess(__('Alert subscription has been saved.'));
        } catch (NoSuchEntityException $noEntityException) {
            $this->messageManager->addError(__('There are not enough parameters.'));
            $resultRedirect->setUrl($backUrl);
            return $resultRedirect;
        } catch (\Exception $e) {
            $this->messageManager->addException($e, __('We can\'t update the alert subscription right now.'));
        }
        $resultRedirect->setUrl($this->_redirect->getRedirectUrl());
        return $resultRedirect;



        return parent::execute();
    }


}