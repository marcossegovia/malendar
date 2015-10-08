<?php

/* header.html */
class __TwigTemplate_dd0ab587da17d501a7bbe8c670fa959e9c94d4eb6dcf4b13dbfe2653629705bd extends Twig_Template
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
        echo " Malendar</title>

    <link href=\"";
        // line 6
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "basepath", array()), "html", null, true);
        echo "/css/bootstrap.css\" rel=\"stylesheet\" type=\"text/css\"/>
    <link href=\"";
        // line 7
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "basepath", array()), "html", null, true);
        echo "/css/main.css\" rel=\"stylesheet\" type=\"text/css\"/>
    <link href=\"";
        // line 8
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "basepath", array()), "html", null, true);
        echo "/css/login_page.css\" rel=\"stylesheet\" type=\"text/css\"/>
    <link href='";
        // line 9
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "basepath", array()), "html", null, true);
        echo "/css/calendar/fullcalendar.css' rel='stylesheet' />
    <link href='";
        // line 10
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "basepath", array()), "html", null, true);
        echo "/css/calendar/fullcalendar.print.css' rel='stylesheet' media='print' />
    <link rel='stylesheet' href='";
        // line 11
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "basepath", array()), "html", null, true);
        echo "/css/calendar/jquery-ui.min.css' />

    <script src=\"//code.jquery.com/jquery-1.11.3.min.js\"></script>
    <script src=\"//code.jquery.com/jquery-migrate-1.2.1.min.js\"></script>
    <script src='";
        // line 15
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "basepath", array()), "html", null, true);
        echo "/js/lib/moment.min.js'></script>
    <script src='";
        // line 16
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "basepath", array()), "html", null, true);
        echo "/js/fullcalendar.js'></script>
    <script type=\"text/javascript\">
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-XXXXXXXX-X']);
        _gaq.push(['_trackPageview']);

        (function () {
            var ga = document.createElement('script');
            ga.type = 'text/javascript';
            ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(ga, s);
        })();
    </script>
</head>
<body>
";
        // line 33
        $this->displayBlock('content', $context, $blocks);
        // line 34
        echo "</body>
</html>
";
    }

    // line 4
    public function block_title($context, array $blocks = array())
    {
        echo "";
    }

    // line 33
    public function block_content($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "header.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  96 => 33,  90 => 4,  84 => 34,  82 => 33,  62 => 16,  58 => 15,  51 => 11,  47 => 10,  43 => 9,  39 => 8,  35 => 7,  31 => 6,  26 => 4,  21 => 1,);
    }
}
/* <!DOCTYPE html>*/
/* <html>*/
/* <head>*/
/*     <title>{% block title '' %} Malendar</title>*/
/* */
/*     <link href="{{ app.request.basepath }}/css/bootstrap.css" rel="stylesheet" type="text/css"/>*/
/*     <link href="{{ app.request.basepath }}/css/main.css" rel="stylesheet" type="text/css"/>*/
/*     <link href="{{ app.request.basepath }}/css/login_page.css" rel="stylesheet" type="text/css"/>*/
/*     <link href='{{ app.request.basepath }}/css/calendar/fullcalendar.css' rel='stylesheet' />*/
/*     <link href='{{ app.request.basepath }}/css/calendar/fullcalendar.print.css' rel='stylesheet' media='print' />*/
/*     <link rel='stylesheet' href='{{ app.request.basepath }}/css/calendar/jquery-ui.min.css' />*/
/* */
/*     <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>*/
/*     <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>*/
/*     <script src='{{ app.request.basepath }}/js/lib/moment.min.js'></script>*/
/*     <script src='{{ app.request.basepath }}/js/fullcalendar.js'></script>*/
/*     <script type="text/javascript">*/
/*         var _gaq = _gaq || [];*/
/*         _gaq.push(['_setAccount', 'UA-XXXXXXXX-X']);*/
/*         _gaq.push(['_trackPageview']);*/
/* */
/*         (function () {*/
/*             var ga = document.createElement('script');*/
/*             ga.type = 'text/javascript';*/
/*             ga.async = true;*/
/*             ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';*/
/*             var s = document.getElementsByTagName('script')[0];*/
/*             s.parentNode.insertBefore(ga, s);*/
/*         })();*/
/*     </script>*/
/* </head>*/
/* <body>*/
/* {% block content %}{% endblock %}*/
/* </body>*/
/* </html>*/
/* */
