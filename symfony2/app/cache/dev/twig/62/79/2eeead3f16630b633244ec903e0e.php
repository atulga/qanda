<?php

/* QandaHelloBundle::layout.html.twig */
class __TwigTemplate_62792eeead3f16630b633244ec903e0e extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'body' => array($this, 'block_body'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE HTML>
<html>
<body>
    <ul>
        <li><a href=\"";
        // line 5
        echo $this->env->getExtension('routing')->getPath("product_list");
        echo "\">Products list</a></li>
        <li><a href=\"";
        // line 6
        echo $this->env->getExtension('routing')->getPath("product_add");
        echo "\">Add product</a></li>
    </ul>
";
        // line 8
        $this->displayBlock('body', $context, $blocks);
        // line 9
        echo "</body>
</html>
";
    }

    // line 8
    public function block_body($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "QandaHelloBundle::layout.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  43 => 8,  37 => 9,  35 => 8,  30 => 6,  26 => 5,  20 => 1,  74 => 22,  63 => 17,  57 => 14,  52 => 13,  46 => 11,  44 => 10,  40 => 8,  36 => 7,  31 => 4,  28 => 3,);
    }
}
