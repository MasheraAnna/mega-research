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
            <input name =\"";
            // line 5
            echo twig_escape_filter($this->env, $context["key"], "html", null, true);
            echo "\" id =\"";
            echo twig_escape_filter($this->env, $context["key"], "html", null, true);
            echo "\" type='checkbox' value=\"true\"
                   ";
            // line 6
            if (($this->getAttribute((isset($context["qData"]) ? $context["qData"] : null), $context["key"], array(), "array") == true)) {
                echo " checked = 'checked' ";
            }
            echo ">
            ";
            // line 7
            echo twig_escape_filter($this->env, $context["key"], "html", null, true);
            echo " ";
            echo twig_escape_filter($this->env, $context["variant"], "html", null, true);
            echo "
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
        return "view4.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  55 => 10,  44 => 7,  38 => 6,  32 => 5,  29 => 4,  25 => 3,  19 => 1,);
    }
}
/* <form action='process.php?qId={{question.id}}' method='post'>*/
/*     */
/*     {% for key, variant in variantes %}*/
/*         <div>*/
/*             <input name ="{{key}}" id ="{{key}}" type='checkbox' value="true"*/
/*                    {% if qData[key] == true %} checked = 'checked' {% endif %}>*/
/*             {{key}} {{variant}}*/
/*         </div>*/
/*     {% endfor %}*/
/*     <br><br>*/
/* */
/*     <button name = "next" id="next" type="submit" style="width: 180px" value="next"> Следующий вопрос>> </button></br></br>*/
/*     <button name = "prev" id="prev" type="submit" style="width: 180px" value="back"> <<Предыдущий вопрос </button></br></br>*/
/* </form>*/
/* */
