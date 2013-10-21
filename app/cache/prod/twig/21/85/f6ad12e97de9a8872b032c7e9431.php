<?php

/* QandaHomeBundle:Default:login.html.twig */
class __TwigTemplate_2185f6ad12e97de9a8872b032c7e9431 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("QandaHomeBundle::layout.html.twig");

        $this->blocks = array(
            'body' => array($this, 'block_body'),
            'form_row' => array($this, 'block_form_row'),
            'button_row' => array($this, 'block_button_row'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "QandaHomeBundle::layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_body($context, array $blocks = array())
    {
        // line 4
        echo "<h1>Нэвтрэх хэсэг</h1>
";
        // line 5
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($this->getAttribute($_app_, "session"), "flashbag"), "get", array(0 => "notice"), "method"));
        foreach ($context['_seq'] as $context["_key"] => $context["flashMessage"]) {
            // line 6
            echo "        <div class=\"alert alert-danger\">
            ";
            // line 7
            if (isset($context["flashMessage"])) { $_flashMessage_ = $context["flashMessage"]; } else { $_flashMessage_ = null; }
            echo twig_escape_filter($this->env, $_flashMessage_, "html", null, true);
            echo "
        </div>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['flashMessage'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 10
        if (isset($context["login_form"])) { $_login_form_ = $context["login_form"]; } else { $_login_form_ = null; }
        echo         $this->env->getExtension('form')->renderer->renderBlock($_login_form_, 'form_start', array("attr" => array("novalidate" => "novalidate")));
        echo "
";
        // line 11
        if (isset($context["login_form"])) { $_login_form_ = $context["login_form"]; } else { $_login_form_ = null; }
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($_login_form_, 'errors');
        echo "
";
        // line 12
        $this->displayBlock('form_row', $context, $blocks);
        // line 27
        $this->displayBlock('button_row', $context, $blocks);
    }

    // line 12
    public function block_form_row($context, array $blocks = array())
    {
        // line 13
        ob_start();
        // line 14
        echo "<div class=\"form-group\">
    ";
        // line 15
        if (isset($context["login_form"])) { $_login_form_ = $context["login_form"]; } else { $_login_form_ = null; }
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($_login_form_, "name"), 'label');
        echo "
    ";
        // line 16
        if (isset($context["login_form"])) { $_login_form_ = $context["login_form"]; } else { $_login_form_ = null; }
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($_login_form_, "name"), 'widget', array("attr" => array("class" => "form-control1")));
        echo "
    <p class=\"text-danger\">";
        // line 17
        if (isset($context["login_form"])) { $_login_form_ = $context["login_form"]; } else { $_login_form_ = null; }
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($_login_form_, "name"), 'errors');
        echo "
    </p>
</div>
<div class =\"form-group\">
    ";
        // line 21
        if (isset($context["login_form"])) { $_login_form_ = $context["login_form"]; } else { $_login_form_ = null; }
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($_login_form_, "password"), 'label');
        echo "
    ";
        // line 22
        if (isset($context["login_form"])) { $_login_form_ = $context["login_form"]; } else { $_login_form_ = null; }
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($_login_form_, "password"), 'widget', array("attr" => array("class" => "form-control1")));
        echo "
    ";
        // line 23
        if (isset($context["login_form"])) { $_login_form_ = $context["login_form"]; } else { $_login_form_ = null; }
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($_login_form_, "password"), 'errors');
        echo "
</div>
";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 27
    public function block_button_row($context, array $blocks = array())
    {
        // line 28
        ob_start();
        // line 29
        echo "<input type=\"submit\" value=\"Нэвтрэх\" class=\"btn btn-primary\">
    ";
        // line 30
        if (isset($context["login_form"])) { $_login_form_ = $context["login_form"]; } else { $_login_form_ = null; }
        echo         $this->env->getExtension('form')->renderer->renderBlock($_login_form_, 'form_end');
        echo "
<a href=\"";
        // line 31
        echo $this->env->getExtension('routing')->getPath("register");
        echo "\">Шинээр бүртгүүлэх</a>
";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    public function getTemplateName()
    {
        return "QandaHomeBundle:Default:login.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  128 => 31,  123 => 30,  120 => 29,  118 => 28,  115 => 27,  106 => 23,  101 => 22,  96 => 21,  88 => 17,  83 => 16,  78 => 15,  75 => 14,  73 => 13,  70 => 12,  66 => 27,  64 => 12,  59 => 11,  54 => 10,  44 => 7,  41 => 6,  36 => 5,  33 => 4,  30 => 3,);
    }
}
