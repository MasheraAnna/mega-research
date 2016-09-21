<?php

/* index.html */
class __TwigTemplate_b59ca96afe4454391275d724c3888ae51dccca6ef2e50561a23ede86afe025e5 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("base.html", "index.html", 1);
        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "base.html";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_content($context, array $blocks = array())
    {
        // line 4
        echo "    <div class='greeting'>
        ";
        // line 5
        if ((isset($context["name"]) ? $context["name"] : null)) {
            // line 6
            echo "            Добрый день, ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["name"]) ? $context["name"] : null), 1, array(), "array"), "html", null, true);
            echo " ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["name"]) ? $context["name"] : null), 2, array(), "array"), "html", null, true);
            echo "!
        ";
        } else {
            // line 8
            echo "            Добрый день!
        ";
        }
        // line 10
        echo "        Ваше участие очень важно для нас! Пожалуйста, заполните анкету до конца.
    </div>

    <div class='question'>
        </br></br>
        ";
        // line 15
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["question"]) ? $context["question"] : null), "qNum", array()), "html", null, true);
        echo "
        ";
        // line 16
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["question"]) ? $context["question"] : null), "qText", array()), "html", null, true);
        echo "
        </br></br>
    </div>
    <div class = 'variantes'>    
        ";
        // line 20
        $this->loadTemplate(($this->getAttribute((isset($context["question"]) ? $context["question"] : null), "qView", array()) . ".html"), "index.html", 20)->display($context);
        // line 21
        echo "    </div>
";
    }

    public function getTemplateName()
    {
        return "index.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  68 => 21,  66 => 20,  59 => 16,  55 => 15,  48 => 10,  44 => 8,  36 => 6,  34 => 5,  31 => 4,  28 => 3,  11 => 1,);
    }
}
/* {% extends 'base.html'%}*/
/* */
/* {% block content %}*/
/*     <div class='greeting'>*/
/*         {% if name %}*/
/*             Добрый день, {{name[1]}} {{name[2]}}!*/
/*         {% else %}*/
/*             Добрый день!*/
/*         {% endif %}*/
/*         Ваше участие очень важно для нас! Пожалуйста, заполните анкету до конца.*/
/*     </div>*/
/* */
/*     <div class='question'>*/
/*         </br></br>*/
/*         {{question.qNum}}*/
/*         {{question.qText}}*/
/*         </br></br>*/
/*     </div>*/
/*     <div class = 'variantes'>    */
/*         {% include question.qView~'.html' %}*/
/*     </div>*/
/* {% endblock %}*/
