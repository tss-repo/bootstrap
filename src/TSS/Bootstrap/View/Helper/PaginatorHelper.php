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

    public function __invoke(Paginator $paginator = null, $route = null, $params = null, $options = null, $scrollingStyle = 'sliding')
    {
        if (count($paginator) != 0) {
            $paginationControl = $this->getView()->plugin('paginationControl');

            if ($options != null) {
                $options['query'] = $this->params->fromQuery();
            } else {
                $options = array('query' => $this->params->fromQuery());
            }

            return $paginationControl->__invoke(
                $paginator,
                $scrollingStyle,
                array('paginator/default.phtml', 'TSS Bootstrap'),
                array('route' => $route, 'params' => $params, 'options' => $options)
            );
        }
    }
}