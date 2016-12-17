<?php

/* view8.html */
class __TwigTemplate_000f28bc882d5976c3350127e3a735fcb12f68019ee731e46c668ef7da81b0b8 extends Twig_Template
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
        echo "<script type = 'text/javascript' src = \"public/javascripts/buttons3.js\"> </script>

<!-- тут прописать в зависимости от длины вариантов выбот форматирования - в одну колонку или в две, маленькие инпуты или большие -->

<!-- добавить галочки -->

<form action='process.php?qId=";
        // line 7
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["question"]) ? $context["question"] : null), "id", array()), "html", null, true);
        echo "' method='post'>

    <div class = 'variantes'>
        ";
        // line 10
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["variantes"]) ? $context["variantes"] : null));
        foreach ($context['_seq'] as $context["key"] => $context["variant"]) {
            // line 11
            echo "            
            ";
            // line 12
            if ((($this->getAttribute($context["variant"], "answerIndex", array(), "array") == 98) || ($this->getAttribute($context["variant"], "answerIndex", array(), "array") == 99))) {
                // line 13
                echo "                <div class = 'answer-item-sm-1col' id = \"answer-";
                echo twig_escape_filter($this->env, $context["key"], "html", null, true);
                echo "\">
                    <div class = 'answer-num-grey'> ";
                // line 14
                echo twig_escape_filter($this->env, $this->getAttribute($context["variant"], "answerIndex", array(), "array"), "html", null, true);
                echo " </div>
                    <div class = 'answer-text-grey'> ";
                // line 15
                echo twig_escape_filter($this->env, $this->getAttribute($context["variant"], "answer_text", array(), "array"), "html", null, true);
                echo " </div>
                    <input name = \"";
                // line 16
                echo twig_escape_filter($this->env, $context["key"], "html", null, true);
                echo "\" id = \"";
                echo twig_escape_filter($this->env, $context["key"], "html", null, true);
                echo "\" class = \"input-other\" type='number' 
                    value = \"";
                // line 17
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["qData"]) ? $context["qData"] : null), $context["key"], array(), "array"), "html", null, true);
                echo "\" placeholder=\"впишите\" />
                    <div class = 'tick-hidden'><i class = 'fa fa-check'></i></div>
                </div>

            ";
            } else {
                // line 22
                echo "                <div class = 'answer-item-sm-1col' id = \"answer-";
                echo twig_escape_filter($this->env, $context["key"], "html", null, true);
                echo "\">
                    <input name = \"name[]\" id = \"";
                // line 23
                echo twig_escape_filter($this->env, $context["key"], "html", null, true);
                echo "\" type = 'radio' value = \"";
                echo twig_escape_filter($this->env, $context["key"], "html", null, true);
                echo "\"
                    ";
                // line 24
                if (($this->getAttribute((isset($context["qData"]) ? $context["qData"] : null), $context["key"], array(), "array") == "true")) {
                    echo " checked = 'checked' ";
                }
                echo " class = 'hiddenInput'>
                    <div class = 'answer-num'> ";
                // line 25
                echo twig_escape_filter($this->env, $this->getAttribute($context["variant"], "answerIndex", array(), "array"), "html", null, true);
                echo " </div>
                    <div class = 'answer-text'> ";
                // line 26
                echo twig_escape_filter($this->env, $this->getAttribute($context["variant"], "answer_text", array(), "array"), "html", null, true);
                echo " </div>
                    <div class = 'tick-hidden'> <i class = 'fa fa-check'> </i></div>
                </div>
            ";
            }
            // line 29
            echo "    
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['variant'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 31
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
        return "view8.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  104 => 31,  97 => 29,  90 => 26,  86 => 25,  80 => 24,  74 => 23,  69 => 22,  61 => 17,  55 => 16,  51 => 15,  47 => 14,  42 => 13,  40 => 12,  37 => 11,  33 => 10,  27 => 7,  19 => 1,);
    }
}
/* <script type = 'text/javascript' src = "public/javascripts/buttons3.js"> </script>*/
/* */
/* <!-- тут прописать в зависимости от длины вариантов выбот форматирования - в одну колонку или в две, маленькие инпуты или большие -->*/
/* */
/* <!-- добавить галочки -->*/
/* */
/* <form action='process.php?qId={{question.id}}' method='post'>*/
/* */
/*     <div class = 'variantes'>*/
/*         {% for key, variant in variantes %}*/
/*             */
/*             {% if variant['answerIndex'] == 98 or variant['answerIndex'] == 99 %}*/
/*                 <div class = 'answer-item-sm-1col' id = "answer-{{key}}">*/
/*                     <div class = 'answer-num-grey'> {{variant['answerIndex']}} </div>*/
/*                     <div class = 'answer-text-grey'> {{variant['answer_text']}} </div>*/
/*                     <input name = "{{key}}" id = "{{key}}" class = "input-other" type='number' */
/*                     value = "{{qData[key]}}" placeholder="впишите" />*/
/*                     <div class = 'tick-hidden'><i class = 'fa fa-check'></i></div>*/
/*                 </div>*/
/* */
/*             {% else %}*/
/*                 <div class = 'answer-item-sm-1col' id = "answer-{{key}}">*/
/*                     <input name = "name[]" id = "{{key}}" type = 'radio' value = "{{key}}"*/
/*                     {% if qData[key] == "true" %} checked = 'checked' {% endif %} class = 'hiddenInput'>*/
/*                     <div class = 'answer-num'> {{variant['answerIndex']}} </div>*/
/*                     <div class = 'answer-text'> {{variant['answer_text']}} </div>*/
/*                     <div class = 'tick-hidden'> <i class = 'fa fa-check'> </i></div>*/
/*                 </div>*/
/*             {% endif %}    */
/*         {% endfor %}*/
/*     </div>*/
/* */
/*     <div class = 'buttons'>*/
/*         <button name = "prev" id="prev" type="submit" value="back"  class = 'arrow-btn'> */
/*             <i class = 'fa fa-chevron-left fa-2x move_left'></i>*/
/*         </button>*/
/*         <button name = "next" id="next" type="submit" value="next" class = 'arrow-btn'>*/
/*             <i class = 'fa fa-chevron-right fa-2x move_right'></i>*/
/*         </button>*/
/*     </div>*/
/* */
/* </form>*/
/* */
