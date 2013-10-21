<?php

/* QandaHomeBundle:Default:show.html.twig */
class __TwigTemplate_4e91af1b3d18413ed3c3b02823afd16a extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("QandaHomeBundle::layout.html.twig");

        $this->blocks = array(
            'body' => array($this, 'block_body'),
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
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($this->getAttribute($_app_, "session"), "flashbag"), "get", array(0 => "notice"), "method"));
        foreach ($context['_seq'] as $context["_key"] => $context["flashMessage"]) {
            // line 5
            echo "        <div class=\"alert alert-success\">
            ";
            // line 6
            if (isset($context["flashMessage"])) { $_flashMessage_ = $context["flashMessage"]; } else { $_flashMessage_ = null; }
            echo twig_escape_filter($this->env, $_flashMessage_, "html", null, true);
            echo "
        </div>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['flashMessage'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 9
        echo "<h2>";
        if (isset($context["question"])) { $_question_ = $context["question"]; } else { $_question_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_question_, "title"), "html", null, true);
        echo "</h2>


<div class=\"row\">
    <div class=\"col-md-6\">
        Нэр:
        <a href=\"";
        // line 15
        if (isset($context["question"])) { $_question_ = $context["question"]; } else { $_question_ = null; }
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("profile", array("user_name" => $this->getAttribute($this->getAttribute($_question_, "user"), "name"))), "html", null, true);
        echo "\">
            ";
        // line 16
        if (isset($context["question"])) { $_question_ = $context["question"]; } else { $_question_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($_question_, "user"), "name"), "html", null, true);
        echo "
        </a>
    </div>

    <div class=\"col-md-6 text-right\">
        Огноо:
        ";
        // line 22
        if (isset($context["question"])) { $_question_ = $context["question"]; } else { $_question_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($_question_, "createdDate"), "format", array(0 => "Y-m-d H:i:s"), "method"), "html", null, true);
        echo "
    </div>
</div>
<div class=\"row\">
    <div class=\"col-md-12\">";
        // line 26
        if (isset($context["question"])) { $_question_ = $context["question"]; } else { $_question_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_question_, "question"), "html", null, true);
        echo "</div>
</div>

";
        // line 29
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        if (isset($context["question"])) { $_question_ = $context["question"]; } else { $_question_ = null; }
        if (($this->getAttribute($this->getAttribute($_app_, "session"), "get", array(0 => "name"), "method") == $this->getAttribute($this->getAttribute($_question_, "user"), "name"))) {
            // line 30
            echo "<div class=\"row\">
    <div class=\"col-md-6\">
        <a href=\"";
            // line 32
            if (isset($context["question"])) { $_question_ = $context["question"]; } else { $_question_ = null; }
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("edit_question", array("question_id" => $this->getAttribute($_question_, "id"))), "html", null, true);
            echo "\">
            Засах
        </a>
    </div>
    <div class=\"col-md-6 text-right\">
        <a href=\"";
            // line 37
            if (isset($context["question"])) { $_question_ = $context["question"]; } else { $_question_ = null; }
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("delete_question", array("question_id" => $this->getAttribute($_question_, "id"))), "html", null, true);
            echo "\">
            Устгах
        </a>
    </div>
</div>
";
        }
        // line 43
        echo "
<hr/>

<h3>Хариултууд</h3>
";
        // line 47
        if (isset($context["answers"])) { $_answers_ = $context["answers"]; } else { $_answers_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_answers_);
        foreach ($context['_seq'] as $context["_key"] => $context["answer"]) {
            // line 48
            echo "<div class=\"row\">
    <div class=\"col-md-6\">
        Нэр:
        <a href=\"";
            // line 51
            if (isset($context["answer"])) { $_answer_ = $context["answer"]; } else { $_answer_ = null; }
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("profile", array("user_name" => $this->getAttribute($this->getAttribute($_answer_, "user"), "name"))), "html", null, true);
            echo "\">
            ";
            // line 52
            if (isset($context["answer"])) { $_answer_ = $context["answer"]; } else { $_answer_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($_answer_, "user"), "name"), "html", null, true);
            echo "
        </a>
    </div>
    <div class=\"col-md-6 text-right\">
        ";
            // line 56
            if (isset($context["answer"])) { $_answer_ = $context["answer"]; } else { $_answer_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($_answer_, "createdDate"), "format", array(0 => "Y-m-d H:i:s"), "method"), "html", null, true);
            echo "
    </div>
</div>

<div class=\"row\">
    <div class=\"col-md-12\">";
            // line 61
            if (isset($context["answer"])) { $_answer_ = $context["answer"]; } else { $_answer_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_answer_, "answer"), "html", null, true);
            echo "</div>
</div>
<div class=\"row\">
    <div class=\"col-md-6\">
        ";
            // line 65
            if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
            if (isset($context["answer"])) { $_answer_ = $context["answer"]; } else { $_answer_ = null; }
            if (($this->getAttribute($this->getAttribute($_app_, "session"), "get", array(0 => "name"), "method") == $this->getAttribute($this->getAttribute($_answer_, "user"), "name"))) {
                // line 66
                echo "            <a href=\"";
                if (isset($context["answer"])) { $_answer_ = $context["answer"]; } else { $_answer_ = null; }
                echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("delete_answer", array("answer_id" => $this->getAttribute($_answer_, "id"))), "html", null, true);
                echo "\">
                Хариултыг устгах
            </a>
        ";
            }
            // line 70
            echo "    </div>
    <div class=\"col-md-6 text-right\">
        ";
            // line 72
            if (isset($context["answer"])) { $_answer_ = $context["answer"]; } else { $_answer_ = null; }
            if (isset($context["question"])) { $_question_ = $context["question"]; } else { $_question_ = null; }
            if (($this->getAttribute($_answer_, "id") == $this->getAttribute($_question_, "bestAnswerId"))) {
                // line 73
                echo "               <b>Зөв хариулт</b>
        ";
            } else {
                // line 75
                echo "            ";
                if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
                if (isset($context["question"])) { $_question_ = $context["question"]; } else { $_question_ = null; }
                if (($this->getAttribute($this->getAttribute($_app_, "session"), "get", array(0 => "name"), "method") == $this->getAttribute($this->getAttribute($_question_, "user"), "name"))) {
                    // line 76
                    echo "            <a href=\"";
                    if (isset($context["answer"])) { $_answer_ = $context["answer"]; } else { $_answer_ = null; }
                    echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("best_answer", array("answer_id" => $this->getAttribute($_answer_, "id"))), "html", null, true);
                    echo "\">
                 Хариулт зөв үү?
            </a>
            ";
                }
                // line 80
                echo "        ";
            }
            // line 81
            echo "    </div>
</div>
<br/>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['answer'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 85
        echo "<hr>
<h3>Хариулт бичих</h3>

";
        // line 88
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        if ($this->getAttribute($this->getAttribute($_app_, "session"), "get", array(0 => "name"), "method")) {
            // line 89
            echo "    ";
            if (isset($context["answer_form"])) { $_answer_form_ = $context["answer_form"]; } else { $_answer_form_ = null; }
            echo             $this->env->getExtension('form')->renderer->renderBlock($_answer_form_, 'form_start', array("attr" => array("novalidate" => "novalidate")));
            echo "
        ";
            // line 90
            if (isset($context["answer_form"])) { $_answer_form_ = $context["answer_form"]; } else { $_answer_form_ = null; }
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($_answer_form_, 'errors');
            echo "
        <div class=\"form-group\">
            ";
            // line 92
            if (isset($context["answer_form"])) { $_answer_form_ = $context["answer_form"]; } else { $_answer_form_ = null; }
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($_answer_form_, "answer"), 'label');
            echo "
            ";
            // line 93
            if (isset($context["answer_form"])) { $_answer_form_ = $context["answer_form"]; } else { $_answer_form_ = null; }
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($_answer_form_, "answer"), 'widget', array("attr" => array("class" => "form-control1")));
            echo "
            ";
            // line 94
            if (isset($context["answer_form"])) { $_answer_form_ = $context["answer_form"]; } else { $_answer_form_ = null; }
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($_answer_form_, "answer"), 'errors');
            echo "
        </div>
    ";
            // line 96
            $this->displayBlock('button_row', $context, $blocks);
            // line 102
            if (isset($context["answer_form"])) { $_answer_form_ = $context["answer_form"]; } else { $_answer_form_ = null; }
            echo             $this->env->getExtension('form')->renderer->renderBlock($_answer_form_, 'form_end');
            echo "
";
        } else {
            // line 104
            echo "    Хариулт бичхийн тулд нэр, нууц үгээрээ
    <a href=\"";
            // line 105
            echo $this->env->getExtension('routing')->getPath("login");
            echo "\"> холбогдоно </a>уу!
";
        }
        // line 107
        echo "
";
    }

    // line 96
    public function block_button_row($context, array $blocks = array())
    {
        // line 97
        echo "    ";
        ob_start();
        // line 98
        echo "    <input type=\"submit\" value=\"Оруулах\" class=\"btn btn-primary\">
        ";
        // line 99
        if (isset($context["answer_form"])) { $_answer_form_ = $context["answer_form"]; } else { $_answer_form_ = null; }
        echo         $this->env->getExtension('form')->renderer->renderBlock($_answer_form_, 'form_end');
        echo "
    ";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
        // line 101
        echo "    ";
    }

    public function getTemplateName()
    {
        return "QandaHomeBundle:Default:show.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  287 => 101,  281 => 99,  278 => 98,  275 => 97,  272 => 96,  267 => 107,  262 => 105,  259 => 104,  253 => 102,  251 => 96,  245 => 94,  240 => 93,  235 => 92,  229 => 90,  223 => 89,  220 => 88,  215 => 85,  206 => 81,  203 => 80,  194 => 76,  189 => 75,  185 => 73,  181 => 72,  177 => 70,  168 => 66,  164 => 65,  156 => 61,  147 => 56,  139 => 52,  134 => 51,  129 => 48,  124 => 47,  118 => 43,  108 => 37,  99 => 32,  95 => 30,  91 => 29,  84 => 26,  76 => 22,  66 => 16,  61 => 15,  50 => 9,  40 => 6,  37 => 5,  32 => 4,  29 => 3,);
    }
}
