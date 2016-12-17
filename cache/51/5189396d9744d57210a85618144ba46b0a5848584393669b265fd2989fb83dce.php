<?php

/* view4.html */
class __TwigTemplate_e0bd48ca9239d701c03e860b662ad87f6923f4ac253e3ab9d3bb4bf0307fef30 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<script type = 'text/javascript' src = \"public/javascripts/buttons4.js\"> </script>


<form action='process.php?qId=";
        // line 4
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["question"]) ? $context["question"] : null), "id", array()), "html", null, true);
        echo "' method='post'>

    <div class = 'variantes-2col'>
        ";
        // line 7
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["variantes"]) ? $context["variantes"] : null));
        foreach ($context['_seq'] as $context["key"] => $context["variant"]) {
            // line 8
            echo "            ";
            if ((($this->getAttribute($context["variant"], "answerIndex", array(), "array") != 98) && ($this->getAttribute($context["variant"], "answerIndex", array(), "array") != 99))) {
                // line 9
                echo "                <div class = 'answer-item-lg' id = \"answer-";
                echo twig_escape_filter($this->env, $context["key"], "html", null, true);
                echo "\">
                    <input name =\"";
                // line 10
                echo twig_escape_filter($this->env, $context["key"], "html", null, true);
                echo "\" id =\"";
                echo twig_escape_filter($this->env, $context["key"], "html", null, true);
                echo "\" type='checkbox' value=\"true\"
                           ";
                // line 11
                if (($this->getAttribute((isset($context["qData"]) ? $context["qData"] : null), $context["key"], array(), "array") == "true")) {
                    echo " checked = 'checked' ";
                }
                echo " class = 'hiddenInput'>
                    <div class = 'answer-num'> ";
                // line 12
                echo twig_escape_filter($this->env, $this->getAttribute($context["variant"], "answerIndex", array(), "array"), "html", null, true);
                echo " </div>
                    <div class = 'answer-text'> ";
                // line 13
                echo twig_escape_filter($this->env, $this->getAttribute($context["variant"], "answer_text", array(), "array"), "html", null, true);
                echo " </div>
                    <div class = 'tick-hidden'><i class = 'fa fa-check'></i></div>
                </div>
            ";
            }
            // line 17
            echo "        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['variant'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 18
        echo "    </div>

    <div class = 'variantes'>
        ";
        // line 21
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["variantes"]) ? $context["variantes"] : null));
        foreach ($context['_seq'] as $context["key"] => $context["variant"]) {
            // line 22
            echo "            ";
            if ((($this->getAttribute($context["variant"], "answerIndex", array(), "array") == 98) || ($this->getAttribute($context["variant"], "answerIndex", array(), "array") == 99))) {
                // line 23
                echo "                <div class = 'answer-item-lg' id = \"answer-";
                echo twig_escape_filter($this->env, $context["key"], "html", null, true);
                echo "\">
                    <input name =\"";
                // line 24
                echo twig_escape_filter($this->env, $context["key"], "html", null, true);
                echo "\" id =\"";
                echo twig_escape_filter($this->env, $context["key"], "html", null, true);
                echo "\" type='checkbox' value=\"true\"
                           ";
                // line 25
                if (($this->getAttribute((isset($context["qData"]) ? $context["qData"] : null), $context["key"], array(), "array") == "true")) {
                    echo " checked = 'checked' ";
                }
                echo " class = 'hiddenInput'>
                    <div class = 'answer-num'> ";
                // line 26
                echo twig_escape_filter($this->env, $this->getAttribute($context["variant"], "answerIndex", array(), "array"), "html", null, true);
                echo " </div>
                    <div class = 'answer-text'> ";
                // line 27
                echo twig_escape_filter($this->env, $this->getAttribute($context["variant"], "answer_text", array(), "array"), "html", null, true);
                echo " </div>
                    <div class = 'tick-hidden'><i class = 'fa fa-check'></i></div>
                </div>
            ";
            }
            // line 31
            echo "        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['variant'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 32
        echo "    </div>



    <div class = 'buttons'>
        <button name = \"prev\" id=\"prev\" type=\"submit\" value=\"back\"  class = 'arrow-btn'> 
            <i class = 'fa fa-chevron-left fa-2x move_left'></i>
        </button>
        <button name = \"next\" id=\"next\" type=\"submit\" value=\"next\" class = 'arrow-btn'>
            <i class = 'fa fa-chevron-right fa-2x move_right'></i>
        </button>
    </div>
</form>
";
    }

    public function getTemplateName()
    {
        return "view4.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  117 => 32,  111 => 31,  104 => 27,  100 => 26,  94 => 25,  88 => 24,  83 => 23,  80 => 22,  76 => 21,  71 => 18,  65 => 17,  58 => 13,  54 => 12,  48 => 11,  42 => 10,  37 => 9,  34 => 8,  30 => 7,  24 => 4,  19 => 1,);
    }
}
/* <script type = 'text/javascript' src = "public/javascripts/buttons4.js"> </script>*/
/* */
/* */
/* <form action='process.php?qId={{question.id}}' method='post'>*/
/* */
/*     <div class = 'variantes-2col'>*/
/*         {% for key, variant in variantes %}*/
/*             {% if variant['answerIndex'] != 98 and variant['answerIndex'] != 99 %}*/
/*                 <div class = 'answer-item-lg' id = "answer-{{key}}">*/
/*                     <input name ="{{key}}" id ="{{key}}" type='checkbox' value="true"*/
/*                            {% if qData[key] == "true" %} checked = 'checked' {% endif %} class = 'hiddenInput'>*/
/*                     <div class = 'answer-num'> {{variant['answerIndex']}} </div>*/
/*                     <div class = 'answer-text'> {{variant['answer_text']}} </div>*/
/*                     <div class = 'tick-hidden'><i class = 'fa fa-check'></i></div>*/
/*                 </div>*/
/*             {% endif %}*/
/*         {% endfor %}*/
/*     </div>*/
/* */
/*     <div class = 'variantes'>*/
/*         {% for key, variant in variantes %}*/
/*             {% if variant['answerIndex'] == 98 or variant['answerIndex'] == 99 %}*/
/*                 <div class = 'answer-item-lg' id = "answer-{{key}}">*/
/*                     <input name ="{{key}}" id ="{{key}}" type='checkbox' value="true"*/
/*                            {% if qData[key] == "true" %} checked = 'checked' {% endif %} class = 'hiddenInput'>*/
/*                     <div class = 'answer-num'> {{variant['answerIndex']}} </div>*/
/*                     <div class = 'answer-text'> {{variant['answer_text']}} </div>*/
/*                     <div class = 'tick-hidden'><i class = 'fa fa-check'></i></div>*/
/*                 </div>*/
/*             {% endif %}*/
/*         {% endfor %}*/
/*     </div>*/
/* */
/* */
/* */
/*     <div class = 'buttons'>*/
/*         <button name = "prev" id="prev" type="submit" value="back"  class = 'arrow-btn'> */
/*             <i class = 'fa fa-chevron-left fa-2x move_left'></i>*/
/*         </button>*/
/*         <button name = "next" id="next" type="submit" value="next" class = 'arrow-btn'>*/
/*             <i class = 'fa fa-chevron-right fa-2x move_right'></i>*/
/*         </button>*/
/*     </div>*/
/* </form>*/
/* */
