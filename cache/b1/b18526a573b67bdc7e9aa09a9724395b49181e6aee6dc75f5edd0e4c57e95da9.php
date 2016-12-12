<?php

/* base.html */
class __TwigTemplate_edf8f44984f1347a006f074e5911307d28121122f22d9e00741817063e8b1ec4 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'head' => array($this, 'block_head'),
            'header' => array($this, 'block_header'),
            'content' => array($this, 'block_content'),
            'footer' => array($this, 'block_footer'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html>
    <head>
        ";
        // line 4
        $this->displayBlock('head', $context, $blocks);
        // line 18
        echo "    </head>
    <body>
        <header>
            ";
        // line 21
        $this->displayBlock('header', $context, $blocks);
        // line 23
        echo "        </header>
        
        <div class='content'>
            ";
        // line 26
        $this->displayBlock('content', $context, $blocks);
        // line 28
        echo "        </div>
        
        <footer>
            ";
        // line 31
        $this->displayBlock('footer', $context, $blocks);
        // line 33
        echo "        </footer>
    </body>
</html>
";
    }

    // line 4
    public function block_head($context, array $blocks = array())
    {
        // line 5
        echo "            <title>Questionnaire</title>
            <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\" charset=utf-8' title='Questionnaire'>
            <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
            
            <script type=\"text/javascript\" src=\"lib/jquery-3.0.0.min.js\"></script>

            <!-- Bootstrap -->
            <link href=\"node_modules/bootstrap/dist/css/bootstrap.min.css\" rel=\"stylesheet\">
            <!-- Font Awesome -->
            <link href=\"public/stylesheets/font-awesome.css\" rel=\"stylesheet\">
            <!-- Styles -->
            <link href=\"public/stylesheets/st.css\" rel=\"stylesheet\">
        ";
    }

    // line 21
    public function block_header($context, array $blocks = array())
    {
        // line 22
        echo "            ";
    }

    // line 26
    public function block_content($context, array $blocks = array())
    {
        // line 27
        echo "            ";
    }

    // line 31
    public function block_footer($context, array $blocks = array())
    {
        // line 32
        echo "            ";
    }

    public function getTemplateName()
    {
        return "base.html";
    }

    public function getDebugInfo()
    {
        return array (  94 => 32,  91 => 31,  87 => 27,  84 => 26,  80 => 22,  77 => 21,  61 => 5,  58 => 4,  51 => 33,  49 => 31,  44 => 28,  42 => 26,  37 => 23,  35 => 21,  30 => 18,  28 => 4,  23 => 1,);
    }
}
/* <!DOCTYPE html>*/
/* <html>*/
/*     <head>*/
/*         {% block head %}*/
/*             <title>Questionnaire</title>*/
/*             <meta http-equiv="X-UA-Compatible" content="IE=edge" charset=utf-8' title='Questionnaire'>*/
/*             <meta name="viewport" content="width=device-width, initial-scale=1">*/
/*             */
/*             <script type="text/javascript" src="lib/jquery-3.0.0.min.js"></script>*/
/* */
/*             <!-- Bootstrap -->*/
/*             <link href="node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">*/
/*             <!-- Font Awesome -->*/
/*             <link href="public/stylesheets/font-awesome.css" rel="stylesheet">*/
/*             <!-- Styles -->*/
/*             <link href="public/stylesheets/st.css" rel="stylesheet">*/
/*         {% endblock %}*/
/*     </head>*/
/*     <body>*/
/*         <header>*/
/*             {% block header %}*/
/*             {% endblock %}*/
/*         </header>*/
/*         */
/*         <div class='content'>*/
/*             {% block content %}*/
/*             {% endblock %}*/
/*         </div>*/
/*         */
/*         <footer>*/
/*             {% block footer %}*/
/*             {% endblock %}*/
/*         </footer>*/
/*     </body>*/
/* </html>*/
/* */
