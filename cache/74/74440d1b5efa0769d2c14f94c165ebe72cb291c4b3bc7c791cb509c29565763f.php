<?php

/* view6.html */
class __TwigTemplate_37d6a2b6201511e1927264e3df4c0ecf36a42ea6b016d1c688bd7e164492ac17 extends Twig_Template
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
            <div class='q1'>
                ";
            // line 6
            echo twig_escape_filter($this->env, $context["variant"], "html", null, true);
            echo "
            </div>
            <input name =\"";
            // line 8
            echo twig_escape_filter($this->env, $context["key"], "html", null, true);
            echo "\" id =\"";
            echo twig_escape_filter($this->env, $context["key"], "html", null, true);
            echo "\" type='text'
                   ";
            // line 9
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
        // line 12
        echo "
    <br><br>
    Сумма:
    <br><br><br>

    <button name = \"next\" id=\"next\" type=\"submit\" style=\"width: 180px\" value=\"next\"> Следующий вопрос>> </button></br></br>
    <button name = \"prev\" id=\"prev\" type=\"submit\" style=\"width: 180px\" value=\"back\"> <<Предыдущий вопрос </button></br></br>
</form>
";
    }

    public function getTemplateName()
    {
        return "view6.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  57 => 12,  44 => 9,  38 => 8,  33 => 6,  29 => 4,  25 => 3,  19 => 1,);
    }
}
/* <form action='process.php?qId={{question.id}}' method='post'>*/
/* */
/*     {% for key, variant in variantes %}*/
/*         <div>*/
/*             <div class='q1'>*/
/*                 {{variant}}*/
/*             </div>*/
/*             <input name ="{{key}}" id ="{{key}}" type='text'*/
/*                    {% if qData[key]%} value = '{{qData[key]}}' {% endif %}>*/
/*         </div>*/
/*         {% endfor %}*/
/* */
/*     <br><br>*/
/*     Сумма:*/
/*     <br><br><br>*/
/* */
/*     <button name = "next" id="next" type="submit" style="width: 180px" value="next"> Следующий вопрос>> </button></br></br>*/
/*     <button name = "prev" id="prev" type="submit" style="width: 180px" value="back"> <<Предыдущий вопрос </button></br></br>*/
/* </form>*/
/* */
