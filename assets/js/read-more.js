jQuery(function ($) {

   function AddReadMore() {
      $(document).on("click", ".read-more", function () {
         $(this).closest(".add-read-more").addClass("show-more-content");
      });
   }

   AddReadMore();
});