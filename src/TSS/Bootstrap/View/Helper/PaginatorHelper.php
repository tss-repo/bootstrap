<?php
/**
 * Created by PhpStorm.
 * User: Thiago
 * Date: 02/09/2015
 * Time: 08:33 AM
 */

namespace TSS\Bootstrap\View\Helper;


use Zend\Mvc\Controller\Plugin\Params;
use Zend\Paginator\Paginator;
use Zend\View\Helper\AbstractHelper;

class PaginatorHelper extends AbstractHelper
{

    /**
     * @var Params
     */
    protected $params;

    /**
     * @return Params
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @param Params $params
     */
    public function setParams($params)
    {
        $this->params = $params;
    }

    public function __invoke(Paginator $paginator = null, $scrollingStyle = 'sliding', $partial = null, $params = null)
    {
        if (count($paginator) != 0) {
            $paginationControl = $this->getView()->plugin('paginationControl');

            if ($params == null) {
                $params = [];
            }

            if(!isset($params['route'])) {
                $params['route'] = null;
            }
            if(!isset($params['params'])) {
                $params['params'] = [];
            }
            $params['options']['query'] = $this->params->fromQuery();
            if(!isset($params['reuseMatchedParams'])) {
                $params['reuseMatchedParams'] = true;
            }

            return $paginationControl->__invoke(
                $paginator,
                $scrollingStyle,
                array('paginator/default.phtml', 'TSS/Bootstrap'),
                $params
            );
        }
    }
}