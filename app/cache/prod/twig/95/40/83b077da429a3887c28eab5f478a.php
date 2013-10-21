<?php

/* QandaHomeBundle::layout.html.twig */
class __TwigTemplate_954083b077da429a3887c28eab5f478a extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'body' => array($this, 'block_body'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"utf-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <meta name=\"description\" content=\"\">
    <meta name=\"author\" content=\"\">
    <link rel=\"stylesheet\" href=\"";
        // line 8
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/qandahome/css/bootstrap.css"), "html", null, true);
        echo "\" />
    ";
        // line 9
        if (isset($context['assetic']['debug']) && $context['assetic']['debug']) {
            // asset "f3f6982_0"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_f3f6982_0") : $this->env->getExtension('assets')->getAssetUrl("css/f3f6982_bootstrap_1.css");
            // line 13
            echo "    <link rel=\"stylesheet\" href=\"";
            if (isset($context["asset_url"])) { $_asset_url_ = $context["asset_url"]; } else { $_asset_url_ = null; }
            echo twig_escape_filter($this->env, $_asset_url_, "html", null, true);
            echo "\" />
    ";
        } else {
            // asset "f3f6982"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_f3f6982") : $this->env->getExtension('assets')->getAssetUrl("css/f3f6982.css");
            echo "    <link rel=\"stylesheet\" href=\"";
            if (isset($context["asset_url"])) { $_asset_url_ = $context["asset_url"]; } else { $_asset_url_ = null; }
            echo twig_escape_filter($this->env, $_asset_url_, "html", null, true);
            echo "\" />
    ";
        }
        unset($context["asset_url"]);
        // line 15
        echo "    <title>";
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
</head>

<body>
    <div class=\"navbar navbar-inverse navbar-fixed\">
      <div class=\"container\">
        <div class=\"navbar-header\">
          <button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\".navbar-collapse\">
            <span class=\"icon-bar\"></span>
            <span class=\"icon-bar\"></span>
            <span class=\"icon-bar\"></span>
          </button>
        </div>
        <div class=\"collapse navbar-collapse\">
          <ul class=\"nav navbar-nav\">
            <li><a href=\"";
        // line 30
        echo $this->env->getExtension('routing')->getPath("question_list");
        echo "\">Нүүр хуудас</a></li>
            <li>
                <a href=\"";
        // line 32
        echo $this->env->getExtension('routing')->getPath("question_add");
        echo "\">Асуулт оруулах</a>
            </li>
            ";
        // line 34
        if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
        if ($this->getAttribute($this->getAttribute($_app_, "session"), "get", array(0 => "name"), "method")) {
            // line 35
            echo "                <li><a href=\"profile?user_name=";
            if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($_app_, "session"), "get", array(0 => "name"), "method"), "html", null, true);
            echo "\">";
            if (isset($context["app"])) { $_app_ = $context["app"]; } else { $_app_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($_app_, "session"), "get", array(0 => "name"), "method"), "html", null, true);
            echo "</a></li>
                <li><a href=";
            // line 36
            echo $this->env->getExtension('routing')->getPath("logout");
            echo ">Гарах</a></li>
            ";
        } else {
            // line 38
            echo "            <li>
                <a href=\"";
            // line 39
            echo $this->env->getExtension('routing')->getPath("login");
            echo "\">Нэвтрэх</a>
            </li>
            ";
        }
        // line 42
        echo "          </ul>
        </div>
      </div>
    </div>
        <div class=\"container\">
            ";
        // line 47
        $this->displayBlock('body', $context, $blocks);
        // line 48
        echo "      </div>
    </div>
    ";
        // line 50
        if (isset($context['assetic']['debug']) && $context['assetic']['debug']) {
            // asset "d0771ae_0"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_d0771ae_0") : $this->env->getExtension('assets')->getAssetUrl("js/d0771ae_bootstrap.min_1.js");
            // line 51
            echo "        <script type=\"text/javascript\" src=\"";
            if (isset($context["asset_url"])) { $_asset_url_ = $context["asset_url"]; } else { $_asset_url_ = null; }
            echo twig_escape_filter($this->env, $_asset_url_, "html", null, true);
            echo "\"></script>
    ";
        } else {
            // asset "d0771ae"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_d0771ae") : $this->env->getExtension('assets')->getAssetUrl("js/d0771ae.js");
            echo "        <script type=\"text/javascript\" src=\"";
            if (isset($context["asset_url"])) { $_asset_url_ = $context["asset_url"]; } else { $_asset_url_ = null; }
            echo twig_escape_filter($this->env, $_asset_url_, "html", null, true);
            echo "\"></script>
    ";
        }
        unset($context["asset_url"]);
        // line 53
        echo "</body>
</html>
";
    }

    // line 15
    public function block_title($context, array $blocks = array())
    {
    }

    // line 47
    public function block_body($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "QandaHomeBundle::layout.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  153 => 47,  148 => 15,  142 => 53,  126 => 51,  122 => 50,  118 => 48,  116 => 47,  109 => 42,  100 => 38,  95 => 36,  83 => 34,  78 => 32,  54 => 15,  38 => 13,  34 => 9,  21 => 1,  120 => 28,  117 => 27,  115 => 26,  112 => 25,  103 => 39,  98 => 20,  93 => 19,  86 => 35,  81 => 15,  76 => 14,  73 => 30,  71 => 12,  68 => 11,  60 => 32,  57 => 31,  55 => 25,  53 => 11,  48 => 10,  43 => 9,  33 => 4,  30 => 8,);
    }
}
