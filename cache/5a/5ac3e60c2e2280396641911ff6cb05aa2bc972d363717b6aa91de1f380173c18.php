<?php

/* index.html */
class __TwigTemplate_cc5a9e26af0343eaeda71e0d7e0f8fab220ecee735af99f791141d9127b273d8 extends Twig_Template
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
        echo "    ";
        if (($this->getAttribute((isset($context["question"]) ? $context["question"] : null), "qView", array()) != "last")) {
            // line 5
            echo "        <div class='greeting'>
            ";
            // line 6
            if ((isset($context["name"]) ? $context["name"] : null)) {
                // line 7
                echo "                Добрый день, ";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["name"]) ? $context["name"] : null), 1, array(), "array"), "html", null, true);
                echo " ";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["name"]) ? $context["name"] : null), 2, array(), "array"), "html", null, true);
                echo "!
            ";
            } else {
                // line 9
                echo "                Добрый день!
            ";
            }
            // line 11
            echo "            Ваше участие очень важно для нас! Пожалуйста, заполните анкету до конца.
        </div>
        
        <div class='question'>
            </br></br>
            ";
            // line 16
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["question"]) ? $context["question"] : null), "qNum", array()), "html", null, true);
            echo ".
            ";
            // line 17
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["question"]) ? $context["question"] : null), "qText", array()), "html", null, true);
            echo "
            </br></br>
        </div>
        <div class = 'variantes'>    
            ";
            // line 21
            $this->loadTemplate(($this->getAttribute((isset($context["question"]) ? $context["question"] : null), "qView", array()) . ".html"), "index.html", 21)->display($context);
            // line 22
            echo "        </div>
    ";
        } else {
            // line 24
            echo "        <div class=\"goodbuy\">
            ";
            // line 25
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["question"]) ? $context["question"] : null), "qText", array()), "html", null, true);
            echo "
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
        return array (  78 => 25,  75 => 24,  71 => 22,  69 => 21,  62 => 17,  58 => 16,  51 => 11,  47 => 9,  39 => 7,  37 => 6,  34 => 5,  31 => 4,  28 => 3,  11 => 1,);
    }
}
/* {% extends 'base.html'%}*/
/* */
/* {% block content %}*/
/*     {% if question.qView != 'last' %}*/
/*         <div class='greeting'>*/
/*             {% if name %}*/
/*                 Добрый день, {{name[1]}} {{name[2]}}!*/
/*             {% else %}*/
/*                 Добрый день!*/
/*             {% endif %}*/
/*             Ваше участие очень важно для нас! Пожалуйста, заполните анкету до конца.*/
/*         </div>*/
/*         */
/*         <div class='question'>*/
/*             </br></br>*/
/*             {{question.qNum}}.*/
/*             {{question.qText}}*/
/*             </br></br>*/
/*         </div>*/
/*         <div class = 'variantes'>    */
/*             {% include question.qView~'.html' %}*/
/*         </div>*/
/*     {% else %}*/
/*         <div class="goodbuy">*/
/*             {{question.qText}}*/
/*         </div>*/
/*     {% endif %}*/
/* {% endblock %}*/
