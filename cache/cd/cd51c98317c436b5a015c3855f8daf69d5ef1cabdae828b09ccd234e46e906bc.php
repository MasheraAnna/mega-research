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
            'header' => array($this, 'block_header'),
            'content' => array($this, 'block_content'),
            'footer' => array($this, 'block_footer'),
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

    // line 4
    public function block_header($context, array $blocks = array())
    {
        // line 5
        echo "    ";
        if ((($this->getAttribute((isset($context["question"]) ? $context["question"] : null), "qView", array()) == "start") || ($this->getAttribute((isset($context["question"]) ? $context["question"] : null), "qView", array()) == "last"))) {
            // line 6
            echo "    ";
        } else {
            // line 7
            echo "        <div class='greeting'>
            <div class='greeting-text'>
                ";
            // line 9
            if ((isset($context["name"]) ? $context["name"] : null)) {
                // line 10
                echo "                    Добрый день, ";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["name"]) ? $context["name"] : null), 1, array(), "array"), "html", null, true);
                echo " ";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["name"]) ? $context["name"] : null), 2, array(), "array"), "html", null, true);
                echo "!
                ";
            } else {
                // line 12
                echo "                    Добрый день!
                ";
            }
            // line 14
            echo "                Ваше участие очень важно! Пожалуйста, заполните анкету до конца.
            </div>
        </div>
    ";
        }
    }

    // line 22
    public function block_content($context, array $blocks = array())
    {
        // line 23
        echo "

        ";
        // line 25
        if ((($this->getAttribute((isset($context["question"]) ? $context["question"] : null), "qView", array()) == "start") || ($this->getAttribute((isset($context["question"]) ? $context["question"] : null), "qView", array()) == "last"))) {
            // line 26
            echo "                ";
            $this->loadTemplate(($this->getAttribute((isset($context["question"]) ? $context["question"] : null), "qView", array()) . ".html"), "index.html", 26)->display($context);
            // line 27
            echo "        ";
        } else {
            // line 28
            echo "        
        <div class = 'qtext'>
            <div class = \"center-qtext\">
                <div class = 'number-and-arrow'>
                    <span class = 'text-color'> ";
            // line 32
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["question"]) ? $context["question"] : null), "qNum", array()), "html", null, true);
            echo " </span>
                    <i class = 'fa fa-arrow-right text-color'></i>
                </div>
                <div class= 'text'> ";
            // line 35
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["question"]) ? $context["question"] : null), "qText", array()), "html", null, true);
            echo " </div>
            </div>
        </div>
        <div class='qarea'>
            ";
            // line 39
            $this->loadTemplate(($this->getAttribute((isset($context["question"]) ? $context["question"] : null), "qView", array()) . ".html"), "index.html", 39)->display($context);
            // line 40
            echo "        </div>
        ";
        }
        // line 42
        echo "

";
    }

    // line 48
    public function block_footer($context, array $blocks = array())
    {
        // line 49
        echo "    ";
        if ((($this->getAttribute((isset($context["question"]) ? $context["question"] : null), "qView", array()) == "start") || ($this->getAttribute((isset($context["question"]) ? $context["question"] : null), "qView", array()) == "last"))) {
            // line 50
            echo "    ";
        } else {
            // line 51
            echo "        <div class = 'menueArea'>
            
            <div class = 'menueAreaItem center-item'> 
                <span class = 'center-item-text'> % заполнено </span>
                <div class = 'status-bar'>  </div>
            </div>
            
        </div>
    ";
        }
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
        return array (  120 => 51,  117 => 50,  114 => 49,  111 => 48,  105 => 42,  101 => 40,  99 => 39,  92 => 35,  86 => 32,  80 => 28,  77 => 27,  74 => 26,  72 => 25,  68 => 23,  65 => 22,  57 => 14,  53 => 12,  45 => 10,  43 => 9,  39 => 7,  36 => 6,  33 => 5,  30 => 4,  11 => 1,);
    }
}
/* {% extends 'base.html'%}*/
/* */
/* */
/* {% block header %}*/
/*     {% if question.qView == 'start' or question.qView == 'last' %}*/
/*     {% else %}*/
/*         <div class='greeting'>*/
/*             <div class='greeting-text'>*/
/*                 {% if name %}*/
/*                     Добрый день, {{name[1]}} {{name[2]}}!*/
/*                 {% else %}*/
/*                     Добрый день!*/
/*                 {% endif %}*/
/*                 Ваше участие очень важно! Пожалуйста, заполните анкету до конца.*/
/*             </div>*/
/*         </div>*/
/*     {% endif %}*/
/* {% endblock %}*/
/* */
/* */
/* */
/* {% block content %}*/
/* */
/* */
/*         {% if question.qView == 'start' or question.qView == 'last' %}*/
/*                 {% include question.qView~'.html' %}*/
/*         {% else %}*/
/*         */
/*         <div class = 'qtext'>*/
/*             <div class = "center-qtext">*/
/*                 <div class = 'number-and-arrow'>*/
/*                     <span class = 'text-color'> {{question.qNum}} </span>*/
/*                     <i class = 'fa fa-arrow-right text-color'></i>*/
/*                 </div>*/
/*                 <div class= 'text'> {{question.qText}} </div>*/
/*             </div>*/
/*         </div>*/
/*         <div class='qarea'>*/
/*             {% include question.qView~'.html' %}*/
/*         </div>*/
/*         {% endif %}*/
/* */
/* */
/* {% endblock %}*/
/* */
/* */
/* */
/* {% block footer %}*/
/*     {% if question.qView == 'start' or question.qView == 'last' %}*/
/*     {% else %}*/
/*         <div class = 'menueArea'>*/
/*             */
/*             <div class = 'menueAreaItem center-item'> */
/*                 <span class = 'center-item-text'> % заполнено </span>*/
/*                 <div class = 'status-bar'>  </div>*/
/*             </div>*/
/*             */
/*         </div>*/
/*     {% endif %}*/
/* {% endblock %}*/
