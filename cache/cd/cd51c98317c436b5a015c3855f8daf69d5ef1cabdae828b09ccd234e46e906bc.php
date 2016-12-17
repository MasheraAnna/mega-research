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
            // line 10
            if (($this->getAttribute((isset($context["name"]) ? $context["name"] : null), 1, array(), "array") != false)) {
                // line 11
                echo "                    Добрый день, ";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["name"]) ? $context["name"] : null), 1, array(), "array"), "html", null, true);
                echo " ";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["name"]) ? $context["name"] : null), 2, array(), "array"), "html", null, true);
                echo "!
                ";
            } else {
                // line 13
                echo "                    Добрый день!
                ";
            }
            // line 15
            echo "                Ваше участие очень важно! Пожалуйста, заполните анкету до конца.
            </div>
        </div>
    ";
        }
    }

    // line 23
    public function block_content($context, array $blocks = array())
    {
        // line 24
        echo "

        ";
        // line 26
        if ((($this->getAttribute((isset($context["question"]) ? $context["question"] : null), "qView", array()) == "start") || ($this->getAttribute((isset($context["question"]) ? $context["question"] : null), "qView", array()) == "last"))) {
            // line 27
            echo "                ";
            $this->loadTemplate(($this->getAttribute((isset($context["question"]) ? $context["question"] : null), "qView", array()) . ".html"), "index.html", 27)->display($context);
            // line 28
            echo "        ";
        } else {
            // line 29
            echo "        
        <div class = 'qtext'>
            <div class = \"center-qtext\">
                <div class = 'number-and-arrow'>
                    <span class = 'text-color'> ";
            // line 33
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["question"]) ? $context["question"] : null), "qNum", array()), "html", null, true);
            echo " </span>
                    <i class = 'fa fa-arrow-right text-color'></i>
                </div>
                <div class= 'text'> ";
            // line 36
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["question"]) ? $context["question"] : null), "qText", array()), "html", null, true);
            echo " </div>
                
            </div>

        
            <div class = \"center-qtext\">
                <div class = 'number-and-arrow'></div>
                <div class= 'comment'> ";
            // line 43
            echo twig_escape_filter($this->env, twig_upper_filter($this->env, $this->getAttribute((isset($context["question"]) ? $context["question"] : null), "qComment", array())), "html", null, true);
            echo " </div>
            </div>
        </div>
        <div class = 'qarea'>
            <div class='qarea-inner'>
                ";
            // line 48
            $this->loadTemplate(($this->getAttribute((isset($context["question"]) ? $context["question"] : null), "qView", array()) . ".html"), "index.html", 48)->display($context);
            // line 49
            echo "            </div>
        </div>
        ";
        }
        // line 52
        echo "
        <script type=\"text/javascript\">

            var content_lenght = (\$(\".content\").css(\"height\").substr(0, lenght = (\$(\".content\").css(\"height\").length - 2)));
            var qtext_lenght = (\$(\".qtext\").css(\"height\").substr(0, lenght = (\$(\".qtext\").css(\"height\").length - 2)));
            var height = content_lenght - qtext_lenght;
            \$(\".qarea\").css(\"height\", height);


        </script>

";
    }

    // line 67
    public function block_footer($context, array $blocks = array())
    {
        // line 68
        echo "    ";
        if ((($this->getAttribute((isset($context["question"]) ? $context["question"] : null), "qView", array()) == "start") || ($this->getAttribute((isset($context["question"]) ? $context["question"] : null), "qView", array()) == "last"))) {
            // line 69
            echo "    ";
        } else {
            // line 70
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
        return array (  142 => 70,  139 => 69,  136 => 68,  133 => 67,  118 => 52,  113 => 49,  111 => 48,  103 => 43,  93 => 36,  87 => 33,  81 => 29,  78 => 28,  75 => 27,  73 => 26,  69 => 24,  66 => 23,  58 => 15,  54 => 13,  46 => 11,  44 => 10,  39 => 7,  36 => 6,  33 => 5,  30 => 4,  11 => 1,);
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
/* */
/*                 {% if name[1] != false %}*/
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
/*                 */
/*             </div>*/
/* */
/*         */
/*             <div class = "center-qtext">*/
/*                 <div class = 'number-and-arrow'></div>*/
/*                 <div class= 'comment'> {{question.qComment | upper }} </div>*/
/*             </div>*/
/*         </div>*/
/*         <div class = 'qarea'>*/
/*             <div class='qarea-inner'>*/
/*                 {% include question.qView~'.html' %}*/
/*             </div>*/
/*         </div>*/
/*         {% endif %}*/
/* */
/*         <script type="text/javascript">*/
/* */
/*             var content_lenght = ($(".content").css("height").substr(0, lenght = ($(".content").css("height").length - 2)));*/
/*             var qtext_lenght = ($(".qtext").css("height").substr(0, lenght = ($(".qtext").css("height").length - 2)));*/
/*             var height = content_lenght - qtext_lenght;*/
/*             $(".qarea").css("height", height);*/
/* */
/* */
/*         </script>*/
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
