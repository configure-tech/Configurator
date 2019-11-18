<?php

/**
 * Copyright (c) 2019 Tawfek Daghistani - ConfigureTech
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

namespace Ctech\Configurator\Cron;

use Psr\Log\LoggerInterface;
use Ctech\Configurator\Model\ResourceModel\Product\CollectionFactory;
use Ctech\Configurator\Helper\Data;
use Magento\Framework\Notification\NotifierInterface as NotifierPool;

class Import
{
    /**
     * @var LoggerInterface $logger
     */
    protected $logger;

    /**
     * @var CollectionFactory $collectionFactory
     */
    protected $collectionFactory;

    /**
     * @var Data $helper
     */
    protected $helper;

    /**
     * Notifier Pool
     *
     * @var NotifierPool
     */
    protected $notifierPool;


    /**
     * Constructor
     *
     * @param LoggerInterface $logger
     */
    public function __construct(CollectionFactory $collectionFactory, Data $helper, LoggerInterface $logger, NotifierPool $notifierPool)
    {
        $this->collectionFactory = $collectionFactory;
        $this->helper = $helper;
        $this->logger = $logger;
        $this->notifierPool = $notifierPool;
    }

    /**
     * Execute the cron
     *
     * @return void
     */
    public function execute()
    {
        $this->logger->info("ConfigureTech create product cronjob started executing.");
        try {
            $products = $this->collectionFactory->create()
                ->addFieldToFilter('status', array('eq' => 'new'))
                ->setPageSize(5);
            if ($products->count() > 0) {
                $skus = [];
                $this->logger->info("found " . $products->count() . " product(s) to work on ");
                foreach ($products as $product) {
                    $name = $product->getName();
                    $this->logger->info("I'll work on " . $product->getName()  . ", id : " . $product->getId());
                    $result = $this->helper->createProducts($product->getData());
                    if ($result['success'] === 'true') {
                        $this->logger->info("SUCCUESS: " . $result['message']);
                        $product->setStatus('success');
                        $skus[] = $name;
                    } else {
                        $this->logger->info("FALIURE: " . $result['message']);
                        $product->setStatus('failed');
                    }
                    $now = new \DateTime('now');
                    $product->setUpdatedAt($now->getTimestamp());
                    $product->save();
                    $this->logger->info("finished working on " . $product->getName());
                }
                $this->notifierPool->addNotice("[ConfigureTech Product Installer] successfully created " .  count($skus) . " Products", implode(" , ", $skus));
            }
        } catch (\Throwable $th) {
            $this->logger->error($th->getMessage());
            $this->logger->info("failed to exectue the  cron , check error log");
        }
        $this->logger->info("ConfigureTech create product cronjob  finished executing.");
    }
}
