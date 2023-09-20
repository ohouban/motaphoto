document.addEventListener('DOMContentLoaded', function () {
  const menuToggle = document.querySelector('.menu-toggle');
  const mainMenu = document.querySelector('.main-menu');

  // Par défaut, le menu est fermé en version mobile
  mainMenu.classList.add('open');

  menuToggle.addEventListener('click', function () {

    if (menuToggle.classList.contains('open')) {
      menuToggle.classList.remove('open');
      menuToggle.classList.add('fermer');
    } else {
      menuToggle.classList.remove('fermer');
      menuToggle.classList.add('open');
    }
    //mainMenu.classList.toggle('open'); // Ajoute ou supprime la classe 'open'
    mainMenu.classList.toggle('open');

  });
});




/* pagination infinie*/


let currentPage = 1;

jQuery(document).ready(function ($) {
  $('#load-more').on('click', function () {
    currentPage++;
    $.ajax({
      type: 'POST',
      url: 'wp-admin/admin-ajax.php',
      dataType: 'html',
      data: {
        action: 'filtre',
        paged: currentPage,
        categorie: $('#cat-select').val(),
        post_format: $('#form-select').val(),
        post_ordre: $('#tri-select').val(),
      },
      success: function (res) {
        $('.indexphoto').append(res);/*html pour filtre*/
      }
    });
  });
});


jQuery(document).ready(function ($) {
  $('#cat-select').on('change', function () {

    $.ajax({
      type: 'POST',
      url: 'wp-admin/admin-ajax.php',
      dataType: 'html',
      data: {
        action: 'filtre',
        categorie: $('#cat-select').val(),
        post_format: $('#form-select').val(),
        post_ordre: $('#tri-select').val(),
      },
      success: function (res) {
        $('.indexphoto').html(res);
      }
    });
  });
});

jQuery(document).ready(function ($) {
  $('#form-select').on('change', function () {
    $.ajax({
      type: 'POST',
      url: 'wp-admin/admin-ajax.php',
      dataType: 'html',
      data: {
        action: 'filtre',
        post_format: $('#form-select').val(),
        categorie: $('#cat-select').val(),
        post_ordre: $('#tri-select').val(),
      },
      success: function (res) {
        $('.indexphoto').html(res);
      }
    });
  });
});



jQuery(document).ready(function ($) {
  $('#tri-select').on('change', function () {

    $.ajax({
      type: 'POST',
      url: 'wp-admin/admin-ajax.php',
      dataType: 'html',
      data: {
        action: 'filtre',
        post_ordre: $('#tri-select').val(),
        categorie: $('#cat-select').val(),
        post_format: $('#form-select').val(),
      },
      success: function (res) {
        $('.indexphoto').html(res);
      }
    });
  });
});


