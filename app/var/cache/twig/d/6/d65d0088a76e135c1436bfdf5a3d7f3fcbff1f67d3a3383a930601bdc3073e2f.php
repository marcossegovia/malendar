<?php

/* layout.html */
class __TwigTemplate_c3be58a278aa8673f4ef565fb553f1dd7dec60317da65c7b08d62d984cc3381d extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html>
    <head>
        <title>";
        // line 4
        $this->displayBlock('title', $context, $blocks);
        echo " - My Silex Application</title>

        <link href=\"";
        // line 6
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "basepath", array()), "html", null, true);
        echo "/css/main.css\" rel=\"stylesheet\" type=\"text/css\" />

        <script type=\"text/javascript\">
            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-XXXXXXXX-X']);
            _gaq.push(['_trackPageview']);

            (function() {
                var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
            })();
        </script>
    </head>
    <body>
        ";
        // line 21
        $this->displayBlock('content', $context, $blocks);
        // line 22
        echo "    </body>
</html>
";
    }

    // line 4
    public function block_title($context, array $blocks = array())
    {
        echo "";
    }

    // line 21
    public function block_content($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "layout.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  63 => 21,  57 => 4,  51 => 22,  49 => 21,  31 => 6,  26 => 4,  21 => 1,);
    }
}
/* <!DOCTYPE html>*/
/* <html>*/
/*     <head>*/
/*         <title>{% block title '' %} - My Silex Application</title>*/
/* */
/*         <link href="{{ app.request.basepath }}/css/main.css" rel="stylesheet" type="text/css" />*/
/* */
/*         <script type="text/javascript">*/
/*             var _gaq = _gaq || [];*/
/*             _gaq.push(['_setAccount', 'UA-XXXXXXXX-X']);*/
/*             _gaq.push(['_trackPageview']);*/
/* */
/*             (function() {*/
/*                 var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;*/
/*                 ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';*/
/*                 var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);*/
/*             })();*/
/*         </script>*/
/*     </head>*/
/*     <body>*/
/*         {% block content %}{% endblock %}*/
/*     </body>*/
/* </html>*/
/* */
