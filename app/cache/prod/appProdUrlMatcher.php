<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * appProdUrlMatcher
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appProdUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    /**
     * Constructor.
     */
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($pathinfo)
    {
        $allow = array();
        $pathinfo = rawurldecode($pathinfo);

        if (0 === strpos($pathinfo, '/hello')) {
            // product_list
            if (rtrim($pathinfo, '/') === '/hello') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'product_list');
                }

                return array (  '_controller' => 'Qanda\\HelloBundle\\Controller\\DefaultController::indexAction',  '_route' => 'product_list',);
            }

            // product_add
            if ($pathinfo === '/hello/add') {
                return array (  '_controller' => 'Qanda\\HelloBundle\\Controller\\DefaultController::addAction',  '_route' => 'product_add',);
            }

            // product_show
            if (0 === strpos($pathinfo, '/hello/show') && preg_match('#^/hello/show/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'product_show')), array (  '_controller' => 'Qanda\\HelloBundle\\Controller\\DefaultController::showAction',));
            }

            // product_delete
            if (0 === strpos($pathinfo, '/hello/delete') && preg_match('#^/hello/delete/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'product_delete')), array (  '_controller' => 'Qanda\\HelloBundle\\Controller\\DefaultController::deleteAction',));
            }

        }

        // question_list
        if (rtrim($pathinfo, '/') === '') {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'question_list');
            }

            return array (  '_controller' => 'Qanda\\HomeBundle\\Controller\\DefaultController::indexAction',  '_route' => 'question_list',);
        }

        if (0 === strpos($pathinfo, '/log')) {
            // logout
            if ($pathinfo === '/logout') {
                return array (  '_controller' => 'Qanda\\HomeBundle\\Controller\\DefaultController::logoutAction',  '_route' => 'logout',);
            }

            // login
            if ($pathinfo === '/login') {
                return array (  '_controller' => 'Qanda\\HomeBundle\\Controller\\DefaultController::loginAction',  '_route' => 'login',);
            }

        }

        // question_show
        if ($pathinfo === '/show') {
            return array (  '_controller' => 'Qanda\\HomeBundle\\Controller\\DefaultController::showAction',  '_route' => 'question_show',);
        }

        // profile
        if ($pathinfo === '/profile') {
            return array (  '_controller' => 'Qanda\\HomeBundle\\Controller\\DefaultController::profileAction',  '_route' => 'profile',);
        }

        // edit_profile
        if ($pathinfo === '/editProfile') {
            return array (  '_controller' => 'Qanda\\HomeBundle\\Controller\\DefaultController::editProfileAction',  '_route' => 'edit_profile',);
        }

        // question_add
        if ($pathinfo === '/addQuestion') {
            return array (  '_controller' => 'Qanda\\HomeBundle\\Controller\\DefaultController::addQuestionAction',  '_route' => 'question_add',);
        }

        // edit_question
        if ($pathinfo === '/editQuestion') {
            return array (  '_controller' => 'Qanda\\HomeBundle\\Controller\\DefaultController::editQuestionAction',  '_route' => 'edit_question',);
        }

        // register
        if ($pathinfo === '/register') {
            return array (  '_controller' => 'Qanda\\HomeBundle\\Controller\\DefaultController::registerAction',  '_route' => 'register',);
        }

        if (0 === strpos($pathinfo, '/delete')) {
            // delete_question
            if ($pathinfo === '/deleteQuestion') {
                return array (  '_controller' => 'Qanda\\HomeBundle\\Controller\\DefaultController::deleteQuestionAction',  '_route' => 'delete_question',);
            }

            // delete_answer
            if ($pathinfo === '/deleteAnswer') {
                return array (  '_controller' => 'Qanda\\HomeBundle\\Controller\\DefaultController::deleteAnswerAction',  '_route' => 'delete_answer',);
            }

        }

        // best_answer
        if ($pathinfo === '/bestAnswer') {
            return array (  '_controller' => 'Qanda\\HomeBundle\\Controller\\DefaultController::bestAnswerAction',  '_route' => 'best_answer',);
        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
