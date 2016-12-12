<?php

/* view3.html */
class __TwigTemplate_c4da39ea2bf64ae6e1ff8816556807f63fbb5dda34f046ce6f8eec846c9fe1f2 extends Twig_Template
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
        echo "<form action='process.php?qId=";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["question"]) ? $context["question"] : null), "id", array()), "html", null, true);
        echo "' method='post'>
    <div class = 'variantes'>
        ";
        // line 3
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["variantes"]) ? $context["variantes"] : null));
        foreach ($context['_seq'] as $context["key"] => $context["variant"]) {
            // line 4
            echo "            <div class = \"variante\">
                ";
            // line 5
            echo twig_escape_filter($this->env, $context["variant"], "html", null, true);
            echo " 
            </div>
            <input name =\"";
            // line 7
            echo twig_escape_filter($this->env, $context["key"], "html", null, true);
            echo "\" id =\"";
            echo twig_escape_filter($this->env, $context["key"], "html", null, true);
            echo "\" type='number'
               ";
            // line 8
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
        // line 11
        echo "    </div>
    <div class = 'buttons'>
        <button name = \"prev\" id=\"prev\" type=\"submit\" value=\"back\"  class = 'arrow-btn'> 
            <i class = 'fa fa-chevron-up fa-2x'></i>
        </button>
        <button name = \"next\" id=\"next\" type=\"submit\" value=\"next\" class = 'arrow-btn'>
            <i class = 'fa fa-chevron-down fa-2x'></i>
        </button>
    </div>
</form>
";
    }

    public function getTemplateName()
    {
        return "view3.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  56 => 11,  43 => 8,  37 => 7,  32 => 5,  29 => 4,  25 => 3,  19 => 1,);
    }
}
/* <form action='process.php?qId={{question.id}}' method='post'>*/
/*     <div class = 'variantes'>*/
/*         {% for key, variant in variantes %}*/
/*             <div class = "variante">*/
/*                 {{variant}} */
/*             </div>*/
/*             <input name ="{{key}}" id ="{{key}}" type='number'*/
/*                {% if qData[key]%} value = '{{qData[key]}}' {% endif %} class = 'qInput'>*/
/* */
/*         {% endfor %}*/
/*     </div>*/
/*     <div class = 'buttons'>*/
/*         <button name = "prev" id="prev" type="submit" value="back"  class = 'arrow-btn'> */
/*             <i class = 'fa fa-chevron-up fa-2x'></i>*/
/*         </button>*/
/*         <button name = "next" id="next" type="submit" value="next" class = 'arrow-btn'>*/
/*             <i class = 'fa fa-chevron-down fa-2x'></i>*/
/*         </button>*/
/*     </div>*/
/* </form>*/
/* */
