<?php

/* QandaHelloBundle:Default:show.html.twig */
class __TwigTemplate_403c449cdb6a5b24e7896e55f6d30ba0 extends Twig_Template
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
        echo "<h1>Show product</h1>

<label>Category:</label>
";
        // line 7
        if ($this->getAttribute($this->getContext($context, "product"), "category")) {
            // line 8
            echo "    ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "product"), "category"), "name"), "html", null, true);
            echo "<br/>
";
        } else {
            // line 10
            echo "    &lt;no category&gt;<br/>

";
        }
        // line 13
        echo "

<label>Name:</label>
";
        // line 16
        echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "product"), "name"), "html", null, true);
        echo "<br/>

<label>Price:</label>
";
        // line 19
        echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "product"), "price"), "html", null, true);
        echo "<br/>

<label>Description:</label>
";
        // line 22
        echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "product"), "description"), "html", null, true);
        echo "<br/>

";
    }

    public function getTemplateName()
    {
        return "QandaHelloBundle:Default:show.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  66 => 22,  60 => 19,  54 => 16,  49 => 13,  44 => 10,  38 => 8,  36 => 7,  31 => 4,  28 => 3,);
    }
}
