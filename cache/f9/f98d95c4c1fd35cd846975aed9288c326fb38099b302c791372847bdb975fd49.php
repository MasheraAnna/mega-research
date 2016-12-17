<?php

/* view1.html */
class __TwigTemplate_a8eb247a799f6291c3d230b1033dcd77f7f5c93e677d2e8c85f4008f8fef1d49 extends Twig_Template
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
        echo "<script type=\"text/javascript\" src = 'public/javascripts/if_inputs_full.js'> </script>

<form action='process.php?qId=";
        // line 3
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["question"]) ? $context["question"] : null), "id", array()), "html", null, true);
        echo "' method='post'>
    <div class = 'variantes'>
        ";
        // line 5
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["variantes"]) ? $context["variantes"] : null));
        foreach ($context['_seq'] as $context["key"] => $context["variant"]) {
            echo "    
            <input name =\"";
            // line 6
            echo twig_escape_filter($this->env, $context["key"], "html", null, true);
            echo "\" id =\"";
            echo twig_escape_filter($this->env, $context["key"], "html", null, true);
            echo "\" type='text' placeholder=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["variant"], "answer_text", array(), "array"), "html", null, true);
            echo "\" 
            ";
            // line 7
            if ($this->getAttribute((isset($context["qData"]) ? $context["qData"] : null), $context["key"], array(), "array")) {
                echo " value = '";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["qData"]) ? $context["qData"] : null), $context["key"], array(), "array"), "html", null, true);
                echo "' ";
            }
            echo " class = 'qInput'>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['variant'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 9
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
        return "view1.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  54 => 9,  42 => 7,  34 => 6,  28 => 5,  23 => 3,  19 => 1,);
    }
}
/* <script type="text/javascript" src = 'public/javascripts/if_inputs_full.js'> </script>*/
/* */
/* <form action='process.php?qId={{question.id}}' method='post'>*/
/*     <div class = 'variantes'>*/
/*         {% for key, variant in variantes %}    */
/*             <input name ="{{key}}" id ="{{key}}" type='text' placeholder="{{variant['answer_text']}}" */
/*             {% if qData[key] %} value = '{{qData[key]}}' {% endif %} class = 'qInput'>*/
/*         {% endfor %}*/
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
/* */
/* */
/* */
