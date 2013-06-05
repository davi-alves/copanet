/**
 * Created with JetBrains PhpStorm.
 * User: spiderman
 * Date: 17/04/13
 * Time: 15:00
 * To change this template use File | Settings | File Templates.
 */
jQuery.extend(jQuery.validator.messages, {
    required: "Campo ogrigatório.",
    email: "Favor digitar um email válido.",
    maxlength: "Limite de caracteres excedido."
});

jQuery.validator.addMethod("nascimento", function (value, element) {
    return this.optional(element) || /^[0-9]{2}\/[0-9]{2}\/[0-9]{4}$/.test(value);
}, "Favor digitar uma data de nascimento válida.");

jQuery.validator.addMethod("telefone", function (value, element) {
    return this.optional(element) || /^\([0-9]{2}\) [0-9]{4}-[0-9]{4}$/.test(value);
}, "Favor digitar um telefone válido.");

jQuery.validator.addMethod("placeholder", function (value, element) {
    return value != $(element).attr("placeholder");
}, jQuery.validator.messages.required);