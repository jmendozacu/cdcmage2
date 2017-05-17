<?php
/**
 *
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace FME\Banners\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Framework\App\Filesystem\DirectoryList;


class Save extends \Magento\Backend\App\Action
{
    /**
     * @var PostDataProcessor
     */
    protected $dataProcessor;
    
    
    /**
     * @param Action\Context $context
     * @param PostDataProcessor $dataProcessor
     */
    public function __construct(Action\Context $context, PostDataProcessor $dataProcessor)
    {
        $this->dataProcessor = $dataProcessor;
        
        
        parent::__construct($context);
    }

    /**
     * {@inheritdoc}
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('FME_Banners::banners');
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        
        
        
       // echo "<pre>"; print_r($data); print_r($_FILES); exit;
        
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            
            $model = $this->_objectManager->create('FME\Banners\Model\Banners');

            $id = $this->getRequest()->getParam('banners_id');
            if ($id) {
                $model->load($id);
            }

            

            $this->_eventManager->dispatch(
                'banners_prepare_save',
                ['banners' => $model, 'request' => $this->getRequest()]
            );

            if (!$this->dataProcessor->validate($data)) {
                return $resultRedirect->setPath('*/*/edit', ['banners_id' => $model->getId(), '_current' => true]);
            }
            
            
            /* File Uploading Start */
            
            $data['bannerimage'] = $this->_processBannerImage($data, $model);
                        
             /* File Uploading End */
            
            
            $model->setData($data);
            
            try {
                $model->save();
                $this->messageManager->addSuccess(__('You saved this record.'));
                $this->_objectManager->get('Magento\Backend\Model\Session')->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['banners_id' => $model->getId(), '_current' => true]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the record.'));
            }

            $this->_getSession()->setFormData($data);
            return $resultRedirect->setPath('*/*/edit', ['banners_id' => $this->getRequest()->getParam('banners_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
    
    
    
    private function _processBannerImage($data, $model){
                
        try{
            
        
            $media_dir_obj = $this->_objectManager->get('Magento\Framework\Filesystem')
                                                    ->getDirectoryRead(DirectoryList::MEDIA);                                                                        
            $media_dir = $media_dir_obj->getAbsolutePath();


            if(!empty($_FILES['bannerimage']['name'])){

                $Uploader = $this->_objectManager->create(
                                               'Magento\MediaStorage\Model\File\Uploader',
                                                ['fileId' => 'bannerimage']);

                $Uploader->setAllowCreateFolders(true);
                $Uploader->setAllowRenameFiles(true);

                $banner_dir = $media_dir.'/banners/';                                
                $result = $Uploader->save($banner_dir);

                unset($result['tmp_name']);
                unset($result['path']);

                $data['bannerimage'] = 'banners/'.$Uploader->getUploadedFileName();

            }else{

                if(isset($data['bannerimage']['delete'])){

                    $data['bannerimage'] = '';

                }else{

                    if($model->getId()) { //edit mode

                        if($model->getBannerimage() != ''){                                        
                            $data['bannerimage'] = $model->getBannerimage();
                        }

                    }else{
                        $data['bannerimage'] = '';
                    }
                }
            }
            
            if(isset($data['bannerimage']))
                return $data['bannerimage'];    
            
        
        } catch (\Exception $e) {
        
                $this->messageManager->addError(
                        __($e->getMessage())
                );                                
        }            
        
    }
    
}
