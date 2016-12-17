<?php

/* view5.html */
class __TwigTemplate_2d48137db7d8a5c077fefbd6a17acded3e8b0a645112a70443a2f2385910af7d extends Twig_Template
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
    
    <table border=\"1\">
        <tr>
            <td></td>
            ";
        // line 6
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["scale"]) ? $context["scale"] : null));
        foreach ($context['_seq'] as $context["scaleKey"] => $context["scaleStep"]) {
            // line 7
            echo "            <td>";
            echo twig_escape_filter($this->env, $context["scaleStep"], "html", null, true);
            echo "</td>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['scaleKey'], $context['scaleStep'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 9
        echo "        </tr>

        ";
        // line 11
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["variantes"]) ? $context["variantes"] : null));
        foreach ($context['_seq'] as $context["key"] => $context["variant"]) {
            // line 12
            echo "            <tr>
                <td>
                    ";
            // line 14
            echo twig_escape_filter($this->env, $this->getAttribute($context["variant"], "answer_text", array(), "array"), "html", null, true);
            echo "
                </td>
                ";
            // line 16
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["scale"]) ? $context["scale"] : null));
            foreach ($context['_seq'] as $context["scaleKey"] => $context["scaleStep"]) {
                // line 17
                echo "                    <td>
                        <input name =\"";
                // line 18
                echo twig_escape_filter($this->env, $context["key"], "html", null, true);
                echo "\" id =\"";
                echo twig_escape_filter($this->env, $context["key"], "html", null, true);
                echo "_";
                echo twig_escape_filter($this->env, $context["scaleKey"], "html", null, true);
                echo "\" type='radio' value=\"";
                echo twig_escape_filter($this->env, $context["scaleKey"], "html", null, true);
                echo "\"
                               ";
                // line 19
                if (($this->getAttribute((isset($context["qData"]) ? $context["qData"] : null), $context["key"], array(), "array") == $context["scaleKey"])) {
                    echo " checked = 'checked' ";
                }
                echo ">
                    </td>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['scaleKey'], $context['scaleStep'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 22
            echo "            </tr>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['variant'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 24
        echo "    </table>

    <br><br>

    <button name = \"prev\" id=\"prev\" type=\"submit\" value=\"back\"  class = 'arrow-btn'> 
        <i class = 'fa fa-chevron-left fa-2x move_left'></i>
    </button>
    <button name = \"next\" id=\"next\" type=\"submit\" value=\"next\" class = 'arrow-btn'>
        <i class = 'fa fa-chevron-right fa-2x move_right'></i>
    </button>
</form>";
    }

    public function getTemplateName()
    {
        return "view5.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  93 => 24,  86 => 22,  75 => 19,  65 => 18,  62 => 17,  58 => 16,  53 => 14,  49 => 12,  45 => 11,  41 => 9,  32 => 7,  28 => 6,  19 => 1,);
    }
}
/* <form action='process.php?qId={{question.id}}' method='post'>*/
/*     */
/*     <table border="1">*/
/*         <tr>*/
/*             <td></td>*/
/*             {% for scaleKey, scaleStep in scale %}*/
/*             <td>{{scaleStep}}</td>*/
/*             {% endfor %}*/
/*         </tr>*/
/* */
/*         {% for key, variant in variantes %}*/
/*             <tr>*/
/*                 <td>*/
/*                     {{variant['answer_text']}}*/
/*                 </td>*/
/*                 {% for scaleKey, scaleStep in scale %}*/
/*                     <td>*/
/*                         <input name ="{{key}}" id ="{{key}}_{{scaleKey}}" type='radio' value="{{scaleKey}}"*/
/*                                {% if qData[key] == scaleKey %} checked = 'checked' {% endif %}>*/
/*                     </td>*/
/*                 {% endfor %}*/
/*             </tr>*/
/*         {% endfor %}*/
/*     </table>*/
/* */
/*     <br><br>*/
/* */
/*     <button name = "prev" id="prev" type="submit" value="back"  class = 'arrow-btn'> */
/*         <i class = 'fa fa-chevron-left fa-2x move_left'></i>*/
/*     </button>*/
/*     <button name = "next" id="next" type="submit" value="next" class = 'arrow-btn'>*/
/*         <i class = 'fa fa-chevron-right fa-2x move_right'></i>*/
/*     </button>*/
/* </form>*/
