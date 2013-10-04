<?php

/* QandaHelloBundle:Default:index.html.twig */
class __TwigTemplate_56ed53933d9d8f5b3deed51e3c2cfbfc extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("QandaHelloBundle::layout.html.twig");

        $this->blocks = array(
            'body' => array($this, 'block_body'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "QandaHelloBundle::layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_body($context, array $blocks = array())
    {
        // line 4
        echo "<h1>Product List</h1>

<ul>
";
        // line 7
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getContext($context, "products"));
        foreach ($context['_seq'] as $context["_key"] => $context["product"]) {
            // line 8
            echo "
    <li>
        ";
            // line 10
            if ($this->getAttribute($this->getContext($context, "product"), "category")) {
                // line 11
                echo "            ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "product"), "category"), "name"), "html", null, true);
                echo "
        ";
            } else {
                // line 13
                echo "            &lt;no category&gt;
        ";
            }
            // line 15
            echo "        :
        <a href=\"";
            // line 16
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("product_show", array("id" => $this->getAttribute($this->getContext($context, "product"), "id"))), "html", null, true);
            echo "\">
        ";
            // line 17
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "product"), "name"), "html", null, true);
            echo "
        </a>
        -
        <a href=\"";
            // line 20
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("product_delete", array("id" => $this->getAttribute($this->getContext($context, "product"), "id"))), "html", null, true);
            echo "\">
            X
        </a>
    </li>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['product'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 25
        echo "</ul>

";
    }

    public function getTemplateName()
    {
        return "QandaHelloBundle:Default:index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  80 => 25,  69 => 20,  63 => 17,  59 => 16,  56 => 15,  52 => 13,  46 => 11,  44 => 10,  40 => 8,  36 => 7,  31 => 4,  28 => 3,);
    }
}
