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
            'content' => array($this, 'block_content'),
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
        // line 11
        echo "    </head>
    <body>
        <header>
        </header>
        
        <div class='content'>
            ";
        // line 17
        $this->displayBlock('content', $context, $blocks);
        // line 19
        echo "        </div>
        
        <footer>
        &copy; SPORTMASTER 2016
        </footer>
    </body>
</html>
";
    }

    // line 4
    public function block_head($context, array $blocks = array())
    {
        // line 5
        echo "            <title>Questionnaire</title>
            <meta http-equiv='Content-Type' content='text/html; charset=utf-8' title='Questionnaire'>
            <link rel='stylesheet' href='public/stylesheets/styles.css' type='text/css'>
            <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js\"></script>
            <script type=\"text/javascript\" src=\"lib/jquery-3.0.0.min.js\"></script>
        ";
    }

    // line 17
    public function block_content($context, array $blocks = array())
    {
        // line 18
        echo "            ";
    }

    public function getTemplateName()
    {
        return "base.html";
    }

    public function getDebugInfo()
    {
        return array (  64 => 18,  61 => 17,  52 => 5,  49 => 4,  38 => 19,  36 => 17,  28 => 11,  26 => 4,  21 => 1,);
    }
}
/* <!DOCTYPE html>*/
/* <html>*/
/*     <head>*/
/*         {% block head %}*/
/*             <title>Questionnaire</title>*/
/*             <meta http-equiv='Content-Type' content='text/html; charset=utf-8' title='Questionnaire'>*/
/*             <link rel='stylesheet' href='public/stylesheets/styles.css' type='text/css'>*/
/*             <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>*/
/*             <script type="text/javascript" src="lib/jquery-3.0.0.min.js"></script>*/
/*         {% endblock %}*/
/*     </head>*/
/*     <body>*/
/*         <header>*/
/*         </header>*/
/*         */
/*         <div class='content'>*/
/*             {% block content %}*/
/*             {% endblock %}*/
/*         </div>*/
/*         */
/*         <footer>*/
/*         &copy; SPORTMASTER 2016*/
/*         </footer>*/
/*     </body>*/
/* </html>*/
/* */
