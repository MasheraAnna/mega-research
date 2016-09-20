<?php

/* view3.html */
class __TwigTemplate_75e748d196dd89a3a505ef87f1de45e9fc422426d6589c494931fbbee91ef5c2 extends Twig_Template
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

    ";
        // line 3
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["variantes"]) ? $context["variantes"] : null));
        foreach ($context['_seq'] as $context["key"] => $context["variant"]) {
            // line 4
            echo "        <div>
            ";
            // line 5
            echo twig_escape_filter($this->env, $context["variant"], "html", null, true);
            echo " 
            <input name =\"";
            // line 6
            echo twig_escape_filter($this->env, $context["key"], "html", null, true);
            echo "\" id =\"";
            echo twig_escape_filter($this->env, $context["key"], "html", null, true);
            echo "\" type='number'
                   ";
            // line 7
            if ($this->getAttribute((isset($context["qData"]) ? $context["qData"] : null), $context["key"], array(), "array")) {
                echo " value = '";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["qData"]) ? $context["qData"] : null), $context["key"], array(), "array"), "html", null, true);
                echo "' ";
            }
            echo ">
        </div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['variant'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 10
        echo "    <br><br>

    <button name = \"next\" id=\"next\" type=\"submit\" style=\"width: 180px\" value=\"next\"> Следующий вопрос>> </button></br></br>
    <button name = \"prev\" id=\"prev\" type=\"submit\" style=\"width: 180px\" value=\"back\"> <<Предыдущий вопрос </button></br></br>
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
        return array (  55 => 10,  42 => 7,  36 => 6,  32 => 5,  29 => 4,  25 => 3,  19 => 1,);
    }
}
/* <form action='process.php?qId={{question.id}}' method='post'>*/
/* */
/*     {% for key, variant in variantes %}*/
/*         <div>*/
/*             {{variant}} */
/*             <input name ="{{key}}" id ="{{key}}" type='number'*/
/*                    {% if qData[key]%} value = '{{qData[key]}}' {% endif %}>*/
/*         </div>*/
/*     {% endfor %}*/
/*     <br><br>*/
/* */
/*     <button name = "next" id="next" type="submit" style="width: 180px" value="next"> Следующий вопрос>> </button></br></br>*/
/*     <button name = "prev" id="prev" type="submit" style="width: 180px" value="back"> <<Предыдущий вопрос </button></br></br>*/
/* </form>*/
/* */
