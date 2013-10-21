<?php

/* QandaHomeBundle:Default:profile.html.twig */
class __TwigTemplate_b3303a4c40cdfd970319ddb97128a21f extends Twig_Template
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
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
        if (($this->getAttribute($this->getAttribute($_app_, "session"), "get", array(0 => "name"), "method") == $this->getAttribute($_user_, "name"))) {
            // line 10
            echo "<a href=\"";
            if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("edit_profile", array("user_name" => $this->getAttribute($_user_, "name"))), "html", null, true);
            echo "\" class=\"btn btn-primary\">
    Хувийн мэдээлэл засах
</a>
";
        }
        // line 14
        echo "<table width=\"100%\">
    <tr>
        <td width=\"50%\"><b>Нэр :</b></td>
        <td>";
        // line 17
        if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_user_, "nickname"), "html", null, true);
        echo "</td>
    </tr>
    <tr>
        <td width=\"50%\"><b>Тодорхойлолт:</b></td>
        <td>";
        // line 21
        if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_user_, "description"), "html", null, true);
        echo "</td>
    </tr>
    <tr>
        <td width=\"50%\"><b>Нийт хариултын тоо:</b></td>
        <td>";
        // line 25
        if (isset($context["total_answer"])) { $_total_answer_ = $context["total_answer"]; } else { $_total_answer_ = null; }
        echo twig_escape_filter($this->env, $_total_answer_, "html", null, true);
        echo "</td>
    </tr>
    <tr>
        <td width=\"50%\"><b>Нийт асуултын тоо:</b></td>
        <td>";
        // line 29
        if (isset($context["total_question"])) { $_total_question_ = $context["total_question"]; } else { $_total_question_ = null; }
        echo twig_escape_filter($this->env, $_total_question_, "html", null, true);
        echo "</td>
    </tr>
</table>
<br/>
<div>
    <label><b>Сүүлийн 5 хариулт: </b></label>
    <ol>
    ";
        // line 36
        if (isset($context["answers"])) { $_answers_ = $context["answers"]; } else { $_answers_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_answers_);
        foreach ($context['_seq'] as $context["_key"] => $context["answer"]) {
            // line 37
            echo "        <li>
            <a href=\"";
            // line 38
            if (isset($context["answer"])) { $_answer_ = $context["answer"]; } else { $_answer_ = null; }
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("question_show", array("question_id" => $this->getAttribute($_answer_, "questionId"))), "html", null, true);
            echo "\">
                ";
            // line 39
            if (isset($context["answer"])) { $_answer_ = $context["answer"]; } else { $_answer_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_answer_, "answer"), "html", null, true);
            echo "
            </a>
        </li>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['answer'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 43
        echo "    </ol>
    <br>
    <label><b>Сүүлийн 5 асуулт: </b></label><br/>
    <ol>
    ";
        // line 47
        if (isset($context["questions"])) { $_questions_ = $context["questions"]; } else { $_questions_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_questions_);
        foreach ($context['_seq'] as $context["_key"] => $context["question"]) {
            // line 48
            echo "        <li>
        <a href=\"";
            // line 49
            if (isset($context["question"])) { $_question_ = $context["question"]; } else { $_question_ = null; }
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("question_show", array("question_id" => $this->getAttribute($_question_, "id"))), "html", null, true);
            echo "\">
            ";
            // line 50
            if (isset($context["question"])) { $_question_ = $context["question"]; } else { $_question_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_question_, "title"), "html", null, true);
            echo "
        </a>
        </li>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['question'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 54
        echo "    </ol>
<div>
";
    }

    public function getTemplateName()
    {
        return "QandaHomeBundle:Default:profile.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  156 => 54,  145 => 50,  140 => 49,  137 => 48,  132 => 47,  126 => 43,  115 => 39,  110 => 38,  107 => 37,  102 => 36,  91 => 29,  83 => 25,  75 => 21,  67 => 17,  62 => 14,  53 => 10,  49 => 9,  39 => 6,  36 => 5,  31 => 4,  28 => 3,);
    }
}
