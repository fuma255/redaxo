<?php

/**
 *
 * @package redaxo5
 */


global $rex_user_loginmessage;

$rex_user_login = rex_post('rex_user_login', 'string');

echo rex_view::title(rex_i18n::msg('login'));

$js = '';
if ($rex_user_loginmessage != '') {
    echo rex_view::error($rex_user_loginmessage) . "\n";
    $js = '
        var time_el = $("div.rex-message strong[data-time]");
        if(time_el.length == 1) {
            function disableLogin() {
                var time = time_el.attr("data-time");
                time_el.attr("data-time", time - 1);
                var hours = Math.floor(time / 3600);
                var mins  = Math.floor((time - (hours * 3600)) / 60);
                var secs  = time % 60;
                var formatted = (hours ? hours + "h " : "") + (hours || mins ? mins + "min " : "") + secs + "s";
                time_el.html(formatted);
                if(time > 0) {
                    setTimeout(disableLogin, 1000);
                } else {
                    $("div.rex-message div").html("' . rex_i18n::msg('login_welcome') . '");
                    $("#rex-form-login").find(":input:not(:hidden)").prop("disabled", "");
                    $("#rex-id-login-user").focus();
                }
            };
            $("#rex-form-login").find(":input:not(:hidden)").prop("disabled", "disabled");
            setTimeout(disableLogin, 1000);
        }';
}

$content = '';
$content .= '
    <fieldset>
        <input type="hidden" name="javascript" value="0" id="javascript" />';

$formElements = [];

$n = [];
$n['label'] = '<label for="rex-id-login-user">' . rex_i18n::msg('login_name') . ':</label>';
$n['field'] = '<input class="form-control" type="text" value="' . htmlspecialchars($rex_user_login) . '" id="rex-id-login-user" name="rex_user_login" autofocus />';
$n['left']  = '<i class="rex-icon rex-icon-user"></i>';
$formElements[] = $n;

$n = [];
$n['label'] = '<label for="rex-id-login-password">' . rex_i18n::msg('password') . ':</label>';
$n['field'] = '<input class="form-control" type="password" name="rex_user_psw" id="rex-id-login-password" />';
$n['left']  = '<i class="rex-icon rex-icon-password"></i>';
$formElements[] = $n;

$fragment = new rex_fragment();
$fragment->setVar('elements', $formElements, false);
$content .= $fragment->parse('core/form/input_group.php');

$formElements = [];
$n = [];
$n['label'] = '<label for="rex-id-login-stay-logged-in">' . rex_i18n::msg('stay_logged_in') . '</label>';
$n['field'] = '<input type="checkbox" name="rex_user_stay_logged_in" id="rex-id-login-stay-logged-in" value="1" />';
$formElements[] = $n;

$fragment = new rex_fragment();
$fragment->setVar('elements', $formElements, false);
$content .= $fragment->parse('core/form/checkbox.php');

$content .= '</fieldset>';


$formElements = [];
$n = [];
$n['field'] = '<button class="btn btn-primary" type="submit"><i class="rex-icon rex-icon-sign-in"></i> ' . rex_i18n::msg('login') . ' </button>';
$formElements[] = $n;

$fragment = new rex_fragment();
$fragment->setVar('elements', $formElements, false);
$buttons = $fragment->parse('core/form/submit.php');




$fragment = new rex_fragment();
$fragment->setVar('heading', rex_i18n::msg('login_welcome'), false);
$fragment->setVar('body', $content, false);
$fragment->setVar('buttons', $buttons, false);
$content = $fragment->parse('core/page/section.php');

$content = '
<form id="rex-form-login" action="' . rex_url::backendController() . '" method="post">
    ' . $content . '
</form>
<script type="text/javascript">
     <!--
    jQuery(function($) {
        $("#rex-form-login")
            .submit(function(){
                var pwInp = $("#rex-id-login-password");
                if(pwInp.val() != "") {
                    $("#rex-form-login").append(\'<input type="hidden" name="\'+pwInp.attr("name")+\'" value="\'+Sha1.hash(pwInp.val())+\'" />\');
                    pwInp.removeAttr("name");
                }
        });

        $("#javascript").val("1");
        ' . $js . '
    });
     //-->
</script>';

echo $content;

