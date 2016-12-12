<?php

/* view2.html */
class __TwigTemplate_09dbc2d03a066297e937a8e6767f028a9e1db8b9f8202e0c8225b92891cd1001 extends Twig_Template
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
        // line 4
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["variantes"]) ? $context["variantes"] : null));
        foreach ($context['_seq'] as $context["key"] => $context["variant"]) {
            // line 5
            echo "            <div >
                <input name = \"name[]\" id = \"";
            // line 6
            echo twig_escape_filter($this->env, $context["key"], "html", null, true);
            echo "\" type = 'radio' value = \"";
            echo twig_escape_filter($this->env, $context["key"], "html", null, true);
            echo "\"
                       ";
            // line 7
            if (($this->getAttribute((isset($context["qData"]) ? $context["qData"] : null), $context["key"], array(), "array") == "true")) {
                echo " checked = 'checked' ";
            }
            echo " >
                ";
            // line 8
            echo twig_escape_filter($this->env, $context["variant"], "html", null, true);
            echo "
            </div>
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
        return "view2.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  54 => 11,  45 => 8,  39 => 7,  33 => 6,  30 => 5,  26 => 4,  19 => 1,);
    }
}
/* <form action='process.php?qId={{question.id}}' method='post'>*/
/*     */
/*     <div class = 'variantes'>*/
/*         {% for key, variant in variantes %}*/
/*             <div >*/
/*                 <input name = "name[]" id = "{{key}}" type = 'radio' value = "{{key}}"*/
/*                        {% if qData[key] == "true" %} checked = 'checked' {% endif %} >*/
/*                 {{variant}}*/
/*             </div>*/
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
