<?php

use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Psr\Log\LoggerInterface;

/**
 * appProdUrlGenerator
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appProdUrlGenerator extends Symfony\Component\Routing\Generator\UrlGenerator
{
    static private $declaredRoutes = array(
        'product_list' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'Qanda\\HelloBundle\\Controller\\DefaultController::indexAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/hello/',    ),  ),  4 =>   array (  ),),
        'product_add' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'Qanda\\HelloBundle\\Controller\\DefaultController::addAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/hello/add',    ),  ),  4 =>   array (  ),),
        'product_show' => array (  0 =>   array (    0 => 'id',  ),  1 =>   array (    '_controller' => 'Qanda\\HelloBundle\\Controller\\DefaultController::showAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'id',    ),    1 =>     array (      0 => 'text',      1 => '/hello/show',    ),  ),  4 =>   array (  ),),
        'product_delete' => array (  0 =>   array (    0 => 'id',  ),  1 =>   array (    '_controller' => 'Qanda\\HelloBundle\\Controller\\DefaultController::deleteAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'id',    ),    1 =>     array (      0 => 'text',      1 => '/hello/delete',    ),  ),  4 =>   array (  ),),
        'question_list' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'Qanda\\HomeBundle\\Controller\\DefaultController::indexAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/',    ),  ),  4 =>   array (  ),),
        'logout' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'Qanda\\HomeBundle\\Controller\\DefaultController::logoutAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/logout',    ),  ),  4 =>   array (  ),),
        'login' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'Qanda\\HomeBundle\\Controller\\DefaultController::loginAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/login',    ),  ),  4 =>   array (  ),),
        'question_show' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'Qanda\\HomeBundle\\Controller\\DefaultController::showAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/show',    ),  ),  4 =>   array (  ),),
        'profile' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'Qanda\\HomeBundle\\Controller\\DefaultController::profileAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/profile',    ),  ),  4 =>   array (  ),),
        'edit_profile' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'Qanda\\HomeBundle\\Controller\\DefaultController::editProfileAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/editProfile',    ),  ),  4 =>   array (  ),),
        'question_add' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'Qanda\\HomeBundle\\Controller\\DefaultController::addQuestionAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/addQuestion',    ),  ),  4 =>   array (  ),),
        'edit_question' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'Qanda\\HomeBundle\\Controller\\DefaultController::editQuestionAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/editQuestion',    ),  ),  4 =>   array (  ),),
        'register' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'Qanda\\HomeBundle\\Controller\\DefaultController::registerAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/register',    ),  ),  4 =>   array (  ),),
        'delete_question' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'Qanda\\HomeBundle\\Controller\\DefaultController::deleteQuestionAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/deleteQuestion',    ),  ),  4 =>   array (  ),),
        'delete_answer' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'Qanda\\HomeBundle\\Controller\\DefaultController::deleteAnswerAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/deleteAnswer',    ),  ),  4 =>   array (  ),),
        'best_answer' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'Qanda\\HomeBundle\\Controller\\DefaultController::bestAnswerAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/bestAnswer',    ),  ),  4 =>   array (  ),),
    );

    /**
     * Constructor.
     */
    public function __construct(RequestContext $context, LoggerInterface $logger = null)
    {
        $this->context = $context;
        $this->logger = $logger;
    }

    public function generate($name, $parameters = array(), $referenceType = self::ABSOLUTE_PATH)
    {
        if (!isset(self::$declaredRoutes[$name])) {
            throw new RouteNotFoundException(sprintf('Unable to generate a URL for the named route "%s" as such route does not exist.', $name));
        }

        list($variables, $defaults, $requirements, $tokens, $hostTokens) = self::$declaredRoutes[$name];

        return $this->doGenerate($variables, $defaults, $requirements, $tokens, $parameters, $name, $referenceType, $hostTokens);
    }
}
