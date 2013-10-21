<?php

/* QandaHomeBundle:Default:index.html.twig */
class __TwigTemplate_a6eb08a1bdde34c88da3c19ec560e7e6 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("QandaHomeBundle::layout.html.twig");

        $this->blocks = array(
            'body' => array($this, 'block_body'),
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
        if (isset($context["questions"])) { $_questions_ = $context["questions"]; } else { $_questions_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_questions_);
        foreach ($context['_seq'] as $context["_key"] => $context["question"]) {
            // line 10
            echo "<div class=\"row\">
    <div class=\"col-md-12\">
        <h4>
            <a href=\"";
            // line 13
            if (isset($context["question"])) { $_question_ = $context["question"]; } else { $_question_ = null; }
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("question_show", array("question_id" => $this->getAttribute($_question_, "id"))), "html", null, true);
            echo "\">
                ";
            // line 14
            if (isset($context["question"])) { $_question_ = $context["question"]; } else { $_question_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_question_, "title"), "html", null, true);
            echo "
            </a>
        </h4>
    </div>
</div>
<div class=\"row\">
    <div class=\"col-md-6\">
        Нэр:
        <strong>
            <a href=\"";
            // line 23
            if (isset($context["question"])) { $_question_ = $context["question"]; } else { $_question_ = null; }
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("profile", array("user_name" => $this->getAttribute($this->getAttribute($_question_, "user"), "name"))), "html", null, true);
            echo "\">
                ";
            // line 24
            if (isset($context["question"])) { $_question_ = $context["question"]; } else { $_question_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($_question_, "user"), "name"), "html", null, true);
            echo "
            </a>
        </strong>
    </div>
    <div class=\"col-md-6 text-right\">
        Огноо:
        ";
            // line 30
            if (isset($context["question"])) { $_question_ = $context["question"]; } else { $_question_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($_question_, "createdDate"), "format", array(0 => "Y-m-d H:i:s"), "method"), "html", null, true);
            echo "
    </div>
</div>
<div class=\"row\">
    <div class=\"col-md-12\">";
            // line 34
            if (isset($context["question"])) { $_question_ = $context["question"]; } else { $_question_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_question_, "question"), "html", null, true);
            echo "</div>
</div>
<div class=\"row\">
    <div class=\"col-md-6\">
        <i>Хариултаа авч чадсан эсэх:</i>
        <strong>
        ";
            // line 40
            if (isset($context["question"])) { $_question_ = $context["question"]; } else { $_question_ = null; }
            if ($this->getAttribute($_question_, "isAnswered", array(), "method")) {
                // line 41
                echo "            Тийм
        ";
            } else {
                // line 43
                echo "            Үгүй
        ";
            }
            // line 45
            echo "        </strong>
    </div>
    <div class=\"col-md-6 text-right\">
        <i>Нийт хариултын тоо:</i>
        <strong>";
            // line 49
            if (isset($context["question"])) { $_question_ = $context["question"]; } else { $_question_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_question_, "getAnswerCount"), "html", null, true);
            echo "</strong>
    </div>
</div>
<hr/>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['question'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 54
        echo "
<ul class=\"pagination\">
";
        // line 56
        if (isset($context["pager"])) { $_pager_ = $context["pager"]; } else { $_pager_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($_pager_, "pages"));
        foreach ($context['_seq'] as $context["_key"] => $context["page"]) {
            // line 57
            echo "    ";
            if (isset($context["pager"])) { $_pager_ = $context["pager"]; } else { $_pager_ = null; }
            if (isset($context["page"])) { $_page_ = $context["page"]; } else { $_page_ = null; }
            if (($this->getAttribute($_pager_, "current_page") == $_page_)) {
                // line 58
                echo "        <li class=\"active\"><span>";
                if (isset($context["page"])) { $_page_ = $context["page"]; } else { $_page_ = null; }
                echo twig_escape_filter($this->env, $_page_, "html", null, true);
                echo "</span></li>
    ";
            } else {
                // line 60
                echo "        <li class=\"disabled\">
            <a href=\"";
                // line 61
                if (isset($context["page"])) { $_page_ = $context["page"]; } else { $_page_ = null; }
                echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("question_list", array("page" => $_page_)), "html", null, true);
                echo "\">
                ";
                // line 62
                if (isset($context["page"])) { $_page_ = $context["page"]; } else { $_page_ = null; }
                echo twig_escape_filter($this->env, $_page_, "html", null, true);
                echo "
            </a>
        </li>
    ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['page'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 67
        echo "</ul>
";
    }

    public function getTemplateName()
    {
        return "QandaHomeBundle:Default:index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  180 => 67,  168 => 62,  163 => 61,  160 => 60,  153 => 58,  148 => 57,  143 => 56,  139 => 54,  127 => 49,  121 => 45,  117 => 43,  113 => 41,  110 => 40,  100 => 34,  92 => 30,  82 => 24,  77 => 23,  64 => 14,  59 => 13,  54 => 10,  49 => 9,  39 => 6,  36 => 5,  31 => 4,  28 => 3,);
    }
}
