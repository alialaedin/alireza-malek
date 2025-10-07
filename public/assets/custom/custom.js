function confirmDelete(formId) {  
  Swal.fire({  
    title: "آیا مطمئن هستید؟",  
    text: "بعد از حذف این آیتم دیگر قابل بازیابی نخواهد بود!",  
    icon: "warning",  
    showCancelButton: true,  
    showCloseButton: true,
    confirmButtonColor: "#d33",
    cancelButtonColor: "#3085d6",
    confirmButtonText: "حذف کن",  
    cancelButtonText: "انصراف",   
    dangerMode: true,  
    customClass: {
      popup: 'sweet-alert-size'
    }
  }).then((result) => {  
    if (result.isConfirmed) {  
      document.getElementById(formId).submit();  
    }  
  });  
} 

function popup(type, title, message) {
  Swal.fire({
    title: title,
    text: message,
    icon: type,
    confirmButtonText: "بستن",
  });
}

function popupWithConfirmCallback(type, title, message, confirmButtonText, isConfirmedCallback) {
  Swal.fire({
    title: title,
    text: message,
    icon: type,
    confirmButtonText: confirmButtonText,
    showDenyButton: true,
    denyButtonText: "انصراف",
  }).then((result) => {
    if (result.isConfirmed) isConfirmedCallback();
  });
}

function showValidationError(errors) {  
  const list = $('<ul class="list-group"></ul>');  
  for (const key in errors) {  
    if (errors.hasOwnProperty(key)) {  
      const errorsArray = errors[key];  
      errorsArray.forEach((errorMessage) => {  
        list.append('<li class="list-group-item">' + errorMessage + "</li>");  
      });  
    }  
  }  

  Swal.fire({  
    title: "<b>خطا های زیر رخ داده است</b>",  
    html: list[0].outerHTML, 
    icon: "error", 
    confirmButtonText: "بستن",  
  });  
}  

function comma() {
  $("input.comma").on("keyup", function (event) {
    if (event.which >= 37 && event.which <= 40) return;
    $(this).val(function (index, value) {
      return value
        .replace(/\D/g, "")
        .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    });
  });
}

$(document).ready(function () {
  comma();
  $('.disableable').click((event) => {
    $(event.target).prop('disabled', true);
    $(event.target).closest('form').submit();
  });
});
