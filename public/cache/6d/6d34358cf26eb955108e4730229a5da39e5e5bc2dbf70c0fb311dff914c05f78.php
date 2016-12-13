<?php

/* base.html.twig */
class __TwigTemplate_94d9772b70fd71bf5ba2183507e601407a1b4dda778270e908a8fab5e58b2d69 extends Twig_Template
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
    <title>クローリング結果</title>
    <p>aaa</p>
</head>
<body>
    <div>
        <a href=\"/testform/index\">トップページに戻る</a>
    </div>
</body>
</html>";
    }

    public function getTemplateName()
    {
        return "base.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  19 => 1,);
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
    <title>クローリング結果</title>
    <p>aaa</p>
</head>
<body>
    <div>
        <a href=\"/testform/index\">トップページに戻る</a>
    </div>
</body>
</html>", "base.html.twig", "/Users/shimpei/vagrant/Test_Service/fuel/app/views/base.html.twig");
    }
}
