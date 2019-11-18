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

namespace Ctech\Configurator\Controller\Adminhtml\Installer;

use Magento\Framework\View\Result\PageFactory;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Message\ManagerInterface;
use Magento\Backend\Model\Session;
use Ctech\Configurator\Helper\Data;

class Index extends \Magento\Backend\App\Action
{

    /** @var PageFactory $resultPageFactory */
    protected $resultPageFactory;
    /** @var  \Ctech\Configurator\Helper\Data $helper */
    protected $helper;
    /** @var  \Magento\Framework\Message\ManagerInterface $messageManager  */
    protected $messageManager;

    /** @var  \Magento\Backend\Model\Session $session  */
    protected $session;
    /**
     * Constructor
     *
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param Data $helper
     * @param ManagerInterface $messageManager
     * @param Session $session
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        Data $helper,
        ManagerInterface $messageManager,
        Session $session
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->helper = $helper;
        $this->messageManager = $messageManager;
        $this->session = $session;
        parent::__construct($context);
    }

    /**
     * Execute view action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $this->session->unsetData("ctechInstaller");
        $data = $this->getRequest()->getPostValue();
        if (!empty($data)) {
            $body = $this->helper->validateKey($data["storekey"], $data["storedomain"]);
            if (isset($body["message"])) {
                $this->messageManager->addError($body["message"]);
                return $this->_redirect("ctechinstaller/installer");
            }
            $this->helper->saveStoreConfig("ctech/general/store_key", $data["storekey"]);
            $this->helper->saveStoreConfig("ctech/general/store_domain", $data["storedomain"]);
            // clean cache so [store_key,store_domain] can be read from config table 
            $this->helper->cleanCache();
            $this->session->setData("ctechInstaller", [
                "apiKey" => $body['data']['api_key'],
                "domainName" => $body['data']['domainName']
            ]);
            $this->messageManager->addSuccess("Your credentials have been validated successfully");
            return $this->_redirect("ctechinstaller/installer/brand");
        }
        return $this->resultPageFactory->create();
    }
}
