<?php

/*
 * This file is part of the UniplacesPaginationBundle package.
 *
 * (c) Uniplaces
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Uniplaces\PaginationBundle\Extension\Twig;

use Symfony\Component\DependencyInjection\Container;

use Uniplaces\PaginationBundle\Paginator\Paginator;

/**
 * PaginateTwigExtension.
 *
 * @author Miguel Manso <miguel.manso@uniplaces.com>
 */
class PaginateTwigExtension extends \Twig_Extension
{
    private $environment;

    private $templates;

    public function __construct($templates = null)
    {
        $this->templates = $templates;
    }

    /**
     * {@inheritdoc}
     */
    public function initRuntime(\Twig_Environment $environment)
    {
        $this->environment = $environment;
    }

    public function getFunctions()
    {
        return array(
            'paginate_widget'   => new \Twig_Function_Method($this, 'paginateWidget',   array('is_safe' => array('html'))),
            'paginate_previous' => new \Twig_Function_Method($this, 'paginatePrevious', array('is_safe' => array('html'))),
            'paginate_next'     => new \Twig_Function_Method($this, 'paginateNext',     array('is_safe' => array('html'))),
            'paginate_first'    => new \Twig_Function_Method($this, 'paginateFirst',    array('is_safe' => array('html'))),
            'paginate_last'     => new \Twig_Function_Method($this, 'paginateLast',     array('is_safe' => array('html'))),
            'paginate_pages'    => new \Twig_Function_Method($this, 'paginatePages',    array('is_safe' => array('html'))),
        );
    }

    public function paginateWidget(Paginator $paginator, $route, $routeParameters = null, $themeTemplate = null, $blockPrepend = '')
    {
        return $this->paginate('widget', $paginator, $route, $routeParameters, $themeTemplate, $blockPrepend);
    }

    public function paginatePrevious(Paginator $paginator, $route, $routeParameters = null, $themeTemplate = null, $blockPrepend = '')
    {
        return $this->paginate('previous', $paginator, $route, $routeParameters, $themeTemplate, $blockPrepend);
    }

    public function paginateNext(Paginator $paginator, $route, $routeParameters = null, $themeTemplate = null, $blockPrepend = '')
    {
        return $this->paginate('next', $paginator, $route, $routeParameters, $themeTemplate, $blockPrepend);
    }

    public function paginateFirst(Paginator $paginator, $route, $routeParameters = null, $themeTemplate = null, $blockPrepend = '')
    {
        return $this->paginate('first', $paginator, $route, $routeParameters, $themeTemplate, $blockPrepend);
    }

    public function paginateLast(Paginator $paginator, $route, $routeParameters = null, $themeTemplate = null, $blockPrepend = '')
    {
        return $this->paginate('last', $paginator, $route, $routeParameters, $themeTemplate, $blockPrepend);
    }

    public function paginatePages(Paginator $paginator, $route, $routeParameters = null, $themeTemplate = null, $blockPrepend = '')
    {
        return $this->paginate('pages', $paginator, $route, $routeParameters, $themeTemplate, $blockPrepend);
    }

    private function paginate($section, Paginator $paginator, $route, $routeParameters = null, $themeTemplate = null, $blockPrepend = '')
    {
        if (empty($routeParameters)) {
            $routeParameters = array();
        }

        if (!is_string($blockPrepend)) {
            $blockPrepend = '';
        }

        $blocks = array();
        foreach ($this->templates as $template) {
            $template = $this->environment->loadTemplate($template);
            $blocks = array_merge($blocks, $template->getBlocks());
        }

        if ($themeTemplate instanceof \Twig_TemplateInterface) {
            $blocks = array_merge($blocks, $themeTemplate->getBlocks());
        }

        $blockName = 'paginate_' . $section;

        if (!isset($blocks[$blockPrepend  . '_' . $blockName])) {
            if (!isset($blocks[$blockName])) {
                throw new \LogicException('Neither "' . $blockPrepend  . '_' . $blockName . '" or "' . $blockName . '" blocks are defined');
            }
        } else {
            $blockName = $blockPrepend . '_' . $blockName;
        }

        if (!isset($blocks[$blockName])) {
            throw new \LogicException('Block "' . $blockName . '" is not defined');
        }

        ob_start();
        $template->displayBlock(
            $blockName,
            array(
                'paginator'       => $paginator,
                'pages'           => $paginator->getPages(),
                'route'           => $route,
                'routeParameters' => $routeParameters,
                'themeTemplate'   => $themeTemplate,
                'blockPrepend'    => $blockPrepend
            ),
            $blocks
        );
        $html = ob_get_clean();

        return $html;
    }

    public function getName()
    {
        return 'paginate_twig_extension';
    }
    
}
