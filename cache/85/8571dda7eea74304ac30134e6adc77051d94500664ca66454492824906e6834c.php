<?php

/* start.html */
class __TwigTemplate_8c7b21840b914ba3b65432bbfe9712a755d940318fc2d30b13ee572b16ecd136 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "\t";
        $this->displayBlock('content', $context, $blocks);
    }

    public function block_content($context, array $blocks = array())
    {
        // line 2
        echo "
\t    <div class='hidiv'>
\t       <span class = 'hitext'>";
        // line 4
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["question"]) ? $context["question"] : null), "qText", array()), "html", null, true);
        echo "</span>
\t    </div>
\t    <div class = 'middleScreen'>
\t    \t<div class = 'startButton-container'>

\t\t        <form action='process.php?qId=";
        // line 9
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["question"]) ? $context["question"] : null), "id", array()), "html", null, true);
        echo "' method='post'>
\t\t        \t<input type = 'hidden' name =\"0\" id =\"0\" value = 'start'>
\t\t        \t<button name = \"next\" id = \"next\" type= \"submit\" value = \"next\" class = \"startButton\"> Начать </button>
\t\t        </form>
\t\t    </div>
\t        <div class = 'pressEnterDiv'>
\t            <span class = 'pressEnterText'> нажмите ENTER </span>
\t        </div>
\t    </div>
\t";
    }

    public function getTemplateName()
    {
        return "start.html";
    }

    public function getDebugInfo()
    {
        return array (  39 => 9,  31 => 4,  27 => 2,  20 => 1,);
    }
}
/* 	{% block content %}*/
/* */
/* 	    <div class='hidiv'>*/
/* 	       <span class = 'hitext'>{{question.qText}}</span>*/
/* 	    </div>*/
/* 	    <div class = 'middleScreen'>*/
/* 	    	<div class = 'startButton-container'>*/
/* */
/* 		        <form action='process.php?qId={{question.id}}' method='post'>*/
/* 		        	<input type = 'hidden' name ="0" id ="0" value = 'start'>*/
/* 		        	<button name = "next" id = "next" type= "submit" value = "next" class = "startButton"> Начать </button>*/
/* 		        </form>*/
/* 		    </div>*/
/* 	        <div class = 'pressEnterDiv'>*/
/* 	            <span class = 'pressEnterText'> нажмите ENTER </span>*/
/* 	        </div>*/
/* 	    </div>*/
/* 	{% endblock %}*/
/* */
