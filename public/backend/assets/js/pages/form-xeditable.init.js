$(function () {
  ($.fn.editableform.buttons =
    '<button type="submit" class="btn btn-primary editable-submit btn-sm waves-effect waves-light"><i class="mdi mdi-check"></i></button><button type="button" class="btn btn-danger editable-cancel btn-sm waves-effect"><i class="mdi mdi-close"></i></button>'),
    $(".inline-editableform").editable({
      type: "text",
      pk: 1,
      name: "username",
      title: "Enter username",
      mode: "inline",
      inputclass: "form-control-sm form-control",
    });
});
