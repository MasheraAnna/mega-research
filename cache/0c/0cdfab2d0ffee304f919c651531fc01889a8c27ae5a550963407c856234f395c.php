<?php

/* view7.html */
class __TwigTemplate_148c47209f11b617f0099c341eb2880f1a9d0558275a19e5336faf88076c8eff extends Twig_Template
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
        echo "<script type = 'text/javascript' src = \"public/javascripts/buttons2.js\"> </script>

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
            <div class = 'answer-item-md' id = \"answer-";
            // line 12
            echo twig_escape_filter($this->env, $context["key"], "html", null, true);
            echo "\">
                <input name = \"name[]\" id = \"";
            // line 13
            echo twig_escape_filter($this->env, $context["key"], "html", null, true);
            echo "\" type = 'radio' value = \"";
            echo twig_escape_filter($this->env, $context["key"], "html", null, true);
            echo "\"
                   ";
            // line 14
            if (($this->getAttribute((isset($context["qData"]) ? $context["qData"] : null), $context["key"], array(), "array") == "true")) {
                echo " checked = 'checked' ";
            }
            echo " class = 'hiddenInput'>
                <div class = 'answer-num'> ";
            // line 15
            echo twig_escape_filter($this->env, $this->getAttribute($context["variant"], "answerIndex", array(), "array"), "html", null, true);
            echo " </div>
                <div class = 'answer-text'> ";
            // line 16
            echo twig_escape_filter($this->env, $this->getAttribute($context["variant"], "answer_text", array(), "array"), "html", null, true);
            echo " </div>
                <div class = 'tick-hidden'><i class = 'fa fa-check'></i></div>
            </div>
        
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['variant'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 21
        echo "        
    </div>
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
        return "view7.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  71 => 21,  60 => 16,  56 => 15,  50 => 14,  44 => 13,  40 => 12,  37 => 11,  33 => 10,  27 => 7,  19 => 1,);
    }
}
/* <script type = 'text/javascript' src = "public/javascripts/buttons2.js"> </script>*/
/* */
/* <!-- тут прописать в зависимости от длины вариантов выбот форматирования - в одну колонку или в две, маленькие инпуты или большие -->*/
/* */
/* <!-- добавить галочки -->*/
/* */
/* <form action='process.php?qId={{question.id}}' method='post'>*/
/*     */
/*     <div class = 'variantes'>*/
/*         {% for key, variant in variantes %}*/
/* */
/*             <div class = 'answer-item-md' id = "answer-{{key}}">*/
/*                 <input name = "name[]" id = "{{key}}" type = 'radio' value = "{{key}}"*/
/*                    {% if qData[key] == "true" %} checked = 'checked' {% endif %} class = 'hiddenInput'>*/
/*                 <div class = 'answer-num'> {{variant['answerIndex']}} </div>*/
/*                 <div class = 'answer-text'> {{variant['answer_text']}} </div>*/
/*                 <div class = 'tick-hidden'><i class = 'fa fa-check'></i></div>*/
/*             </div>*/
/*         */
/*         {% endfor %}*/
/*         */
/*     </div>*/
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
