<?php

/* QandaHomeBundle:Default:editQuestion.html.twig */
class __TwigTemplate_856581f9aa39e71a3aac0107e154f0f0 extends Twig_Template
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
        if (isset($context["question"])) { $_question_ = $context["question"]; } else { $_question_ = null; }
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("question_show", array("question_id" => $this->getAttribute($_question_, "id"))), "html", null, true);
        echo "\">
    Буцах
</a>
<h3>Асуулт Засах</h3>

";
        // line 9
        if (isset($context["question_form"])) { $_question_form_ = $context["question_form"]; } else { $_question_form_ = null; }
        echo         $this->env->getExtension('form')->renderer->renderBlock($_question_form_, 'form_start', array("attr" => array("novalidate" => "novalidate")));
        echo "
    ";
        // line 10
        if (isset($context["question_form"])) { $_question_form_ = $context["question_form"]; } else { $_question_form_ = null; }
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($_question_form_, 'errors');
        echo "
";
        // line 11
        $this->displayBlock('form_row', $context, $blocks);
        // line 25
        $this->displayBlock('button_row', $context, $blocks);
        // line 31
        echo "

";
        // line 33
        if (isset($context["question_form"])) { $_question_form_ = $context["question_form"]; } else { $_question_form_ = null; }
        echo         $this->env->getExtension('form')->renderer->renderBlock($_question_form_, 'form_end');
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
        if (isset($context["question_form"])) { $_question_form_ = $context["question_form"]; } else { $_question_form_ = null; }
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($_question_form_, "title"), 'label');
        echo "
    ";
        // line 15
        if (isset($context["question_form"])) { $_question_form_ = $context["question_form"]; } else { $_question_form_ = null; }
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($_question_form_, "title"), 'widget', array("attr" => array("class" => "form-control1")));
        echo "
    ";
        // line 16
        if (isset($context["question_form"])) { $_question_form_ = $context["question_form"]; } else { $_question_form_ = null; }
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($_question_form_, "title"), 'errors');
        echo "
</div>
<div class =\"form-group\">
    ";
        // line 19
        if (isset($context["question_form"])) { $_question_form_ = $context["question_form"]; } else { $_question_form_ = null; }
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($_question_form_, "question"), 'label');
        echo "
    ";
        // line 20
        if (isset($context["question_form"])) { $_question_form_ = $context["question_form"]; } else { $_question_form_ = null; }
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($_question_form_, "question"), 'widget', array("attr" => array("class" => "form-control1")));
        echo "
    ";
        // line 21
        if (isset($context["question_form"])) { $_question_form_ = $context["question_form"]; } else { $_question_form_ = null; }
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($_question_form_, "question"), 'errors');
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
        if (isset($context["question_form"])) { $_question_form_ = $context["question_form"]; } else { $_question_form_ = null; }
        echo         $this->env->getExtension('form')->renderer->renderBlock($_question_form_, 'form_end');
        echo "
";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    public function getTemplateName()
    {
        return "QandaHomeBundle:Default:editQuestion.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  121 => 28,  118 => 27,  116 => 26,  113 => 25,  104 => 21,  99 => 20,  94 => 19,  87 => 16,  82 => 15,  77 => 14,  74 => 13,  72 => 12,  69 => 11,  61 => 33,  57 => 31,  55 => 25,  53 => 11,  48 => 10,  43 => 9,  33 => 4,  30 => 3,);
    }
}
