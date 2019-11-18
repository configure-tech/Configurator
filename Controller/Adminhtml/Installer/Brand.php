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

use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\PageFactory;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Message\ManagerInterface;
use Magento\Backend\Model\Session;
use Ctech\Configurator\Helper\Data;


class Brand extends \Magento\Backend\App\Action
{

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
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \Ctech\Configurator\Helper\Data $helper
     * @param \Magento\Framework\Message\ManagerInterface $messageManager
     * @param \Magento\Backend\Model\Session $session
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
     * @return ResultInterface
     */
    public function execute()
    {
        $keys = $this->session->getData("ctechInstaller");
        if (empty($keys)) {
            $this->messageManager->addNotice("Installer session has been expired , please start over");
            return $this->_redirect("ctechinstaller/installer/index");
        }
        $data = $this->getRequest()->getPostValue();
        if (!empty($data['brands'])) {
            $installer_config = $this->session->getData('ctechInstaller');
            $installer_config['brands'] = $data['brands'];
            $this->session->setData("ctechInstaller", $installer_config);
            if (count($data['brands']) == 1) {
                $this->messageManager->addSuccess("Brand has been selected");
            } else {
                $this->messageManager->addSuccess("Brands have been selected");
            }
            return $this->_redirect("ctechinstaller/installer/line");
        }
        return $this->resultPageFactory->create();
    }
}
