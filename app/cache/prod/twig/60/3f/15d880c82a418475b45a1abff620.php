<?php

/* QandaHomeBundle:Default:editProfile.html.twig */
class __TwigTemplate_603f15d880c82a418475b45a1abff620 extends Twig_Template
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
        echo "<a href=\"";
        if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("profile", array("user_name" => $this->getAttribute($_user_, "name"))), "html", null, true);
        echo "\">
    Буцах
</a>
<h3>Хувийн мэдээлэл засах хэсэг</h3>

";
        // line 9
        if (isset($context["user_form"])) { $_user_form_ = $context["user_form"]; } else { $_user_form_ = null; }
        echo         $this->env->getExtension('form')->renderer->renderBlock($_user_form_, 'form_start', array("attr" => array("novalidate" => "novalidate")));
        echo "
    ";
        // line 10
        if (isset($context["user_form"])) { $_user_form_ = $context["user_form"]; } else { $_user_form_ = null; }
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($_user_form_, 'errors');
        echo "
";
        // line 11
        $this->displayBlock('form_row', $context, $blocks);
        // line 25
        $this->displayBlock('button_row', $context, $blocks);
        // line 31
        echo "
";
        // line 32
        if (isset($context["user_form"])) { $_user_form_ = $context["user_form"]; } else { $_user_form_ = null; }
        echo         $this->env->getExtension('form')->renderer->renderBlock($_user_form_, 'form_end');
        echo "

";
    }

    // line 11
    public function block_form_row($context, array $blocks = array())
    {
        // line 12
        ob_start();
        // line 13
        echo "<div class=\"form-group\">
    ";
        // line 14
        if (isset($context["user_form"])) { $_user_form_ = $context["user_form"]; } else { $_user_form_ = null; }
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($_user_form_, "nickname"), 'label');
        echo "
    ";
        // line 15
        if (isset($context["user_form"])) { $_user_form_ = $context["user_form"]; } else { $_user_form_ = null; }
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($_user_form_, "nickname"), 'widget', array("attr" => array("class" => "form-control1")));
        echo "
    ";
        // line 16
        if (isset($context["user_form"])) { $_user_form_ = $context["user_form"]; } else { $_user_form_ = null; }
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($_user_form_, "nickname"), 'errors');
        echo "
</div>
<div class =\"form-group\">
    ";
        // line 19
        if (isset($context["user_form"])) { $_user_form_ = $context["user_form"]; } else { $_user_form_ = null; }
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($_user_form_, "description"), 'label');
        echo "
    ";
        // line 20
        if (isset($context["user_form"])) { $_user_form_ = $context["user_form"]; } else { $_user_form_ = null; }
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($_user_form_, "description"), 'widget', array("attr" => array("class" => "form-control1")));
        echo "
    ";
        // line 21
        if (isset($context["user_form"])) { $_user_form_ = $context["user_form"]; } else { $_user_form_ = null; }
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($_user_form_, "description"), 'errors');
        echo "
</div>
";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 25
    public function block_button_row($context, array $blocks = array())
    {
        // line 26
        ob_start();
        // line 27
        echo "<input type=\"submit\" value=\"Засах\" class=\"btn btn-primary\">
    ";
        // line 28
        if (isset($context["user_form"])) { $_user_form_ = $context["user_form"]; } else { $_user_form_ = null; }
        echo         $this->env->getExtension('form')->renderer->renderBlock($_user_form_, 'form_end');
        echo "
";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    public function getTemplateName()
    {
        return "QandaHomeBundle:Default:editProfile.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  120 => 28,  117 => 27,  115 => 26,  112 => 25,  103 => 21,  98 => 20,  93 => 19,  86 => 16,  81 => 15,  76 => 14,  73 => 13,  71 => 12,  68 => 11,  60 => 32,  57 => 31,  55 => 25,  53 => 11,  48 => 10,  43 => 9,  33 => 4,  30 => 3,);
    }
}
