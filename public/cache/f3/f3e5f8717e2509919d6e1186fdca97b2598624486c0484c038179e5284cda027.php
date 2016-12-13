<?php

/* base.html.twig */
class __TwigTemplate_7271aa7a6a8141a2895bbb2c44475b617b454c3a9a3695a4e70e0833cecc50e0 extends Twig_Template
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
        echo "<!doctype html>
<html lang=\"ja\">
<head>
    <title>サンプル株式会社</title>
</head>
<body>
";
        // line 7
        echo twig_escape_filter($this->env, (isset($context["title"]) ? $context["title"] : null), "html", null, true);
        echo "
";
        // line 10
        echo "</body>
</html>";
    }

    public function getTemplateName()
    {
        return "base.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  31 => 10,  27 => 7,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<!doctype html>
<html lang=\"ja\">
<head>
    <title>サンプル株式会社</title>
</head>
<body>
{{ title }}
{#{{ html_anchor('testform/index', 'aaa') }}#}
{#<a href=\"{{ path('_testform') }}#home\">Home</a>#}
</body>
</html>", "base.html.twig", "/Users/shimpei/vagrant/Test_Service/fuel/app/views/base.html.twig");
    }
}
