<?php
/**
 * Created by PhpStorm.
 * User: Thiago
 * Date: 02/09/2015
 * Time: 08:33 AM
 */

namespace TSS\Bootstrap\View\Helper;


use Zend\Mvc\Controller\Plugin\Params;
use Zend\Paginator\Paginator as ZendPaginator;
use Zend\View\Helper\AbstractHelper;

class Paginator extends AbstractHelper
{
    /**
     * @var Params
     */
    protected $params;

    /**
     * Paginator constructor.
     * @param Params $params
     */
    public function __construct(Params $params)
    {
        $this->params = $params;
    }

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

    public function __invoke(ZendPaginator $paginator = null, $scrollingStyle = 'sliding', $partial = null, $params = null)
    {
        if (count($paginator) != 0) {
            $paginationControl = $this->getView()->plugin('paginationControl');

            if ($params == null) {
                $params = [];
            }

            if (!isset($params['route'])) {
                $params['route'] = null;
            }
            if (!isset($params['params'])) {
                $params['params'] = [];
            }
            $params['options']['query'] = $this->params->fromQuery();
            if (!isset($params['reuseMatchedParams'])) {
                $params['reuseMatchedParams'] = true;
            }

            return $paginationControl->__invoke(
                $paginator,
                $scrollingStyle,
                ['paginator/default.phtml', 'TSS/Bootstrap'],
                $params
            );
        }

        return '';
    }
}
